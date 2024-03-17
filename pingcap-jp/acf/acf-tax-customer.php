<?php
$acf_group = 'customer';

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Customer Settings',
	'fields' => array (
		array (
			'key' => 'field_' . $acf_group . '_logo',
			'label' => 'Logo',
			'name' => 'logo',
			'instructions' => '',
			'type' => 'image',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'object',       // array | url | id
			'preview_size' => 'medium',
			'library' => 'all',       // all | uploadedTo
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_' . $acf_group . '_logo_dark',
			'label' => 'Logo (in dark bg)',
			'name' => 'logo_dark',
			'instructions' => '',
			'type' => 'image',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'object',       // array | url | id
			'preview_size' => 'medium',
			'library' => 'all',       // all | uploadedTo
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'taxonomy', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => PingCAP\Constants\Taxonomies::CUSTOMER, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		)
	),
	'menu_order' => 0,
	'position' => 'normal', // side | normal | acf_after_title
	'style' => 'default', // default | seamless
	'label_placement' => 'top', // top | left
	'instruction_placement' => 'label', // label | field
	'hide_on_screen' => array (
		// 0 => 'permalink',
		// 1 => 'the_content',
		// 2 => 'excerpt',
		// 3 => 'custom_fields',
		// 4 => 'discussion',
		// 5 => 'comments',
		// 6 => 'revisions',
		// 7 => 'slug',
		// 8 => 'author',
		// 9 => 'format',
		// 10 => 'featured_image',
		// 11 => 'categories',
		// 12 => 'tags',
		// 13 => 'send-trackbacks'
	),
	'active' => 1,
	'description' => ''
));
