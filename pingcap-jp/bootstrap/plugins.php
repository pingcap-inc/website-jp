<?php
// ********************
// W3TC
// ********************
if (!defined('ENVIRONMENT') || constant('ENVIRONMENT') !== 'local') {
	WPUtil\Vendor\W3TC::lock_settings_page();
}

// ********************
// Yoast SEO
// ********************
// move Yoast SEO fields to the bottom of the editor
add_filter('wpseo_metabox_prio', function () {
	return 'low';
});

// Exclude noindex pages from Yoast sitemap
add_filter('wpseo_exclude_from_sitemap_by_post_ids', function ($excluded_posts) {
	
	$unlisted_post_ids = get_option("unlist_posts", array());

	if (!empty($unlisted_post_ids)) {
		$excluded_posts = array_merge($excluded_posts, $unlisted_post_ids);
	}

	return $excluded_posts;
});


// ********************
// Gravity Forms
// ********************
// add_filter('gform_init_scripts_footer', '__return_true');

// WPUtil\Vendor\GravityForms::move_scripts_to_footer();
// WPUtil\Vendor\GravityForms::safely_output_inline_scripts();
