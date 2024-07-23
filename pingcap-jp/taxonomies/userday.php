<?php
use PingCAP\Constants;

$single_label = 'New Event Tag';
$plural_label = 'New Event Tag';
$slug = Constants\Taxonomies::USERDAY;

register_taxonomy(
	$slug,
	[Constants\CPT::EVENT, 'page'],
	[
		'hierarchical' => true,
		'public' => true,
		'show_ui' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_in_rest' => true,
		'query_var' => true,
    "rest_controller_class" => "WP_REST_Terms_Controller",
		'labels' => [
			'name' => $plural_label,
			'singular_name' => $single_label,
			'search_items' => 'Search ' . $plural_label,
			'all_items' => 'All ' . $plural_label,
			'parent_item' => 'Parent ' . $single_label,
			'parent_item_colon' => 'Parent ' . $single_label . ':',
			'edit_item' => 'Edit ' . $single_label,
			'update_item' => 'Update ' . $single_label,
			'add_new_item' => 'Add New ' . $single_label,
			'new_item_name' => 'New ' . $single_label . ' Name'
		]
	]
);
