<?php
namespace PingCAP\CPT;

use PingCAP\Constants;
use WPUtil\Query;
use WPUtil\Vendor\ACF;

abstract class CaseStudy
{
	/**
	 * Return the industry query param value if it has been set
	 *
	 * @return string
	 */
	public static function getIndustryQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_INDUSTRY] ?? ''));
	}

	/**
	 * Return the tag query param value if it has been set
	 *
	 * @return string
	 */
	public static function getTagQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_TAG] ?? ''));
	}

	/**
	 * Return the search query param value if it has been set
	 *
	 * @return string
	 */
	public static function getSearchQueryParamValue(): string
	{
		// phpcs:ignore
		return sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_SEARCH] ?? ''));
	}

	/**
	 * Return the archive page title
	 *
	 * @return string
	 */
	public static function getArchiveTitle(): string
	{
		return ACF::get_field_string(
			Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_archive_title',
			'option'
		);
	}

	/**
	 * Return the archive page heading text
	 *
	 * @return string
	 */
	public static function getArchiveHeadingText(): string
	{
		return ACF::get_field_string(
			Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_archive_heading_text',
			'option'
		);
	}

	/**
	 * Return the featured case study post ids
	 *
	 * @return array<int>
	 */
	public static function getFeaturedIds(): array
	{
		return ACF::get_field_array(
			Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_featured_posts',
			'option'
		);
	}

	/**
	 * Get the first customer term attached to a case study post
	 *
	 * @param integer $post_id
	 * @return \WP_Term|null
	 */
	public static function getCustomerTerm(int $post_id)
	{
		$terms = get_the_terms($post_id, Constants\Taxonomies::CUSTOMER);

		return (is_array($terms) && count($terms)) ? $terms[0] : null;
	}

	/**
	 * Returns the most recent case study post ID for the specified customer term ID
	 *
	 * @param integer $customer_term_id
	 * @return integer
	 */
	public static function getMostRecentIdForCustomer(int $customer_term_id): int
	{
		$post_ids = get_posts([
			'fields' => 'ids',
			'post_type' => Constants\CPT::CASE_STUDY,
			'post_status' => 'publish',
			'posts_per_page' => 1,
			'orderby' => 'date',
			'tax_query' => [ // phpcs:ignore
				[
					'taxonomy' => Constants\Taxonomies::CUSTOMER,
					'field' => 'term_id',
					'terms' => $customer_term_id
				]
			]
		]);

		return (is_array($post_ids) && count($post_ids)) ? intval($post_ids[0]) : 0;
	}

	/**
	 * Modifies a posts query object with the case study archive filter parameters.
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
			'industry' => '',
			'tag' => '',
			'search' => ''
		], $filters);

		if ($filters['industry']) {
			$query = Query::setQueryValue($query, 'tax_query', array_merge(
				Query::getQueryValue($query, 'tax_query', ['relation' => 'AND']),
				[
					[
						'taxonomy' => Constants\Taxonomies::INDUSTRY,
						'field' => 'slug',
						'terms' => $filters['industry']
					]
				]
			));
		}

		if ($filters['tag']) {
			$query = Query::setQueryValue($query, 'tax_query', array_merge(
				Query::getQueryValue($query, 'tax_query', ['relation' => 'AND']),
				[
					[
						'taxonomy' => Constants\Taxonomies::BLOG_TAG,
						'field' => 'slug',
						'terms' => $filters['tag']
					]
				]
			));
		}

		if ($filters['search']) {
			$query = Query::setQueryValue($query, 's', $filters['search']);
		}

		// Get a list of case study post IDs that should be hidden on the archive
		// page from the "Case Studies / Case Study Settings / Case Study Archive"
		// admin page
		$hide_ids = ACF::get_field_array(Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_hide_on_archive_page_ids', 'option');

		if ($hide_ids) {
			$query = Query::setQueryValue($query, 'post__not_in', $hide_ids);
		}

		return $query;
	}
}
