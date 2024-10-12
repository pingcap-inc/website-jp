<?php
if (function_exists('acf_add_options_page') && function_exists('acf_add_options_sub_page')) {
	$parent = acf_add_options_page([
		'page_title' => 'Theme Settings',
		'menu_slug' => 'acf-options-theme',
		'position' => 2
	]);

	$sub_pages = [
		'acf-theme-options-hello-bar' => 'Hello Bar',
		'acf-theme-options-social' => 'Social Media',
		'acf-theme-options-header' => 'Header',
		'acf-theme-options-footer' => 'Footer',
		'acf-theme-options-search' => 'Search',
		'acf-theme-options-author-archives' => 'Author Archives',
		'acf-theme-options-404' => '404 Settings',
		'acf-theme-options-scripts' => 'Scripts',
		'acf-theme-options-integrations' => 'Integrations',
		'acf-theme-options-page-links' => 'Page Links',
		'acf-theme-options-reference' => 'Site Reference'
	];

	foreach ($sub_pages as $menu_slug => $page_title) {
		acf_add_options_sub_page([
			'page_title' => $page_title,
			'menu_slug' => $menu_slug,
			'parent_slug' => $parent['menu_slug'],
			'autoload' => true
		]);
	}

	// post (blog) options page
	acf_add_options_sub_page([
		'page_title' => 'Blog Settings',
		'menu_title' => 'Blog Settings',
		'menu_slug' => 'blog-settings',
		'parent' => 'edit.php',
	]);

	// training options page
	acf_add_options_sub_page([
		'page_title' => 'Training Settings',
		'menu_title' => 'Training Settings',
		'menu_slug' => 'training-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::TRAINING
	]);

	// event options page
	acf_add_options_sub_page([
		'page_title' => 'Event Settings',
		'menu_title' => 'Event Settings',
		'menu_slug' => 'event-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::EVENT
	]);

	// partner options page
	acf_add_options_sub_page([
		'page_title' => 'Partner Settings',
		'menu_title' => 'Partner Settings',
		'menu_slug' => 'partner-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::PARTNER
	]);

	// press release options page
	acf_add_options_sub_page([
		'page_title' => 'Press Releases Settings',
		'menu_title' => 'Press Releases Settings',
		'menu_slug' => 'press-release-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::PRESS_RELEASE
	]);

	// news options page
	acf_add_options_sub_page([
		'page_title' => 'News Settings',
		'menu_title' => 'News Settings',
		'menu_slug' => 'news-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::NEWS
	]);

	// case study options page
	acf_add_options_sub_page([
		'page_title' => 'Case Study Settings',
		'menu_title' => 'Case Study Settings',
		'menu_slug' => 'case-study-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::CASE_STUDY
	]);

	// community activities options page
	acf_add_options_sub_page([
		'page_title' => 'Community Activities Settings',
		'menu_title' => 'Community Activities Settings',
		'menu_slug' => 'community-activities-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::COMMUNITY_ACTIVITY
	]);

	// ebook / white paper options page
	acf_add_options_sub_page([
		'page_title' => 'eBook / White Paper Settings',
		'menu_title' => 'eBook / White Paper Settings',
		'menu_slug' => 'ebook-whitepaper-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::EBOOK_WHITEPAPER
	]);

	// video options page
	acf_add_options_sub_page([
		'page_title' => 'Video Settings',
		'menu_title' => 'Video Settings',
		'menu_slug' => 'video-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::VIDEO
	]);

	// slides options page
	acf_add_options_sub_page([
		'page_title' => 'Slides Settings',
		'menu_title' => 'Slides Settings',
		'menu_slug' => 'slides-settings',
		'parent' => 'edit.php?post_type=' . PingCAP\Constants\CPT::SLIDES
	]);
}
