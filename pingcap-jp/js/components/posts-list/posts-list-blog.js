import PostsList from './posts-list';
import {
	queryArgsAsMap,
	getUrlWithQueryArgs,
	getUrlQueryArg,
	removeUrlQueryArg
} from '../../util/url-util';

class PostsListBlog extends PostsList {
	constructor(el) {
		super(el);

		this.setEndpoint(this.cardsContainer.getAttribute('data-endpoint') ?? 'wp/v2/posts');
		this.setPostDisplayCallback((cardMarkup) => cardMarkup);

		this.formSearchEl = document.querySelector('form#form_filter_search');
		this.filterCategoryEl = document.querySelector('select#filter_category');
		this.filterTagEl = document.querySelector('select#filter_tag');

		this.filterCategorySlug = getUrlQueryArg('category', '');
		this.filterTagSlug = getUrlQueryArg('tag', '');
		this.filterSearch = getUrlQueryArg('search', '');

		if (document.body.classList.contains('post-type-archive-event')) {
			// DF: I'm not sure what the intended effect is here...
			// Is it to remove the "category" and "tag" parameters if they're
			// set when the Event archive page is loaded?
			//
			// The removeUrlQueryArg (which needed to be imported) method returns
			// a string value which is the current URL with the specified query
			// parameter removed. These two calls below do nothing since they don't
			// store the returned value and don't use it perform an action such
			// as a page redirect, history push, etc...
			//
			// ¯\_(ツ)_/¯

			removeUrlQueryArg('category');
			removeUrlQueryArg('tag');
		}

		if (this.loadMore) {
			this.loadMore.on('load', () => this.loadBlogPosts());
		}

		if (this.formSearchEl) {
			this.formSearchEl.addEventListener('submit', (e) => {
				e.preventDefault();

				const inputEl = e.currentTarget.querySelector('input');

				if (inputEl) {
					this.filterSearch = inputEl.value.trim();

					this.updateURL();
					this.clearCardsContainer();
					this.loadBlogPosts();
				}
			});
		}

		if (this.filterCategoryEl) {
			this.filterCategoryEl.addEventListener('change', (e) => {
				this.filterCategorySlug = e.currentTarget.value ?? '';

				this.updateURL();
				this.clearCardsContainer();
				this.loadBlogPosts();
			});
		}

		if (this.filterTagEl) {
			this.filterTagEl.addEventListener('change', (e) => {
				this.filterTagSlug = e.currentTarget.value ?? '';

				this.updateURL();
				this.clearCardsContainer();
				this.loadBlogPosts();
			});
		}

		if(this.filterSearch) {
			this.formSearchEl.querySelector('input').value = decodeURIComponent(this.filterSearch);
		}
	}

	loadBlogPosts() {
		const config = {
			category_slug: this.filterCategorySlug,
			tag_slug: this.filterTagSlug,
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

		if (this.filterTagSlug) {
			args.set('tag', this.filterTagSlug);
		} else {
			args.delete('tag');
		}

		if (this.endpoint === 'wp/v2/search') {
			args.delete('category');
			args.delete('tag');
			Array.from(document.querySelectorAll('.tags button')).forEach((el) => {
				el.classList.remove('active');
			});
		}

		if (this.filterSearch) {
			args.set('search', this.filterSearch);
		} else {
			args.delete('search');
		}

		window.history.replaceState({}, '', getUrlWithQueryArgs(args));
	}
}

export default PostsListBlog;
