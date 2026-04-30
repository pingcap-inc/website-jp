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
		this.indexName = this.cardsContainerEl.getAttribute('data-index-name') || 'wp_posts_post';

		// cache common containers to avoid repeated DOM queries
		this.searchBoxContainer = document.querySelector('#form_filter_search');
		this.filterCategoryContainer = document.querySelector('#filter_category');
		this.filterTagContainer = document.querySelector('#filter_tag');
		this.regionContainer = document.querySelector('.region');

		// instantiate instantsearch later in setup() so we can set initialUiState based on region/search

		this.filter = {
			search: getUrlQueryArg('search', ''),
			category: getUrlQueryArg('category', ''),
			tag: getUrlQueryArg('tag', ''),
			region: ''
		};

		this.initialRegion = '';

		// fetch region before initializing search so we can apply it once via configure.filters
		this.setup();
		this.showNoResultsMessage(false);
	}

	async setup() {
		const isBot = /bot|crawler|spider|crawling/i.test(navigator.userAgent);

		if (isBot) {
			return;
		}
		try {
			if (this.regionContainer) {
				const response = await fetch('https://get.geojs.io/v1/ip/country.json');
				const { country } = await response.json();
				const region = getRegion(country);
				if (region) {
					this.initialRegion = region.toLowerCase();
					this.filter.region = this.initialRegion;
				}
			}
		} catch (e) {
			// ignore geo failures and continue without region
		}

		// instantiate instantsearch after region is known so we can set an initial non-empty query
		const indexName = this.indexName;
		const initialSearch = getUrlQueryArg('search', '');
		const initialUiState = {};
		if (initialSearch && initialSearch.trim() !== '') {
			initialUiState[indexName] = { query: initialSearch };
		} else if (this.initialRegion) {
			// use a single space to ensure our searchClient forwards the request
			initialUiState[indexName] = { query: ' ' };
		}

		this.search = instantsearch({
			searchClient: {
				...AlgoliaClient,
				search(requests) {
					const safeRequests = requests.map((req) => {
						const q = req.params?.query?.trim();

						return {
							...req,
							params: {
								...req.params,
								query: q || ' ' // fallback
							}
						};
					});

					return AlgoliaClient.search(safeRequests);
				}
			},
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
						const q = indexUiState?.query?.trim();

						return {
							search: q || undefined,
							category: indexUiState?.menu?.['post_category.value'],
							tag: indexUiState?.menu?.['post_tag.value']
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
			},
			initialUiState: Object.keys(initialUiState).length ? initialUiState : undefined
		});

		this.initSearch();
	}

	initSearch() {
		const customSearchBox = connectSearchBox(this.renderSearchBox.bind(this));
		const customInfiniteHits = connectInfiniteHits(this.renderInfiniteHits.bind(this));
		const customMenu = connectMenu(this.renderMenu.bind(this));
		const customRegionMenu = connectMenu(this.renderRegionMenu.bind(this));

		const widgets = [];
		if (this.searchBoxContainer) {
			widgets.push(customSearchBox({ container: this.searchBoxContainer }));
		}

		widgets.push(customInfiniteHits({ container: this.cardsContainerEl }));

		if (this.filterCategoryContainer) {
			widgets.push(
				customMenu({
					container: this.filterCategoryContainer,
					attribute: 'post_category.value'
				})
			);
		}

		if (this.filterTagContainer) {
			widgets.push(
				customMenu({ container: this.filterTagContainer, attribute: 'post_tag.value' })
			);
		}

		if (this.regionContainer) {
			widgets.push(
				customRegionMenu({ container: this.regionContainer, attribute: 'display_region' })
			);
		}

		// Apply initial region filter if available so region does not trigger a second refine
		const configureOpts = { hitsPerPage: 12 };
		if (this.initialRegion) {
			configureOpts.filters = `display_region:${this.initialRegion}`;
		}

		widgets.push(configure(configureOpts));

		this.search.addWidgets(widgets);
		this.search.start();
	}

	renderSearchBox(renderOptions, isFirstRender) {
		const { refine, isSearchStalled, widgetParams } = renderOptions;
		if (isFirstRender) {
			const input = widgetParams.container?.querySelector('input');
			const button = widgetParams.container?.querySelector('.input-with-icon__submit');

			if (input && button) {
				const handlerSearch = (value) => {
					const query = value.trim();

					this.filter.search = query;

					if (!query) {
						refine(' ');
						return;
					}

					refine(query);
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
		}

		this.showLoadingSpinner(isSearchStalled);
	}

	renderInfiniteHits(renderOptions, isFirstRender) {
		const { hits, widgetParams, showMore, isLastPage } = renderOptions;

		if (isFirstRender && this.moreButton) {
			this.moreButton.addEventListener('click', () => {
				showMore();
			});
		}

		if (this.moreButton) {
			const methods = isLastPage ? 'add' : 'remove';
			this.moreButton.classList[methods]('hide');
		}

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
						<div class="card-blog__author"><img src="${item.author_avatar_url}">${
					item.post_author.display_name
				}</div>
					</div>
				</a>
			`
			)
			.join('')}`;

		// Avoid flashing "no results" on initial render before network response
		if (!isFirstRender) {
			this.showNoResultsMessage(!hits.length);
		}

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

	renderRegionMenu(renderOptions, isFirstRender) {
		const { refine, widgetParams } = renderOptions;
		if (isFirstRender && widgetParams?.container) {
			widgetParams.container.addEventListener('change', (e) => {
				refine(e.currentTarget.value ?? '');
			});
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
