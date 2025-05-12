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
						const category = encodeURIComponent(getUrlQueryArg('category', ''));
						const tag = decodeURIComponent(getUrlQueryArg('tag', ''));

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
							category: indexUiState.menu?.['post_category.value'],
							tag: indexUiState.menu?.['post_tag.value']
						};
					},

					routeToState(routeState) {
						return {
							[indexName]: {
								query: routeState.search,
								menu: {
									'post_category.value': routeState.category,
									'post_tag.value': routeState.tag
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
		this.showNoResultsMessage(false);
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
				container: document.querySelector('#filter_category'),
				attribute: 'post_category.value'
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
				<a class="card-blog" href="${item.permalink}">
					<div class="card-blog__image-container">
						<img class="lazy card-blog__image" data-src="${item.images.hero?.url}">
					</div>
					<div class="card-blog__content-container">
						<div>
						<div class="card-blog__content-head">
							<div class="card-blog__category">${item.taxonomies?.category}</div>
							<div class="card-blog__date">${item.post_date_formatted}</div>
						</div>
						<h5 class="card-blog__title">${instantsearch.highlight({
							attribute: 'post_title',
							hit: item
						})}</h5>
						</div>
						<div class="card-blog__author"><img src="${item.author_avatar_url}">${item.post_author.display_name}</div>
					</div>
				</a>
			`
			)
			.join('')}`;

		this.showNoResultsMessage(!hits.length);

		SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
	}

	renderMenu(renderOptions, isFirstRender) {
		const { refine, widgetParams } = renderOptions;
		if (isFirstRender) {
			widgetParams.container.addEventListener('change', (e) => {
				refine(e.currentTarget.value ?? '');
			});
		}
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
