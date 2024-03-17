<?php

/**
 * Remove default JavaScript output by the blocks plugin
 */
add_filter('grav_blocks_output_default_js', function () {
	return false;
});

/**
 * Remove default styles output by the blocks plugin
 */
add_filter('grav_blocks_output_default_styles', function () {
	return false;
});

/**
 * Override values for Blueprint Blocks plugin settings
 */
add_filter('grav_blocks_plugin_settings', function ($settings, $option_key) {
	// All default blocks should be disabled
	$settings['blocks_enabled_default'] = ['global-block'];

	// All theme blocks should be enabled
	$settings['blocks_enabled_theme'] = WPUtil\Vendor\BlueprintBlocks::get_theme_blocks_list();

	// Specify which post types the blocks editor should be visible on
	$settings['post_types'] = [
		PingCAP\Constants\CPT::BLOG,
		'page',
		'global-block',
		PingCAP\Constants\CPT::TRAINING,
		PingCAP\Constants\CPT::EVENT,
		PingCAP\Constants\CPT::PARTNER,
		PingCAP\Constants\CPT::CASE_STUDY,
		PingCAP\Constants\CPT::COMMUNITY_ACTIVITY,
		PingCAP\Constants\CPT::PRESS_RELEASE,
		PingCAP\Constants\CPT::EBOOK_WHITEPAPER
	];

	// Specify which page templates the blocks editor should be visible on
	$settings['templates'] = [
		// ex: 'templates/page-template-name.php'
	];

	// Specify which taxonomies the blocks editor should be visible on
	$settings['taxonomies'] = [];

	// Specify which advanced options are enabled. This array may contain the
	// following strings: filter_content, filter_excerpt, after_title, hide_content
	$settings['advanced_options'] = [];

	return $settings;
}, 10, 2);

/**
 * Remove unused Blueprint Blocks plugin settings fields
 */
add_filter('grav_blocks_settings_fields', function ($fields, $location) {
	// Remove the fields for enabling/disabling individual blocks
	unset($fields['blocks_enabled_default']);
	unset($fields['blocks_enabled_theme']);

	// Remove the fields for enabling/disabling blocks on post types
	unset($fields['post_types']);

	// Remove the fields for enabling/disabling blocks on page templates
	unset($fields['templates']);

	// Remove the fields for enabling/disabling blocks on taxonomies
	unset($fields['taxonomies']);

	// The Google Maps fields used within this theme are located under "Theme Settings / Integrations / Google Maps".
	unset($fields['google_maps_api_key']);
	unset($fields['google_maps_styles']);
	unset($fields['google_maps_default_lat_lng']);
	unset($fields['google_maps_default_zoom']);

	// Remove the "Advanced / Advanced Options" fields
	unset($fields['advanced_options']);

	return $fields;
}, 10, 2);

/**
 * Enforce background color choices
 */
WPUtil\Vendor\BlueprintBlocks::enforce_background_colors([
	'block-bg-none' => 'None',
	'block-bg-image' => 'Image',
	'bg-black' => 'Black',
	'bg-blue' => 'Blue',
	'bg-gray' => 'Gray',

	'block-bg-none block-bg-split' => 'White / Black'
]);

/**
 * Only allow specific background colors for the specified blocks
 */
WPUtil\Vendor\BlueprintBlocks::restrict_backgrounds_for_blocks([
	'cards' => ['block-bg-none', 'bg-black', 'bg-gray'],
	'case-study' => ['block-bg-none'],
	'columns' => ['block-bg-none', 'bg-black', 'bg-blue', 'bg-gray','block-bg-image'],
	'community-activities' => ['block-bg-none'],
	'cta' => ['block-bg-none', 'bg-black', 'bg-gray', 'block-bg-image'],
	'icon-grid' => ['block-bg-none', 'bg-blue', 'bg-black'],
	'leadership' => ['block-bg-none'],
	'logos' => ['block-bg-none'],
	'media-content' => ['block-bg-none'],
	'open-positions' => ['block-bg-none'],
	'pricing' => ['bg-blue'],
	'resources' => ['block-bg-none', 'block-bg-none block-bg-split','bg-gray'],
	'solutions' => ['block-bg-none'],
	'stats' => ['block-bg-none'],
	'table' => ['bg-blue'],
	'tabs' => ['block-bg-none', 'bg-blue'],
	'testimonials' => ['block-bg-none', 'bg-blue']
]);

/**
 * Enforce which blocks are allowed to use the animate functionality
 */
WPUtil\Vendor\BlueprintBlocks::allow_animate_option_for_blocks([]);

/**
 * Make sure blocks appear in alphabetical order by label in the flexible content field
 */
WPUtil\Vendor\BlueprintBlocks::sort_block_names_alphabetically();

/**
 * Ensure Grav Blocks are viewable on the pages that require them
 */
add_filter('grav_is_viewable', function ($is_viewable) {
	if (
		is_home() ||
		is_singular() ||
		is_404() ||
		is_search() ||
		is_author() ||
		is_post_type_archive([
			PingCAP\Constants\CPT::TRAINING,
			PingCAP\Constants\CPT::EVENT,
			PingCAP\Constants\CPT::PARTNER,
			PingCAP\Constants\CPT::CASE_STUDY,
			PingCAP\Constants\CPT::PRESS_RELEASE,
			PingCAP\Constants\CPT::NEWS,
			PingCAP\Constants\CPT::EBOOK_WHITEPAPER
		])
	) {
		$is_viewable = true;
	}

	return $is_viewable;
});

/**
 * Add 'wysiwyg' class to content (v2) block columns
 */
add_filter('grav_get_css', function ($css, $block_name) {
	if (in_array($block_name, ['content', 'contentv2'], true) && in_array('columns', $css, true)) {
		$css[] = 'wysiwyg';
	}

	return $css;
}, 10, 2);

/**
 * Add 'grav_blocks' field to default post and page WP REST API responses
 */
add_action('rest_api_init', function () {
	register_rest_field(['post', 'page'], 'grav_blocks', [
		'get_callback' => function ($post) {
			return get_field('grav_blocks');
		}
	]);
});

/**
 * Prevent the video URL from being processed/formatted by the blocks plugin
 */
add_filter('grav_blocks_process_video_url', function ($process_video, $url) {
	return false;
}, 10, 2);

/**
 * Output the video button markup when requested
 */
add_action('grav_blocks_get_video_link_button', function ($block, $video_url) {
	WPUtil\Component::render(PingCAP\Components\UI\PlayVideoOverlay::class, [
		'video_url' => $video_url
	]);
}, 10, 2);

/**
 * Add container attributes filter for the CTA block
 */
add_filter('grav_block_attributes', [PingCAP\Blocks\CTA::class, 'block_container_attributes_filter'], 10, 2);

/**
 * Add container attributes fitler for the Resources block
 */
add_filter('grav_block_attributes', [PingCAP\Blocks\RelatedResources::class, 'block_container_attributes_filter'], 10, 2);

/**
 * Add the "Add Top Arc Shape" and "Increase Bottom Padding for Arc Shape" fields to
 * the "Options" tab for each block
 */
add_filter('grav_block_fields', function ($fields) {
	$restricted_blocks = ['global-block'];
	$block_names = array_keys($fields);

	foreach ($block_names as $block_name) {
		if (in_array($block_name, $restricted_blocks, true)) {
			continue;
		}

		$fields[$block_name]['sub_fields'][] = array(
			'key' => 'field_block_default_' . $block_name . '_add_top_arc',
			'label' => 'Add Top Arc Shape',
			'name' => 'block_add_top_arc',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 0,
			'block_options' => 1
		);

		$fields[$block_name]['sub_fields'][] = array(
			'key' => 'field_block_default_' . $block_name . '_increase_bottom_padding',
			'label' => 'Increase Bottom Padding for Arc Shape',
			'name' => 'block_increase_bottom_padding',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 0,
			'block_options' => 1
		);
	}

	return $fields;
});

/**
 * Add the top arc class to any block that has it enabled (except for the first block)
 */
add_filter('grav_blocks_container_attributes', function ($attrs, $block_name, $block_variables) {
	$block_index = intval($attrs['data-block-index'] ?? 0);
	$bypass_first_block_arc_check = apply_filters('PingCAP/blocks/bypass_first_block_arc_check', false); // phpcs:ignore

	if (!$bypass_first_block_arc_check && $block_index === 1) {
		return $attrs;
	}

	$add_top_arc = WPUtil\Vendor\ACF::get_sub_field_bool('block_add_top_arc');

	if (!$add_top_arc) {
		return $attrs;
	}

	// initialize the 'class' attribute if it does not exist or is not an array
	if (!isset($attrs['class']) || !is_array($attrs['class'])) {
		$attrs['class'] = [];
	}

	$attrs['class'][] = 'content-top-curve';

	return $attrs;
}, 10, 3);

/**
 * Add the increased bottom padding class to any block that has it enabled
 */
add_filter('grav_blocks_container_attributes', function ($attrs, $block_name, $block_variables) {
	$increase_bottom_padding = WPUtil\Vendor\ACF::get_sub_field_bool('block_increase_bottom_padding');

	if (!$increase_bottom_padding) {
		return $attrs;
	}

	// initialize the 'class' attribute if it does not exist or is not an array
	if (!isset($attrs['class']) || !is_array($attrs['class'])) {
		$attrs['class'] = [];
	}

	$attrs['class'][] = 'block-container--increase-bottom-padding';

	return $attrs;
}, 10, 3);

/**
 * "Pull up" the first block content if it is an allowable block (or content) type
 * and the setting has been enabled by the block display method
 */
add_filter('grav_blocks_container_attributes', function ($attrs, $block_name, $block_variables) {
	// Check if this is the first block and return if it is not
	$block_index = intval($attrs['data-block-index'] ?? 0);

	if ($block_index !== 1) {
		return $attrs;
	}

	$enable_pull_up = apply_filters('PingCAP/blocks/first_block_pull_up', false); // phpcs:ignore

	// Return if the content pull up is not enabled
	if (!$enable_pull_up) {
		return $attrs;
	}

	// Initialize the 'class' attribute if it does not exist or is not an array
	if (!isset($attrs['class']) || !is_array($attrs['class'])) {
		$attrs['class'] = [];
	}

	// Check for block type and display conditions where the block content should
	// be pulled up into the banner
	$can_pull_up = false;

	switch ($block_name) {
		case 'cards':
			$can_pull_up = true;
			break;

		case 'columns':
			$columns = WPUtil\Vendor\ACF::get_sub_field_array('columns');
			$box_container = count($columns) <= 2 ? WPUtil\Vendor\ACF::get_sub_field_int('enable_box_container', ['default' => 0]) : 0;

			if ($box_container) {
				$can_pull_up = true;
			}

			break;

		default:
			break;
	}

	if ($can_pull_up) {
		$attrs['class'][] = 'block-content-pull-up';
	}

	return $attrs;
}, 10, 3);
