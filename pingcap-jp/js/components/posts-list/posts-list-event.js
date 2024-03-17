import PostsList from './posts-list';
import { queryArgsAsMap, getUrlWithQueryArgs, getUrlQueryArg } from '../../util/url-util';

class PostsListEvent extends PostsList {
	constructor(el) {
		super(el);

		this.setEndpoint(this.cardsContainer.getAttribute('data-endpoint') ?? 'wp/v2/event');
		this.setPostDisplayCallback((cardMarkup) => cardMarkup);

		this.formSearchEl = document.querySelector('form#form_filter_search');
		this.filterTypeEl = document.querySelector('select#filter_location');
		this.filterRegionEl = document.querySelector('select#filter_region');


		this.filterSearch = getUrlQueryArg('search', '');
		this.filterTypeSlug = getUrlQueryArg('type', '');
		this.filterRegionSlug = getUrlQueryArg('region', '');

		if (this.loadMore) {
			this.loadMore.on('load', () => this.loadEventPosts());
		}

		if (this.formSearchEl) {
			this.formSearchEl.addEventListener('submit', (e) => {
				e.preventDefault();

				const inputEl = e.currentTarget.querySelector('input');

				if (inputEl) {
					this.filterSearch = inputEl.value.trim();

					this.updateURL();
					this.clearCardsContainer();
					this.loadEventPosts();
				}
			});
		}

		if (this.filterTypeEl) {
			this.filterTypeEl.addEventListener('change', (e) => {
				this.filterTypeSlug = e.currentTarget.value ?? '';

				this.updateURL();
				this.clearCardsContainer();
				this.loadEventPosts();
			});
		}

		if (this.filterRegionEl) {
			this.filterRegionEl.addEventListener('change', (e) => {
				this.filterRegionSlug = e.currentTarget.value ?? '';

				this.updateURL();
				this.clearCardsContainer();
				this.loadEventPosts();
			});
		}

		if(this.filterSearch) {
			this.formSearchEl.querySelector('input').value = decodeURIComponent(this.filterSearch);
		}
	}

	loadEventPosts() {
		const config = {
			location_slug: this.filterTypeSlug,
			region_slug: this.filterRegionSlug,
			search: this.filterSearch
		};

		this.loadMorePosts(config);
	}

	updateURL() {
		const args = queryArgsAsMap();

		if (this.filterCategorySlug) {
			args.set('category', this.filterCategorySlug);
		} else {
			args.delete('category');
		}

		if (this.filterTypeSlug) {
			args.set('type', this.filterTypeSlug);
		} else {
			args.delete('type');
		}

		if (this.filterRegionSlug) {
			args.set('region', this.filterRegionSlug);
		} else {
			args.delete('region');
		}

		if (this.filterSearch) {
			args.set('search', this.filterSearch);
		} else {
			args.delete('search');
		}

		window.history.replaceState({}, '', getUrlWithQueryArgs(args));
	}
}

export default PostsListEvent;
