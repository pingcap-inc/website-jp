<?php
namespace PingCAP;

use PingCAP\CPT;
use WPUtil\Vendor\ACF;
use WP_Query;

abstract class Authors
{
	public static function getAuthorNicenameById(int $author_id): string
	{
		$user = get_user_by('id', $author_id);

		return $user ? ($user->user_nicename ?? '') : '';
	}

	public static function getAuthorIdByName(string $author_name): int
	{
		$user = get_user_by('slug', $author_name);

		return $user ? intval($user->ID ?? 0) : 0;
	}

	protected static function getPostIds(array $add_params = []): array
	{
		$params = array_merge([
			'post_type' => CPT\Resources::getResourcePostTypes(),
			'post_status' => 'publish',
			'posts_per_page' => -1
		], $add_params);

		$query = new WP_Query($params);

		$post_ids = array_reduce($query->posts, function ($acum, $post) {
			$post_id = intval($post->ID ?? 0);

			if ($post_id && !in_array($post_id, $acum, true)) {
				$acum[] = $post_id;
			}

			return $acum;
		}, []);

		return $post_ids;
	}

	public static function getPostIdsForAuthor(int $author_id): array
	{
		$author_post_ids = [];
		$add_author_post_ids = [];

		$author_post_ids = self::getPostIds([
			'author_name' => self::getAuthorNicenameById($author_id)
		]);

		$value_match_str = sprintf(';s:%d:"%d";', strlen(strval($author_id)), $author_id);

		$add_author_post_ids = self::getPostIds([
			'meta_key' => 'additional_authors', // phpcs:ignore
			'meta_value' => $value_match_str, // phpcs:ignore
			'meta_compare' => 'LIKE'
		]);

		return array_merge($author_post_ids, $add_author_post_ids);
	}

	/**
	 * Return the custom posts per page author archive settings value or default
	 * to the standard "posts_per_page" value if it isn't enabled or found
	 *
	 * @return integer
	 */
	public static function getPostsPerPageCount(): int
	{
		$value = 0;

		$override_enabled = ACF::get_field_int(
			Constants\ACF::THEME_OPTIONS_AUTHOR_ARCHIVES_BASE . '_override_posts_per_page',
			'option'
		);

		if ($override_enabled) {
			$value = ACF::get_field_int(
				Constants\ACF::THEME_OPTIONS_AUTHOR_ARCHIVES_BASE . '_custom_posts_per_page',
				'option'
			);
		}

		if (!$value) {
			$value = intval(get_option('posts_per_page'));
		}

		return $value;
	}
}
