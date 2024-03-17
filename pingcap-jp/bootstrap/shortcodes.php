<?php

use WPUtil\{Component, SVG};
use PingCAP\Components;

add_shortcode('hubspot_form', function ($atts, $content = '') {
	$params = shortcode_atts([
		'portal_id' => '',
		'form_id' => '',
		'salesforce_id' => '',
		'border' => '',
		'calendly_id' => '',
		'calendly_url' => ''
	], $atts);

	return Component::render_to_string(Components\HubSpotForm::class, [
		'portal_id' => $params['portal_id'],
		'form_id' => $params['form_id'],
		'salesforce_id' => $params['salesforce_id'],
		'border' => $params['border'],
		'calendly_id' => $params['calendly_id'],
		'calendly_url' => $params['calendly_url']
	]);
});

add_shortcode('video', function ($atts, $content = '') {
	$params = shortcode_atts([
		'url' => '',
		'image' => '',
	], $atts);

	return Component::render_to_string(Components\Video::class, [
		'url' => $params['url'],
		'image' => $params['image']
	]);
});

// Add menu shortcode that allows for adding a sitemap menu to WYSIWYG editors
add_shortcode('menu', function ($atts, $content = null) {
	$params = shortcode_atts([
		'name' => ''
	], $atts);

	if (!$params['name']) {
		return '';
	}

	return wp_nav_menu([
		'menu' => $params['name'],
		'echo' => false
	]);
});

add_shortcode('table-icon', function ($attrs) {
	$params = shortcode_atts([
		'name' => 'yes'
	], $attrs);

	$svg_name = [
		'yes' => 'check',
		'no' => 'x'
	][$params['name']];
	$svg_classes = ['block-table__icon'];

	if (!$svg_name) {
		$svg_name = $params['name'];
	}

	if ($params['name'] === 'no') {
		$svg_classes[] = 'block-table__icon--x';
	}

	return '<div class="block-table__icon-container">' . SVG::get_svg('table-block/table_' . $svg_name, ['class' => implode(' ', $svg_classes)]) . '</div>';
});
