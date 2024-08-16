<?php
add_action('pre_get_posts', function ($query) {
	if (is_admin() || !$query->is_main_query()) {
		return;
	}

	/**
	 * Author archive
	 */
	if ($query->is_author()) {
		$query->set('posts_per_page', PingCAP\Authors::getPostsPerPageCount());

		$author_id = PingCAP\Authors::getAuthorIdByName($query->query_vars['author_name']);
		$author_post_ids = PingCAP\Authors::getPostIdsForAuthor($author_id);

		$query->query_vars['custom_author_id'] = $author_id;

		if ($author_post_ids) {
			unset($query->query_vars['author_name']);

			$query->set('post_type', PingCAP\CPT\Resources::getResourcePostTypes());
			$query->set('post__in', $author_post_ids);
		}
	}

	/**
	 * Search archive
	 */
	if ($query->is_search()) {
		$query->set('posts_per_page', PingCAP\Search::getPostsPerPageCount());
	}

	/**
	 * Blog (post) archive filtering
	 */
	if ($query->is_home()) {
		$query->set('posts_per_page', PingCAP\CPT\Blog::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\Blog::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::BLOG_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::BLOG_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::BLOG_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Training archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::TRAINING)) {
		$query->set('posts_per_page', PingCAP\CPT\Training::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\Training::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::TRAINING_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::TRAINING_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::TRAINING_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Event archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::EVENT)) {
		$query->set('posts_per_page', PingCAP\CPT\Event::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\Event::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::EVENT_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::EVENT_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::EVENT_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Partner archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::PARTNER)) {
		$query->set('posts_per_page', PingCAP\CPT\Partner::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\Partner::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::PARTNER_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::PARTNER_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::PARTNER_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * eBook / White Paper archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::EBOOK_WHITEPAPER)) {
		$query->set('posts_per_page', 100);

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\EbookWhitePaper::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::EBOOK_WHITEPAPER_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::EBOOK_WHITEPAPER_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::EBOOK_WHITEPAPER_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Press Release archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::PRESS_RELEASE)) {
		$query->set('posts_per_page', PingCAP\CPT\PressRelease::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\PressRelease::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::PRESS_RELEASE_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::PRESS_RELEASE_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::PRESS_RELEASE_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * News archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::NEWS)) {
		$query->set('posts_per_page', PingCAP\CPT\News::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\News::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::NEWS_ARCHIVE_FILTER_CATEGORY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::NEWS_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::NEWS_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Video archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::VIDEO)) {
		$query->set('posts_per_page', PingCAP\CPT\Video::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\VIDEO::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::VIDEO_ARCHIVE_FILTER_CATEGORY] ?? '')),
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Slides archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::SLIDES)) {
		$query->set('posts_per_page', PingCAP\CPT\Slides::getPostsPerPageCount());

		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\VIDEO::modifyQueryWithFilters($query, [
			'category' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::SLIDES_ARCHIVE_FILTER_CATEGORY] ?? '')),
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Case Study archive filtering
	 */
	if ($query->is_post_type_archive(PingCAP\Constants\CPT::CASE_STUDY)) {
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$query = PingCAP\CPT\CaseStudy::modifyQueryWithFilters($query, [
			'industry' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_INDUSTRY] ?? '')),
			'tag' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_TAG] ?? '')),
			'search' => sanitize_text_field(wp_unslash($_GET[PingCAP\Constants\QueryParams::CASE_STUDY_ARCHIVE_FILTER_SEARCH] ?? ''))
		]);
		// phpcs:enable WordPress.Security.NonceVerification.Recommended

		$query->set('posts_per_page', 100);
	}
});
