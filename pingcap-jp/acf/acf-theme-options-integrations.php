<?php
use PingCAP\Constants;

$acf_group = Constants\ACF::THEME_OPTIONS_INTEGRATIONS_BASE;

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Integrations',
	'fields' => array (
		array (
			'key' => 'field_' . $acf_group . '_tab_lever',
			'label' => 'Lever',
			'name' => $acf_group . '_tab_lever',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,          // end tabs to start a new group
		),
		array (
			'key' => 'field_' . $acf_group . '_lever_json_postings_url',
			'label' => 'JSON postings URL',
			'name' => $acf_group . '_lever_json_postings_url',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => Constants\DefaultValues::LEVER_POSTINGS_JSON_URL,
			'placeholder' => '',
			'formatting' => 'none', // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_' . $acf_group . '_lever_cache_time_minutes',
			'label' => 'Cache duration for JSON posting results in minutes',
			'name' => $acf_group . '_lever_cache_time_minutes',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => Constants\DefaultValues::LEVER_CACHE_TIME_MIN,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => 'acf-theme-options-integrations',        // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1,
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',                 // side | normal | acf_after_title
	'style' => 'default',                    // default | seamless
	'label_placement' => 'top',                // top | left
	'instruction_placement' => 'label',     // label | field
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
	  // 13 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));
