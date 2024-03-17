<?php

use PingCAP\Constants;

$acf_group = 'post_display_region';

acf_add_local_field_group(array(
	'key' => 'group_' . $acf_group,
	'title' => 'Region Display Setting',
	'fields' => array(
		array(
			'key' => 'field_' . $acf_group . '_display_region',
			'label' => 'show in this region',
			'name' => 'display_region',
			'type' => 'checkbox',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => ''
			),
			'choices' => array(
				'apac' => 'APAC',
				'emea' => 'EMEA',
				'na' => 'NA',
			),
			'allow_custom' => 0,
			'default_value' => ['apac','emea','na'],
			'layout' => 'vertical',
			'toggle' => 0,
			'return_format' => 'value',
			'save_custom' => 0
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => Constants\CPT::EBOOK_WHITEPAPER, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		),
		array(
			array(
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => Constants\CPT::BLOG, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		),
	),
	'menu_order' => 0,
	'position' => 'side', // side | normal | acf_after_title
	'style' => 'default', // default | seamless
	'label_placement' => 'top', // top | left
	'instruction_placement' => 'label', // label | field
	'hide_on_screen' => array(
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
