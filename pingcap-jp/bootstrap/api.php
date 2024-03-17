<?php

use PingCAP\{Authors, Components, Constants, CPT, Taxonomies};

WPUtil\REST::register_routes('pingcap/v1', [
	'/careers' => 'PingCAP\API\v1\Careers'
	// '/post-importer/import-post' => 'PingCAP\API\v1\PostImporter\ImportPost'
]);

add_action('rest_api_init', function () {
	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/posts endpoint
	 */
	register_rest_field(Constants\CPT::BLOG, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardResource::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\Blog::getPostCategoryText($post['id']),
				'default_image' => CPT\Blog::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/event endpoint
	 */
	register_rest_field(Constants\CPT::EVENT, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardEvent::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\Event::getPostCategoryText($post['id']),
				'default_image' => CPT\Event::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/training endpoint
	 */
	register_rest_field(Constants\CPT::TRAINING, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardResource::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\Training::getPostCategoryText($post['id']),
				'default_image' => CPT\Training::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/partner endpoint
	 */
	register_rest_field(Constants\CPT::PARTNER, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardResource::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\Partner::getPostCategoryText($post['id']),
				'default_image' => CPT\Partner::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/ebook-whitepaper endpoint
	 */
	register_rest_field(Constants\CPT::EBOOK_WHITEPAPER, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardResource::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\EbookWhitePaper::getPostCategoryText($post['id']),
				'default_image' => CPT\EbookWhitePaper::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/press-release endpoint
	 */
	register_rest_field(Constants\CPT::PRESS_RELEASE, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardResource::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\PressRelease::getPostCategoryText($post['id']),
				'default_image' => CPT\PressRelease::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/news endpoint
	 */
	register_rest_field(Constants\CPT::NEWS, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardNews::class,
			[
				'post_id' => $post['id'],
				'category' => CPT\News::getPostCategoryText($post['id']),
				'default_image' => CPT\News::getDefaultCardImage()
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/case-study endpoint
	 */
	register_rest_field(Constants\CPT::CASE_STUDY, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardCaseStudy::class,
			[
				'post_id' => $post['id']
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/video endpoint
	 */
	register_rest_field(Constants\CPT::VIDEO, 'card_markup', [
		'get_callback' => fn ($post) => WPUtil\Component::render_to_string(
			Components\Cards\CardVideo::class,
			[
				'post_id' => $post['id']
			]
		)
	]);

	/**
	 * Add a 'card_markup' field to the results returned by the
	 * /wp/v2/search endpoint
	 */
	add_filter('rest_post_dispatch', function ($result, $server, $request) {
		if ($result->get_matched_route() !== '/wp/v2/search') {
			return $result;
		}

		foreach ($result->data as &$record) {
			if ($request->get_param('post_type') === 'posts') {
				$record['card_markup'] = WPUtil\Component::render_to_string(
					Components\Cards\CardResource::class,
					[
						'post_id' => $record['id'],
						'category' => CPT\Blog::getPostCategoryText($record['id']),
						'default_image' => CPT\Blog::getDefaultCardImage()
					]
				);
			} else {
				$record['card_markup'] = WPUtil\Component::render_to_string(
					Components\Cards\CardSearch::class,
					['post_id' => $record['id']]
				);
			}
		}

		return $result;
	}, 10, 3);

	/**
	 * Add orphaned customer cards to the results returned by the /wp/v2/case-study
	 * endpoint when no filters are being used
	 */
	add_filter('rest_post_dispatch', function ($result, $server, $request) {
		if (
			$result->get_matched_route() !== '/wp/v2/' . Constants\CPT::CASE_STUDY ||
			$request->get_param('industry_slug') ||
			$request->get_param('tag_slug') ||
			$request->get_param('search')
		) {
			return $result;
		}

		$orphaned_customer_terms = Taxonomies\Customer::getOrphanedCustomerTerms();

		foreach ($orphaned_customer_terms as $customer_term) {
			$card_markup = WPUtil\Component::render_to_string(Components\Cards\CardCustomer::class, [
				'customer_term_id' => $customer_term->term_id,
				'customer_name' => $customer_term->name
			]);

			$result->data[] = [
				'card_markup' => $card_markup
			];
		}

		return $result;
	}, 10, 3);

	/**
	 * Add filters to blog (post) queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::BLOG . '_query', function ($args, $request) {
		if (isset($args['author__in']) && is_array($args['author__in']) && $args['author__in']) {
			// Treat this request as an author archive request since the "author__in"
			// value has been set
			$args['posts_per_page'] = Authors::getPostsPerPageCount(); // phpcs:ignore
			$args['post_type'] = CPT\Resources::getResourcePostTypes();

			$author_post_ids = [];

			foreach ($args['author__in'] as $author_id) {
				$author_post_ids = array_merge($author_post_ids, Authors::getPostIdsForAuthor($author_id));
			}

			$author_post_ids = array_unique($author_post_ids, SORT_NUMERIC);

			$args['post__in'] = $author_post_ids;

			// unset "author__in" since we know exactly which post ids we want
			unset($args['author__in']);
		} else {
			// Treat this request as a blog archive request since no author has
			// been specified
			$args['posts_per_page'] = CPT\Blog::getPostsPerPageCount(); // phpcs:ignore

			$args = CPT\Blog::modifyQueryWithFilters($args, [
				'category' => $request->get_param('category_slug') ?? '',
				'tag' => $request->get_param('tag_slug') ?? '',
				'search' => $request->get_param('search') ?? ''
			]);
		}

		return $args;
	}, 10, 2);

	/**
	 * Add filters to training post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::TRAINING . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\Training::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\Training::modifyQueryWithFilters($args, [
			'category' => $request->get_param('category_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add filters to event post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::EVENT . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\Event::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\Event::modifyQueryWithFilters($args, [
			'location' => $request->get_param('location_slug') ?? '',
			'region' => $request->get_param('region_slug') ?? '',
			'category' => $request->get_param('category_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add filters to partner post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::PARTNER . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\Partner::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\Partner::modifyQueryWithFilters($args, [
			'category' => $request->get_param('category_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add filters to eBook / White Paper post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::EBOOK_WHITEPAPER . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\EbookWhitePaper::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\EbookWhitePaper::modifyQueryWithFilters($args, [
			'category' => $request->get_param('category_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add filters to press release post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::PRESS_RELEASE . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\PressRelease::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\PressRelease::modifyQueryWithFilters($args, [
			'category' => $request->get_param('category_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add filters to news post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::NEWS . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\News::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\News::modifyQueryWithFilters($args, [
			'category' => $request->get_param('category_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add filters to video post queries from the "load more" requests
	 */
	add_filter('rest_' . Constants\CPT::VIDEO . '_query', function ($args, $request) {
		$args['posts_per_page'] = CPT\Video::getPostsPerPageCount(); // phpcs:ignore

		$args = CPT\Video::modifyQueryWithFilters($args, [
			'category' => $request->get_param('category_slug') ?? '',
		]);

		return $args;
	}, 10, 2);

	/**
	 * Add industry slug support to case studies endpoint
	 */
	add_filter('rest_' . Constants\CPT::CASE_STUDY . '_query', function ($args, $request) {
		$args = CPT\CaseStudy::modifyQueryWithFilters($args, [
			'industry' => $request->get_param('industry_slug') ?? '',
			'tag' => $request->get_param('tag_slug') ?? '',
			'search' => $request->get_param('search') ?? ''
		]);

		return $args;
	}, 10, 2);
});
