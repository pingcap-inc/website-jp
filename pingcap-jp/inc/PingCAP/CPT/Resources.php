<?php
namespace PingCAP\CPT;

use PingCAP\Constants;

abstract class Resources
{
	/**
	 * "Resources" is not an actual post type of its own but instead an aggregate
	 * of blog posts, training posts, and event posts. This method returns an
	 * array of those post type identifiers.
	 *
	 * @return array<string>
	 */
	public static function getResourcePostTypes(): array
	{
		return [
			Constants\CPT::BLOG,
			Constants\CPT::TRAINING,
			Constants\CPT::EVENT,
			Constants\CPT::PRESS_RELEASE,
			Constants\CPT::EBOOK_WHITEPAPER
		];
	}

	/**
	 * Get related post ids by matching the specified taxonomy and term ids
	 *
	 * If not enough posts are found the remainder of the requested amount
	 * will be filled out using the most recent posts
	 * (controllable via the 'fill_remaining' option value)
	 *
	 * Options:
	 *     'post_type' - [string] post type to request (defaults to post type of object_id)
	 *     'post_status' - [string] default is "publish"
	 *     'num_posts' - [integer] number of posts returned (default is 4)
	 *     'taxonomy' - [string] (REQUIRED) taxonomy type to match with
	 *     'term_ids' - [array] (REQUIRED) taxonomy term ids to match with
	 *     'fill_remaining' - [boolean] if true, the most recent posts will be used to fill the remaining requested posts if needed
	 *
	 * @param integer $object_id
	 * @param array $user_opts
	 * @return array<int>
	 */
	public static function getRelatedPostIds($object_id = 0, $user_opts = []): array
	{
		// No object id? Use the current post.
		if (!$object_id) {
			$object_id = get_the_ID();
		}

		// Return an empty array if there is no object id
		if (!$object_id) {
			return [];
		}

		// If the post type of the specified object ID is a valid resource post
		// type (post, event, training), let it control the post types returned.
		// If it's not a valid resource post type then set the post types to be
		// returned as all valid resource post types.
		$post_type = get_post_type($object_id);

		if (!in_array($post_type, self::getResourcePostTypes(), true)) {
			$post_type = self::getResourcePostTypes();
		}

		$opts = array_merge([
			'post_type' => $post_type,
			'post_status' => 'publish',
			'num_posts' => 3,
			'taxonomy' => Constants\Taxonomies::BLOG_TAG,
			'term_ids' => [],
			'fill_remaining' => true
		], $user_opts);

		// Return an empty array if there are no term ids
		if (!$opts['term_ids']) {
			return [];
		}

		// default get_posts arguments
		$base_args = [
			'fields' => 'ids',
			'post_type' => $opts['post_type'],
			'post_status' => $opts['post_status']
		];

		$exclude_ids = [$object_id];
		$return_post_ids = [];

		// build the tax_query param
		$tax_query_param = [
			'taxonomy' => $opts['taxonomy'],
			'field' => 'term_id',
			'terms' => $opts['term_ids'],
			'operator' => 'IN'
		];

		// find posts matching all taxonomy terms
		$return_post_ids = get_posts(array_merge($base_args, [
			'posts_per_page' => $opts['num_posts'],
			'tax_query' => [$tax_query_param], // phpcs:ignore
			'post__not_in' => $exclude_ids
		]));

		if (count($return_post_ids) >= $opts['num_posts'] || !$opts['fill_remaining']) {
			return $return_post_ids;
		}

		// fill out the remainder with the latest posts
		$add_exclude_ids = count($return_post_ids) ? $return_post_ids : [];
		$exclude_ids = array_merge([$object_id], $add_exclude_ids);

		$most_recent_posts = get_posts(array_merge($base_args, [
			'posts_per_page' => $opts['num_posts'] - count($return_post_ids),
			'post__not_in' => $exclude_ids
		]));

		$return_post_ids = array_merge($return_post_ids, $most_recent_posts);

		return $return_post_ids;
	}
}
