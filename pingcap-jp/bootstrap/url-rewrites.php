<?php
/**
 * Ensure generated category links for archives use the "?param=slug" URL format
 */
add_filter('term_link', function ($term_link, $term, $taxonomy) {
	$cur_post_type = get_post_type(get_the_ID());

	switch ($taxonomy) {
		/**
		 * Handle default category ('category') term archive URL rewrites
		 */
		case PingCAP\Constants\Taxonomies::BLOG_CATEGORY:
			$archive_url = $cur_post_type ?
				get_post_type_archive_link($cur_post_type) :
				get_the_permalink(get_option('page_for_posts'));

			$param_name = PingCAP\Constants\QueryParams::BLOG_ARCHIVE_FILTER_CATEGORY;

			switch ($cur_post_type) {
				case PingCAP\Constants\CPT::TRAINING:
					$param_name = PingCAP\Constants\QueryParams::TRAINING_ARCHIVE_FILTER_CATEGORY;
					break;

				case PingCAP\Constants\CPT::EVENT:
					$param_name = PingCAP\Constants\QueryParams::EVENT_ARCHIVE_FILTER_CATEGORY;
					break;

				default:
					break;
			}

			return sprintf(
				'%s?%s=%s',
				$archive_url,
				$param_name,
				rawurlencode($term->slug)
			);

		/**
		 * Handle default tag ('post_tag') term archive URL rewrites
		 */
		case PingCAP\Constants\Taxonomies::BLOG_TAG:
			$archive_url = $cur_post_type ?
				get_post_type_archive_link($cur_post_type) :
				get_the_permalink(get_option('page_for_posts'));

			$param_name = PingCAP\Constants\QueryParams::BLOG_ARCHIVE_FILTER_TAG;

			switch ($cur_post_type) {
				case PingCAP\Constants\CPT::TRAINING:
					$param_name = PingCAP\Constants\QueryParams::TRAINING_ARCHIVE_FILTER_TAG;
					break;

				case PingCAP\Constants\CPT::EVENT:
					$param_name = PingCAP\Constants\QueryParams::EVENT_ARCHIVE_FILTER_TAG;
					break;

				case PingCAP\Constants\CPT::CASE_STUDY:
					$param_name = PingCAP\Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_TAG;
					break;

				default:
					break;
			}

			return sprintf(
				'%s?%s=%s',
				$archive_url,
				$param_name,
				rawurlencode($term->slug)
			);

		/**
		 * Handle industry ('industry') term archive URL rewrites
		 */
		case PingCAP\Constants\Taxonomies::INDUSTRY:
			$archive_url = $cur_post_type ?
				get_post_type_archive_link($cur_post_type) :
				get_post_type_archive_link(PingCAP\Constants\CPT::CASE_STUDY);

			return sprintf(
				'%s?%s=%s',
				$archive_url,
				PingCAP\Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_INDUSTRY,
				rawurlencode($term->slug)
			);

		default:
			break;
	}

	return $term_link;
}, 10, 3);
