<?php
use PingCAP\Constants;

$acf_group = 'case_study_featured';

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Featured Content Settings',
	'fields' => array (
		array (
			'key' => 'field_' . $acf_group . '_featured_content_type',
			'label' => 'Featured Content Type',
			'name' => 'featured_content_type',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'' => 'None',
				'testimonial' => 'Testimonial',
				'stats' => 'Statistics'
			),
			'default_value' => '',
			'allow_null' => 0,
			'multiple' => 0,         // allows for multi-select
			'ui' => 0,               // creates a more stylized UI
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_' . $acf_group . '_featured_testimonial_id',
			'label' => 'Testimonial',
			'name' => 'featured_testimonial_id',
			'type' => 'post_object',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_' . $acf_group . '_featured_content_type',
						'operator' => '==',
						'value' => 'testimonial',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => PingCAP\Constants\CPT::TESTIMONIAL,
			'taxonomy' => array (),
			'allow_null' => 0,
			'multiple' => 0,
			'return_format' => 'id',     // object | id
			'ui' => 1,
		),
		array (
			'key' => 'field_' . $acf_group . '_featured_stats',
			'label' => 'Statistics',
			'name' => 'featured_stats',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_' . $acf_group . '_featured_content_type',
						'operator' => '==',
						'value' => 'stats',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 1,
			'max' => 2,
			'layout' => 'block',         // table | block | row
			'button_label' => 'Add Statistic',
			'sub_fields' => array (
				array (
					'key' => 'field_' . $acf_group . '_featured_stat_value',
					'label' => 'Value',
					'name' => 'stat_value',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
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
				array (
					'key' => 'field_' . $acf_group . '_featured_stat_desc',
					'label' => 'Description',
					'name' => 'stat_desc',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
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
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => Constants\CPT::CASE_STUDY, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		)
	),
	'menu_order' => 0,
	'position' => 'side', // side | normal | acf_after_title
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
