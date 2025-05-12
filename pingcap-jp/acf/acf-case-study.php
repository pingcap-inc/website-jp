<?php

use PingCAP\Constants;

$acf_group = 'case_study';

acf_add_local_field_group(array(
	'key' => 'group_' . $acf_group,
	'title' => 'Case Study Settings',
	'fields' => array(
		array(
			'key' => 'field_' . $acf_group . '_sidebar_stats',
			'label' => 'Sidebar Statistics',
			'name' => 'sidebar_stats',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'block',         // table | block | row
			'button_label' => 'Add Sidebar Statistic',
			'sub_fields' => PingCAP\Stats::getACFfields($acf_group, false),
		),
		array(
			'key' => 'field_' . $acf_group . '_no_permalink',
			'label' => 'No Permalink',
			'name' => 'no_permalink',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_url',
			'label' => 'Case Study Item URL',
			'name' => 'url',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'formatting' => 'none', // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_enable_video',
			'label' => 'Has Tech Talk',
			'name' => 'has_video',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_video_url',
			'label' => 'Video URL',
			'name' => 'video_url',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_enable_video',
						'operator' => '==',
						'value' => 1,
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'formatting' => 'none', // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => Constants\CPT::CASE_STUDY, // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
