<?php
$acf_group = 'event_calendar';

acf_add_local_field_group(array(
	'key' => 'group_' . $acf_group,
	'title' => 'Event Calendar',
	'fields' => array(
		array(
			'key' => 'field_' . $acf_group . '_date_start',
			'label' => 'Start Date',
			'name' => 'date_start',
			'type' => 'date_time_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => PingCAP\Constants\DateFormat::EVENT_CALENDAR,
			'return_format' => 'Y-m-d g:i a',
			'first_day' => 0,            // 0 = Sunday, 1 = Monday Etc.
		),
		array(
			'key' => 'field_' . $acf_group . '_date_end',
			'label' => 'End Date',
			'name' => 'date_end',
			'type' => 'date_time_picker',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'display_format' => PingCAP\Constants\DateFormat::EVENT_CALENDAR,
			'return_format' => 'Y-m-d g:i a',
			'first_day' => 0,            // 0 = Sunday, 1 = Monday Etc.
		),
		array(
			'key' => 'field_' . $acf_group . '_date_time_zone',
			'label' => 'Time Zone',
			'name' => 'date_time_zone',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'PST' => 'PST (UTC -8)',
				'PDT' => 'PDT (UTC -7)',
				'CST' => 'CST (UTC -6)',
				'EST' => 'EST (UTC -5)',
				'EDT' => 'EDT (UTC -4)',
				'CET' => 'CET (UTC +1)',
				'EET' => 'EET (UTC +2)',
				'CEST' => 'CEST (UTC +2)',
				'EEST' => 'EEST (UTC +3)',
				'IST' => 'IST (UTC +5:30)',
				'ICT' => 'ICT (UTC +7)',
				'WIT' => 'WIT (UTC +7)',
				'CST-2' => 'CST (UTC +8)',
				'SGT' => 'SGT (UTC +8)'
			),
			'default_value' => 'PST',
			'allow_null' => 0,
			'multiple' => 0,         // allows for multi-select
			'ui' => 0,               // creates a more stylized UI
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
			'return_format' => 'array',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => PingCAP\Constants\CPT::EVENT, // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
