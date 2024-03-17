import PostsList from './posts-list';
import { wpAPIget } from '../../util/wp-rest-api';
import SiteEvents, { SiteEventNames } from '../../util/site-events';

class PostsListEbookWhitepaper extends PostsList {
	constructor(el) {
		super(el);

		this.setEndpoint('wp/v2/ebook-whitepaper');
		this.setPostDisplayCallback((cardMarkup) => cardMarkup);
		this.loadAllPosts();
	}

	async loadAllPosts() {
		if (!this.endpoint) {
			throw new Error('No endpoint provided for loadMorePosts');
		}

		this.showNoResultsMessage(false);
		this.showLoadingSpinner(true);

		const params = {
			_fields: ['card_markup'],
			page: 1,
			per_page: 100,
			post_type: 'posts',
			subtype: 'post'
		};

		try {
			const res = await wpAPIget(this.endpoint, params);

			this.showLoadingSpinner(false);

			if (!res.body.length && curPage === 0) {
				this.showNoResultsMessage(true);
			} else {
				const postsHTML = res.body.map((post) => post.card_markup);
				const addMarkup = postsHTML.map((post) => this.postDisplayFunc(post, this));

				this.cardsContainer.innerHTML = addMarkup.join('');
			}

			SiteEvents.publish(SiteEventNames.LAZYLOAD_TRIGGER_UPDATE);
		} catch (err) {
			this.showLoadingSpinner(false);

			console.error(err);
		}

		this.loadMore.setLoading(false);
	}
}

export default PostsListEbookWhitepaper;
