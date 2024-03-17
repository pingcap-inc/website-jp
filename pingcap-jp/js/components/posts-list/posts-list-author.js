import PostsList from './posts-list';

class PostsListAuthor extends PostsList {
	constructor(el) {
		super(el);

		this.setEndpoint('wp/v2/posts');
		this.setPostDisplayCallback((cardMarkup) => cardMarkup);

		if (this.loadMore) {
			this.loadMore.on('load', () => this.loadBlogPosts());
		}
	}

	loadBlogPosts() {
		const config = {
			author: parseInt(this.cardsContainer.getAttribute('data-author-id'), 10)
		};

		this.loadMorePosts(config);
	}
}

export default PostsListAuthor;
