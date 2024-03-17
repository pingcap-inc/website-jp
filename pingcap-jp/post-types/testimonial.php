<?php
$single_label = 'Testimonial';
$plural_label = 'Testimonials';

register_post_type(
	PingCAP\Constants\CPT::TESTIMONIAL,
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
			'slug' => PingCAP\Constants\CPT::TESTIMONIAL
		],
		'query_var' => true,
		'exclude_from_search' => false,
		'can_export' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-testimonial',
		'supports' => ['title', 'thumbnail'],
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
