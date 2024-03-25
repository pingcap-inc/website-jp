<?php

namespace PingCAP\CPT;

use PingCAP\Constants;
use WPUtil\{Query, StaticCache};
use WPUtil\Vendor\ACF;
use WP_Query;
use DateTimeZone;
use DateTime;

// phpcs:disable WordPress.Security.NonceVerification.Recommended

abstract class Event
{
	/**
	 * Return the industry query param value if it has been set
	 *
	 * @return string
	 */
	public static function getLocationQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_LOCATION] ?? ''));
	}

	/**
	 * Return the region query param value if it has been set
	 *
	 * @return string
	 */
	public static function getRegionQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_REGION] ?? ''));
	}

	/**
	 * Return the tag query param value if it has been set
	 *
	 * @return string
	 */
	public static function getTagQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_TAG] ?? ''));
	}

	/**
	 * Return the search query param value if it has been set
	 *
	 * @return string
	 */
	public static function getSearchQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_SEARCH] ?? ''));
	}

	/**
	 * Return the default WP_Query for event posts to be used in instances that
	 * do not have an existing query (ex: blocks and page templates)
	 *
	 * @param array $add_params
	 * @return WP_Query
	 */
	public static function getDefaultWPQuery(array $add_params = []): WP_Query
	{
		$params = array_merge([
			'post_type' => Constants\CPT::EVENT,
			'post_status' => 'publish',
			'posts_per_page' => self::getPostsPerPageCount() // phpcs:ignore
		], $add_params);

		$params = self::modifyQueryWithFilters($params, [
			'category' => sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::EVENT_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);

		return new WP_Query($params);
	}

	/**
	 * Modifies a posts query object with the event archive filter parameters.
	 * Can take either or a WP_Query object (used in "pre_get_posts") or an array
	 * (used in "rest_post_query")
	 *
	 * @param \WP_Query|array $query
	 * @param array $filters
	 * @return \WP_Query|array
	 */
	public static function modifyQueryWithFilters($query, array $filters)
	{
		$filters = array_merge([
			'location' => '',
			'region' => '',
			'category' => '',
			'tag' => '',
			'search' => ''
		], $filters);

		if ($filters['location']) {
			$query = Query::setQueryValue($query, 'tax_query', array_merge(
				Query::getQueryValue($query, 'tax_query', ['relation' => 'AND']),
				[
					[
						'taxonomy' => Constants\Taxonomies::LOCATION,
						'field' => 'slug',
						'terms' => $filters['location']
					]
				]
			));
		}

		if ($filters['region']) {
			$query = Query::setQueryValue($query, 'tax_query', array_merge(
				Query::getQueryValue($query, 'tax_query', ['relation' => 'AND']),
				[
					[
						'taxonomy' => Constants\Taxonomies::REGION,
						'field' => 'slug',
						'terms' => $filters['region']
					]
				]
			));
		}

		if ($filters['category']) {
			$query = Query::setQueryValue($query, 'category_name', $filters['category']);
		}

		if ($filters['tag']) {
			$query = Query::setQueryValue($query, 'tag', $filters['tag']);
		}

		if ($filters['search']) {
			$query = Query::setQueryValue($query, 's', $filters['search']);
		}

		return $query;
	}

	/**
	 * Return the featured event post id
	 *
	 * @return int
	 */
	public static function getFeaturedId(): int
	{
		return ACF::get_field_int(
			Constants\ACF::EVENT_SETTINGS_BASE . '_featured_post',
			'option'
		);
	}

	/**
	 * Return the custom posts per page archive settings value or default to the
	 * standard "posts_per_page" value if it isn't enabled or found
	 *
	 * @return integer
	 */
	public static function getPostsPerPageCount(): int
	{
		$value = 0;

		$override_enabled = ACF::get_field_int(
			Constants\ACF::EVENT_SETTINGS_BASE . '_override_posts_per_page',
			'option'
		);

		if ($override_enabled) {
			$value = ACF::get_field_int(
				Constants\ACF::EVENT_SETTINGS_BASE . '_custom_posts_per_page',
				'option'
			);
		}

		if (!$value) {
			$value = intval(get_option('posts_per_page'));
		}

		return $value;
	}

	/**
	 * Get the first category label attached to a event post
	 *
	 * @param integer $post_id
	 * @return string
	 */
	public static function getPostCategoryText(int $post_id): string
	{
		$terms = get_the_category($post_id);

		if (!is_array($terms) || !count($terms)) {
			return '';
		}

		return $terms[0]->name ?? '';
	}

	/**
	 * Get the first location label attached to a event post
	 *
	 * @param integer $post_id
	 * @return string
	 */
	public static function getPostLocationText(int $post_id): string
	{
		$terms = get_the_terms($post_id, Constants\Taxonomies::LOCATION);

		if (!is_array($terms) || !count($terms)) {
			return '';
		}

		return $terms[0]->name ?? '';
	}

	/**
	 * Return the default image ACF object as set under "Events / Event Settings / Images / Default Featured Image"
	 *
	 * @return array
	 */
	public static function getDefaultCardImage(): array
	{
		$cache_key = 'event_default_featured_image';

		$default_image = StaticCache::get($cache_key);

		if (!is_array($default_image)) {
			$default_image = ACF::get_field_array(Constants\ACF::EVENT_SETTINGS_BASE . '_default_featured_image', 'option');

			StaticCache::set($cache_key, $default_image);
		}

		return $default_image;
	}

	/**
	 * Return the archive page title
	 *
	 * @return string
	 */
	public static function getArchiveTitle(): string
	{
		return ACF::get_field_string(
			Constants\ACF::EVENT_SETTINGS_BASE . '_archive_title',
			'option'
		);
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
		if (!$date_start || !$date_end) {
			return '';
		}
		$time_start = strtotime($date_start);
		$time_end = strtotime($date_end);
		$year_start = intval(date('Y', $time_start));
		$year_end = intval(date('Y', $time_end));
		$month_start = intval(date('m', $time_start));
		$month_end = intval(date('m', $time_end));
		$day_start = intval(date('j', $time_start));
		$day_end = intval(date('j', $time_end));


		if (($month_start === $month_end) && ($day_start == $day_end)) {
			$label_start = date(Constants\DateFormat::EVENT_CALENDAR_NO_YEAR, $time_start);
			$label_end = date(Constants\DateFormat::EVENT_CALENDAR_TIME, $time_end);
			return $label_start . ' - ' . $label_end;
		}

		if (($month_start === $month_end)) {
			$label_start = date(Constants\DateFormat::EVENT_CALENDAR_MONTH_DAY, $time_start);
			return $label_start . ' - ' . $day_end . ', ' . $year_start;
		}

		if (($year_start === $year_end)) {
			$label_start = date(Constants\DateFormat::EVENT_CALENDAR_MONTH_DAY, $time_start);
			$label_end = date(Constants\DateFormat::EVENT_CALENDAR_MONTH_DAY, $time_end);
			return $label_start . ' - ' . $label_end . ', ' . $year_start;
		}

		$label_start = date(Constants\DateFormat::EVENT_CALENDAR_NO_TIME, $time_start);
		$label_end = date(Constants\DateFormat::EVENT_CALENDAR_NO_TIME, $time_end);
		return $label_start . ' - ' . $label_end;
	}

	/**
	 * Return the event status
	 *
	 * @param string $date_start
	 * @param string $date_end
	 * @param int $offset
	 * @return string
	 */
	public static function getStatusLabel(string $date_start, string $date_end, string $offset): string
	{
		if (!$date_start || !$date_end || !$offset) {
			return '';
		}


		$now = strtotime(self::getTimeByOffset($offset));
		$time_start = strtotime($date_start);
		$time_end = strtotime($date_end);
		$status = '';
		if ($now < $time_start) {
			$status = 'Upcoming';
		} else if ($now > $time_end) {
			$status = 'Completed';
		} else {
			$status = 'In progress';
		}
		return $status;
	}

	/**
	 * Return the time by offset
	 *
	 * @param string $offset
	 * @return string
	 */
	public static function getTimeByOffset(string $offset, string $timezone = 'UTC'): string
	{
		$offsetMap = [
			'JST'=> '+9 hours',
			'PST'=> '-8 hours',
			'PDT' => '-7 hours',
			'CST' => '-6 hours',
			'EST' => '-5 hours',
			'EDT' => '-4 hours',
			'CET' => '+1 hour',
			'EET' => '+2 hours',
			'CEST' => '+2 hours',
			'EEST' => '+3 hours',
			'IST' => '+5 hours +30 minutes',
			'ICT' => '+7 hours',
			'WIT' => '+7 hours',
			'CST-2' => '+8 hours',
			'SGT' => '+8 hours',
		];
		$dt = new DateTime();
		$tz = new DateTimeZone($timezone);
		$dt->setTimeZone($tz);
		$dt->modify($offsetMap[$offset]);
		return $dt->format('Y-m-d H:i:s');
	}
}
