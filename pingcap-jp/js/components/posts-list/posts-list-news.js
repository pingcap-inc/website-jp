import PostsList from './posts-list';

class PostsListNews extends PostsList {
	constructor(el) {
		super(el);

		this.setEndpoint(this.cardsContainer.getAttribute('data-endpoint') ?? 'wp/v2/news');
		this.setPostDisplayCallback((cardMarkup) => cardMarkup);
        this.loadMorePosts();

		if (this.loadMore) {
			this.loadMore.on('load', () => this.loadMorePosts());
		}
	}
}

export default PostsListNews;
