<?php

use WPUtil\{Component, SVG};
use PingCAP\Components;
use PingCAP\Integrations\Gartner;

add_shortcode('hubspot_form', function ($attrs, $content = '') {
	$params = shortcode_atts([
		'portal_id' => '',
		'form_id' => '',
		'salesforce_id' => '',
		'border' => '',
		'calendly_id' => '',
		'calendly_url' => '',
		'dark' => ''
	], $attrs);

	return Component::render_to_string(Components\HubSpotForm::class, [
		'portal_id' => $params['portal_id'],
		'form_id' => $params['form_id'],
		'salesforce_id' => $params['salesforce_id'],
		'border' => $params['border'],
		'dark' => $params['dark'],
		'calendly_id' => $params['calendly_id'],
		'calendly_url' => $params['calendly_url']
	]);
});

add_shortcode('video', function ($attrs, $content = '') {
	$params = shortcode_atts([
		'url' => '',
		'image' => '',
	], $attrs);

	return Component::render_to_string(Components\Video::class, [
		'url' => $params['url'],
		'image' => $params['image']
	]);
});

// Add menu shortcode that allows for adding a sitemap menu to WYSIWYG editors
add_shortcode('menu', function ($attrs, $content = null) {
	$params = shortcode_atts([
		'name' => ''
	], $attrs);

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

add_shortcode('svg', function ($attrs) {
	$params = shortcode_atts([
		'name' => '',
		'class' => '',
	], $attrs);

	return SVG::get_svg($params['name'], ['no_use' => true, 'class' => $params['class']]);
});

add_shortcode('gartner', function () {
	return Gartner::enqueueGartner();
});

add_shortcode('user_day_btn_anc', function () {
	return '<a href="#entry" class="a-button is-content-fit is-design-square is-type-grd-primary tw-font-bold js-scroll"><span class="a-button_inner "><span class="a-button_text">イベントの参加申込はこちら</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" class="style-svg"><rect width="20" height="20" style="fill:none;"></rect><path d="M8.74,13.34l-2.6-2.6c-.5-.5-1.3-.5-1.8,0s-.5,1.3,0,1.7h0l4.7,4.7c.3,.3,.7,.4,1,.4s.7-.1,.9-.4l4.7-4.7c.2-.2,.4-.5,.4-.9,0-.3-.1-.6-.4-.9-.2-.2-.6-.4-.9-.4s-.7,.1-.9,.4l-2.6,2.6V3.74c0-.3-.1-.6-.4-.9-.5-.5-1.3-.5-1.8,0-.1,.3-.3,.6-.3,.9V13.34h0Z" style="fill:#fff;"></path></svg></span></a>';
});

add_shortcode('pillar_cta', function ($attrs) {
	$params = shortcode_atts([
		'title' => '',
		'button_text' => '',
		'button_link' => '',
		'background' => '',
		'image' => '',
		'classes' => ''
	], $attrs);

	return Component::render_to_string(Components\PillarCTA::class, [
		'title' => $params['title'],
		'button_text' => $params['button_text'],
		'button_link' => $params['button_link'],
		'background' => $params['background'],
		'image' => $params['image'],
		'classes' => $params['classes']
	]);
});

add_shortcode('cost_estimation', function ($atts) {
	$atts = shortcode_atts([
		'custom-url' => '',
		'custom-secondary-url' => '',
		'product-type' => ''
	], $atts);

	wp_enqueue_style('cost-estimation-css');
	wp_enqueue_script('cost-estimation-js');

	$id = 'cost-estimation-widget';

	return '
    <div
      class="cost-estimation-widget"
	  data-custom-url="' . esc_attr($atts['custom-url']) . '"
	  data-custom-secondary-url="' . esc_attr($atts['custom-secondary-url']) . '"
	  data-product-type="' . esc_attr($atts['product-type']) . '"
    ></div>
  ';
});