<?php
namespace PingCAP\CPT;

use PingCAP\Constants;
use WPUtil\StaticCache;
use WPUtil\Vendor\ACF;

abstract class CommunityActivity
{
	/**
	 * Return the default image ACF object as set under "Community Activities / Community Activities Settings / Images / Default Featured Image"
	 *
	 * @return array
	 */
	public static function getDefaultCardImage(): array
	{
		$cache_key = 'ca_default_featured_image';

		$default_image = StaticCache::get($cache_key);

		if (!is_array($default_image)) {
			$default_image = ACF::get_field_array(Constants\ACF::COMMUNITY_ACTIVITIES_SETTINGS_BASE . '_default_featured_image', 'option');

			StaticCache::set($cache_key, $default_image);
		}

		return $default_image;
	}

	/**
	 * Format the event date(s) for display
	 *
	 * @param string $date_start
	 * @param string $date_end
	 * @return string
	 */
	public static function formatDateLabel(string $date_start, string $date_end): string
	{
		if ($date_start && $date_end) {
			$time_start = strtotime($date_start);
			$time_end = strtotime($date_end);
			$year_start = intval(date('Y', $time_start));
			$year_end = intval(date('Y', $time_end));

			$label_start = date(
				$year_start === $year_end ?
					Constants\DateFormat::COMMUNITY_ACTIVITY_NO_YEAR :
					Constants\DateFormat::COMMUNITY_ACTIVITY,
				$time_start
			);

			$label_end = date(Constants\DateFormat::COMMUNITY_ACTIVITY, $time_end);

			return $time_start === $time_end && $year_start === $year_end ?
				$label_end :
				$label_start . ' &mdash; ' . $label_end;
		} elseif ($date_start) {
			return date(Constants\DateFormat::COMMUNITY_ACTIVITY, strtotime($date_start));
		} elseif ($date_end) {
			return date(Constants\DateFormat::COMMUNITY_ACTIVITY, strtotime($date_end));
		}

		return '';
	}

	/**
	 * Return the date label for the specified post id
	 *
	 * @param integer $post_id
	 * @return string
	 */
	public static function getDateLabel(int $post_id): string
	{
		return self::formatDateLabel(
			ACF::get_field_string('date_start', $post_id),
			ACF::get_field_string('date_end', $post_id)
		);
	}

	/**
	 * Return the upcoming community activity post ids and optionally include
	 * expired acitivites if needed
	 *
	 * @param integer $limit
	 * @param boolean $include_expired
	 * @return array<int>
	 */
	public static function getPostIds(int $limit = 3, bool $include_expired = true): array
	{
		$base_params = [
			'fields' => 'ids',
			'post_type' => Constants\CPT::COMMUNITY_ACTIVITY,
			'post_status' => 'publish',
			'meta_key' => 'date_start', // phpcs:ignore
			'orderby' => 'meta_value'
		];

		$post_ids = get_posts(array_merge($base_params, [
			'posts_per_page' => $limit,
			'order' => 'ASC',
			'meta_query' => [ // phpcs:ignore
				[
					'key' => 'date_start',
					'value' => date('Ymd'),
					'compare' => '>='
				]
			]
		]));

		if (count($post_ids) < $limit && $include_expired) {
			$add_post_ids = get_posts(array_merge($base_params, [
				'post__not_in' => $post_ids,
				'posts_per_page' => $limit - count($post_ids),
				'order' => 'DESC'
			]));

			$add_post_ids = array_reverse($add_post_ids);

			$post_ids = array_merge($add_post_ids, $post_ids);
		}

		return $post_ids;
	}
}
