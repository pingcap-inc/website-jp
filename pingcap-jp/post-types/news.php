<?php
$single_label = 'News Item';
$plural_label = 'News';

register_post_type(
	PingCAP\Constants\CPT::NEWS,
	[
		'label' => $plural_label,
		'description' => '',
		'public' => false,
		'publicly_queryable'  => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'capability_type' => 'page',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => [
			'with_front' => false,
			'slug' => PingCAP\Constants\CPT::NEWS
		],
		'query_var' => true,
		'exclude_from_search' => false,
		'can_export' => true,
		'has_archive' => 'in-the-news',
		'menu_icon' => 'dashicons-portfolio',
		'supports' => ['title', 'excerpt', 'thumbnail'],
		'taxonomies' => [],
		'labels' => [
			'name' => $plural_label,
			'singular_name' => $single_label,
			'menu_name' => $plural_label,
			'add_new' => 'Add ' . $single_label,
			'add_new_item' => 'Add New ' . $single_label,
			'edit' => 'Edit',
			'edit_item' => 'Edit ' . $single_label,
			'new_item' => 'New ' . $single_label,
			'view' => 'View ' . $single_label,
			'view_item' => 'View ' . $single_label,
			'search_items' => 'Search ' . $plural_label,
			'not_found' => 'No ' . $plural_label . ' Found',
			'not_found_in_trash' => 'No ' . $plural_label . ' Found in Trash',
			'parent' => 'Parent ' . $single_label,
		]
	]
);
