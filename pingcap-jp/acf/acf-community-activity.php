<?php
$acf_group = 'community_activity';

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Community Activity Settings',
	'fields' => array (
		array (
		   'key' => 'field_' . $acf_group . '_date_start',
		   'label' => 'Start Date',
		   'name' => 'date_start',
		   'type' => 'date_picker',
		   'instructions' => '',
		   'required' => 1,
		   'conditional_logic' => 0,
		   'wrapper' => array (
			   'width' => '50',
			   'class' => '',
			   'id' => '',
		   ),
		   'display_format' => PingCAP\Constants\DateFormat::COMMUNITY_ACTIVITY,
		   'return_format' => 'Y-m-d',
		   'first_day' => 0,            // 0 = Sunday, 1 = Monday Etc.
		),
		array (
		   'key' => 'field_' . $acf_group . '_date_end',
		   'label' => 'End Date',
		   'name' => 'date_end',
		   'type' => 'date_picker',
		   'instructions' => '',
		   'required' => 1,
		   'conditional_logic' => 0,
		   'wrapper' => array (
			   'width' => '50',
			   'class' => '',
			   'id' => '',
		   ),
		   'display_format' => PingCAP\Constants\DateFormat::COMMUNITY_ACTIVITY,
		   'return_format' => 'Y-m-d',
		   'first_day' => 0,            // 0 = Sunday, 1 = Monday Etc.
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => PingCAP\Constants\CPT::COMMUNITY_ACTIVITY, // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
