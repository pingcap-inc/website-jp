<?php

use WPUtil\Vendor;

$acf_group = 'menu_dropdown_columns';

return array(
	array (
		'key' => 'field_' . $acf_group . '_featured_format',
		'label' => 'Format',
		'name' => 'format',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'' => 'Sidebar Left',
			'sidebar-right' => 'Sidebar Right'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal'
	),
	array(
		'key' => 'field_' . $acf_group . '_featured_products',
		'label' => 'Featured Products',
		'name' => 'featured_products',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => 'field_' . $acf_group . '_featured_product_icon',
		'min' => 0,
		'max' => 4,
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Featured Product',
		'sub_fields' =>
		array(
			array(
				'key' => 'field_' . $acf_group . '_featured_product_icon',
				'label' => 'Icon',
				'name' => 'icon',
				'instructions' => '',
				'type' => 'image',
				'required' => 0,
				'conditional_logic' => 0,
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
				'key' => 'field_' . $acf_group . '_featured_product_name',
				'label' => 'Name',
				'name' => 'name',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
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
				'key' => 'field_' . $acf_group . '_featured_product_description',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',        // wpautop | br | ''
				'readonly' => 0,
				'disabled' => 0,
			),
			array(
				'key' => 'field_' . $acf_group . '_product_link',
				'label' => 'Link',
				'name' => 'product_link',
				'type' => 'link',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'return_format' => 'array',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
		),
	),

	array(
		'key' => 'field_' . $acf_group . '_link_columns',
		'label' => 'Link Columns',
		'name' => 'link_columns',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => 'field_' . $acf_group . '_link_column_label',
		'min' => 1,
		'max' => 3,
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Link Columns',
		'sub_fields' => array(
			array(
				'key' => 'field_' . $acf_group . '_link_column_label',
				'label' => 'Label',
				'name' => 'label',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
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
				'key' => 'field_' . $acf_group . '_link_column_links',
				'label' => 'Links',
				'name' => 'links',
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
				'min' => '',
				'max' => '',
				'layout' => 'block',         // table | block | row
				'button_label' => 'Add Link',
				'sub_fields' => array_merge(
					array(
						array(
							'key' => 'field_' . $acf_group . '_link_column_icon',
							'label' => 'Icon',
							'name' => 'icon',
							'instructions' => '',
							'type' => 'text',
							'instructions' => '',
							'required' => 1,
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
					),
					Vendor\BlueprintBlocks::safe_get_link_fields([
						'name' => 'link',
						'label' => 'Link',
						'includes' => [
							'page' => 'Page Link',
							'url' => 'URL'
						],
						'supports_button_styles' => false
					])
				),
			),
		),
	),
);
