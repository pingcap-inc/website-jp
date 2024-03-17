<?php
/*
* Gravitate Content Block
*
* Available Variables:
* $block                  = Name of Block Folder
* $block_backgrounds      = Array for Background Options
* $block_background_image = Array for Background Image Option
*
* This file must return an array();
*/

$block_fields = array(
	array(
		'key' => 'field_' . $block . '_title',
		'label' => 'Block Title',
		'name' => 'title',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '50',
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
		'key' => 'field_' . $block . '_enabled_logo_animation',
		'label' => 'Enabled Logo Animation',
		'name' => 'enabled_animation',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '50',
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
		'key' => 'field_' . $block . '_title_desc',
		'label' => 'Block Title Desc',
		'name' => 'title_desc',
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
		'key' => 'field_' . $block . '_customers',
		'label' => 'Customers',
		'name' => 'customers',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Customer',
		'sub_fields' => array(
			array(
				'key' => 'field_' . $block . '_logo_image',
				'label' => 'Logo Image',
				'name' => 'logo_image',
				'instructions' => '',
				'type' => 'image',
				'required' => 1,
				'conditional_logic' => '',
				'wrapper' => array(
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
			array(
				'key' => 'field_' . $block . '_link_to_case_study',
				'label' => 'Link to Case Study',
				'name' => 'link_to_case_study',
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
				'default_value' => 1,
			),
			array(
				'key' => 'field_' . $block . '_customer_term_id',
				'label' => 'Customer',
				'name' => 'customer_term_id',
				'type' => 'taxonomy',
				'taxonomy' => PingCAP\Constants\Taxonomies::CUSTOMER,
				'field_type' => 'select',       // checkbox | multi_select | radio | select
				'multiple' => 0,
				'allow_null' => 0,
				'return_format' => 'id',        // object | id
				'add_term' => 0,
				'load_terms' => 0,
				'save_terms' => 0,
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_' . $block . '_link_to_case_study',
							'operator' => '==',
							'value' => 1,
						)
					)
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),
			array(
				'key' => 'field_' . $block . '_logo_link',
				'label' => 'Logo Link',
				'name' => 'logo_link',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_' . $block . '_link_to_case_study',
							'operator' => '==',
							'value' => 0,
						)
					)
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => ''
				),
				'layout' => 'block',
				'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
					'label' => 'Link',
					'name' => 'link',
					'includes' => [
						'page' => 'Page Link',
						'url' => 'URL',
						'none' => 'None',
					],
					'supports_button_styles' => false,
					'show_text' => false,
				])
			),
		),
	),
	array(
		'key' => 'field_' . $block . '_view_more_button',
		'label' => 'View More Link',
		'name' => 'view_more_button',
		'type' => 'group',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => '',
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => ''
		),
		'layout' => 'block',
		'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
			'label' => 'Title Link',
			'name' => 'title_link',
			'includes' => [
				'none' => 'None',
				'page' => 'Page Link',
				'url' => 'URL'
			],
			'supports_button_styles' => false,
			'show_text' => true,
		])
	),
);

return array(
	'label' => 'Logos',
	'name' => $block,
	'display' => 'block',
	'min' => '',
	'max' => '',
	'sub_fields' => $block_fields,
	'grav_blocks_settings' => array(
		'icon' => 'gravicon-title',
		'description' => ''
	)
);
