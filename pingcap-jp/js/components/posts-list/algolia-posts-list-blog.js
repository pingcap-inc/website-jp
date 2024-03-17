import instantsearch from 'instantsearch.js';
import { history } from 'instantsearch.js/es/lib/routers';
import { configure } from 'instantsearch.js/es/widgets';
import { connectSearchBox, connectMenu, connectInfiniteHits } from 'instantsearch.js/es/connectors';
import { AlgoliaClient } from '../../util/algolia';
import { getUrlQueryArg } from '../../util/url-util';
import SiteEvents, { SiteEventNames } from '../../util/site-events';
import { getRegion } from '../../util/region';

class AlgoliaPostsList {
	constructor(el) {
		this.el = el;
		this.cardsContainerEl = this.el.querySelector('.posts-list__cards-container');
		this.moreButton = this.el.querySelector('.js__load-more');
		this.noResultsContainer = this.el.querySelector('[data-no-results-container]');
		this.loadingSpinner = this.el.querySelector('.posts-list__loader-container');
		const indexName = this.cardsContainerEl.getAttribute('data-index-name') || 'wp_posts_post';

		this.search = instantsearch({
			searchClient: AlgoliaClient,
			indexName,
			routing: {
				router: history({
					createURL({ qsModule, location, routeState }) {
						const { origin, pathname } = location;
						const queryString = qsModule.stringify(routeState);
						if (queryString) {
							return `${origin}${pathname}?${queryString}`;
						}

						return `${origin}${pathname}`;
					},
					parseURL() {
						const search = encodeURIComponent(getUrlQueryArg('search', ''));
						const categoryStr = encodeURIComponent(getUrlQueryArg('category', ''));
						const category = categoryStr
							? categoryStr.replace(categoryStr[0], categoryStr[0].toUpperCase())
							: '';
						const tagStr = decodeURIComponent(getUrlQueryArg('tag', ''));
						const tag = tagStr
							? tagStr.replace(tagStr[0], tagStr[0].toUpperCase())
							: '';

						return {
							search: decodeURIComponent(search),
							category,
							tag
						};
					}
				}),
				stateMapping: {
					stateToRoute(uiState) {
						const indexUiState = uiState[indexName];

						return {
							search: indexUiState?.query,
							category:
								indexUiState.menu?.['taxonomies.category']?.toLocaleLowerCase(),
							tag: indexUiState.menu?.['taxonomies.post_tag']
						};
					},

					routeToState(routeState) {
						return {
							[indexName]: {
								query: routeState.search,
								menu: {
									'taxonomies.category': routeState.category,
									'taxonomies.post_tag': routeState.tag
								}
							}
						};
					}
				}
			}
		});

		this.filter = {
			search: getUrlQueryArg('search', ''),
			category: getUrlQueryArg('category', ''),
			tag: getUrlQueryArg('tag', '')
		};

		this.initSearch([]);
	}

	initSearch() {
		const customSearchBox = connectSearchBox(this.renderSearchBox.bind(this));
		const customInfiniteHits = connectInfiniteHits(this.renderInfiniteHits.bind(this));
		const customMenu = connectMenu(this.renderMenu.bind(this));
		const customRegionMenu = connectMenu(this.renderRegionMenu.bind(this));

		this.search.addWidgets([
			customSearchBox({
				container: document.querySelector('#form_filter_search')
			}),
			customInfiniteHits({
				container: this.cardsContainerEl
			}),
			customMenu({
				container: document.querySelector('.tags'),
				attribute: 'taxonomies.category',
				sortBy: ['name:asc']
			}),
			customRegionMenu({
				container: document.querySelector('.region'),
				attribute: 'display_region'
			}),
			configure({
				hitsPerPage: 12
			})
		]);
		this.search.start();
	}

	renderSearchBox(renderOptions, isFirstRender) {
		const { refine, isSearchStalled, widgetParams } = renderOptions;
		if (isFirstRender) {
			const input = widgetParams.container.querySelector('input');
			const button = widgetParams.container.querySelector('.input-with-icon__submit');

			const handlerSearch = (value) => {
				this.filter.search = value;
				refine(value);
			};

			input.addEventListener('keydown', (event) => {
				if (event.keyCode === 13) {
					handlerSearch(event.target.value);
				}
			});

			button.addEventListener('click', () => {
				handlerSearch(input.value);
			});
		}

		this.showLoadingSpinner(isSearchStalled);
	}

	renderInfiniteHits(renderOptions, isFirstRender) {
		const { hits, widgetParams, showMore, isLastPage } = renderOptions;

		if (isFirstRender) {
			this.moreButton.addEventListener('click', () => {
				showMore();
			});
		}

		const methods = isLastPage ? 'add' : 'remove';
		this.moreButton.classList[methods]('hide');

		widgetParams.container.innerHTML = `${hits
			.map(
				(item) => `
				<a class="card-resource bg-white" href="${item.permalink}">
					<div class="card-resource__image-container">
						<img class="lazy card-resource__image" data-src="${item.images.hero?.url}">
					</div>
					<div class="card-resource__content-container">
						<div class="card-resource__content-head">
							<div class="card-resource__category">${item.taxonomies?.category}</div>
							<div class="card-resource__date">${item.post_date_formatted}</div>
						</div>
						<h5 class="card-resource__title">${instantsearch.highlight({
							attribute: 'post_title',
							hit: item
						})}</h5>
					</div>
				</a>
			`
			)
			.join('')}`;

		this.showNoResultsMessage(!hits.length);

		SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
	}

	renderMenu(renderOptions) {
		const { widgetParams, createURL, refine, items } = renderOptions;
		widgetParams.container.innerHTML = `
		${[{ value: '', label: 'All' }]
			.concat(items)
			.map(
				(item) =>
					`<a href="${createURL(item.value)}" data-value="${item.value}" class="button ${
						item.isRefined ? 'active' : ''
					}">${item.label}</a>`
			)
			.join('')}`;

		[...widgetParams.container.querySelectorAll('.button')].forEach((element) => {
			element.addEventListener('click', (event) => {
				event.preventDefault();
				const value = event.currentTarget.dataset.value;
				this.filter.category = value;
				refine(value);
			});
		});
	}

	async renderRegionMenu(renderOptions, isFirstRender) {
		const { refine } = renderOptions;
		if (isFirstRender) {
			const response = await fetch('https://get.geojs.io/v1/ip/country.json');
			const { country } = await response.json();
			if (getRegion(country)) {
				refine(getRegion(country).toLowerCase());
			}
		}
	}

	showLoadingSpinner(showSpinner) {
		if (!this.loadingSpinner) {
			return;
		}

		if (showSpinner) {
			this.loadingSpinner.classList.remove('hide');
		} else {
			this.loadingSpinner.classList.add('hide');
		}
	}

	showNoResultsMessage(show) {
		if (!this.noResultsContainer) {
			return;
		}

		if (show) {
			this.noResultsContainer.classList.remove('hide');
		} else {
			this.noResultsContainer.classList.add('hide');
		}
	}
}

export default AlgoliaPostsList;
