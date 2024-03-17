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

// ********************
// Gravity Forms
// ********************
// add_filter('gform_init_scripts_footer', '__return_true');

// WPUtil\Vendor\GravityForms::move_scripts_to_footer();
// WPUtil\Vendor\GravityForms::safely_output_inline_scripts();
