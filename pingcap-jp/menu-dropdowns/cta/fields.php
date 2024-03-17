<?php
use PingCAP\Constants;
use WPUtil\Vendor;

$acf_group = Constants\ACF::MENU_DROPDOWN_CTA;

return array(
	array (
		'key' => 'field_' . $acf_group . '_products',
		'label' => 'Products',
		'name' => 'products',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => 2,
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Product',
		'sub_fields' => array_merge(
			array(
				array (
					'key' => 'field_' . $acf_group . '_product_icon',
					'label' => 'Icon',
					'name' => 'icon',
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
					'key' => 'field_' . $acf_group . '_product_name',
					'label' => 'Name',
					'name' => 'name',
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
					'key' => 'field_' . $acf_group . '_product_links',
					'label' => 'Links',
					'name' => 'links',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 1,
					'max' => '',
					'layout' => 'block',         // table | block | row
					'button_label' => 'Add Link',
					'sub_fields' => Vendor\BlueprintBlocks::safe_get_link_fields([
						'name' => 'link',
						'label' => 'Link',
						'includes' => [
							'page' => 'Page Link',
							'url' => 'URL'
						],
						'supports_button_styles' => false
					]),
				),
			),
		),
	),
);
