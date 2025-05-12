<?php

namespace PingCAP;

abstract class Posts
{
	/**
	 * Return the featured image ACF object for a post id or false if not found
	 *
	 * @param integer $post_id
	 * @return array<string, mixed>|false
	 */
	public static function getFeaturedImageACFObject(int $post_id)
	{
		$featured_image_id = get_post_thumbnail_id($post_id);

		if ($featured_image_id && function_exists('acf_get_attachment')) {
			return acf_get_attachment($featured_image_id);
		}

		return false;
	}

	/**
	 * Get related posts by matching the specified taxonomy and term ids
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
	 * @param array<string, mixed> $user_opts
	 * @return array<\WP_Post>
	 */
	public static function getRelatedPosts($object_id = 0, $user_opts = []): array
	{
		// No object id? Use the current post.
		if (!$object_id) {
			$object_id = the_post_ID();
		}

		// Return an empty array if there is no object id
		if (!$object_id) {
			return [];
		}

		$source_post = get_post($object_id);

		$opts = array_merge([
			'post_type' => $source_post->post_type,
			'post_status' => 'publish',
			'num_posts' => 4,
			'taxonomy' => 'post_tag',
			'term_ids' => [],
			'fill_remaining' => true
		], $user_opts);

		// Return an empty array if there are no term ids
		if (!$opts['term_ids']) {
			return [];
		}

		// default get_posts arguments
		$base_args = [
			'post_type' => $opts['post_type'],
			'post_status' => $opts['post_status']
		];

		$exclude_ids = [$object_id];
		$return_posts = [];

		// build the tax_query param
		$tax_query_param = [
			'taxonomy' => $opts['taxonomy'],
			'field' => 'term_id',
			'terms' => $opts['term_ids'],
			'operator' => 'IN'
		];

		// find posts matching all taxonomy terms
		$return_posts = get_posts(array_merge($base_args, [
			'posts_per_page' => $opts['num_posts'],
			'tax_query' => [$tax_query_param], // phpcs:ignore
			'post__not_in' => $exclude_ids
		]));

		if (count($return_posts) >= $opts['num_posts'] || !$opts['fill_remaining']) {
			return $return_posts;
		}

		// fill out the remainder with the latest posts
		$add_exclude_ids = count($return_posts) ? array_map(function ($item) {
			return $item->ID;
		}, $return_posts) : [];
		$exclude_ids = array_merge([$object_id], $add_exclude_ids);

		$most_recent_posts = get_posts(array_merge($base_args, [
			'posts_per_page' => $opts['num_posts'] - count($return_posts),
			'post__not_in' => $exclude_ids
		]));

		$return_posts = array_merge($return_posts, $most_recent_posts);

		return $return_posts;
	}

	public static function getPostTagsData($post_id = 0): array
	{
		$tags = get_the_tags($post_id);
		$tag_data = array();

		if ($tags) {
			foreach ($tags as $tag) {
				$tag_data[] = array(
					'value'  => $tag->slug,
					'slug'  => $tag->slug,
					'label' => $tag->name,
				);
			}
		}

		return $tag_data;
	}

	public static function getPostCategoryData($post_id = 0): array
	{
		$categories = get_the_category($post_id);
		$category_data = array();

		if ($categories) {
			foreach ($categories as $category) {
				$category_data[] = array(
					'value'  => $category->slug,
					'slug'  => $category->slug,
					'label' => $category->name,
				);
			}
		}

		return $category_data;
	}
}
