<?php
use PingCAP\Constants;
use WPUtil\Vendor;

$acf_group = Constants\ACF::MENU_DROPDOWN_SOLUTIONS;

return array(
	array (
		'key' => 'field_' . $acf_group . '_solution_cards',
		'label' => 'Solution Cards',
		'name' => 'solution_cards',
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
		'max' => 4,
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Solution Card',
		'sub_fields' => array_merge(
			array(
				array (
					'key' => 'field_' . $acf_group . '_solution_card_illustration_file',
					'label' => 'Illustration File',
					'name' => 'illustration_file',
					'type' => 'file',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',      // array | url | id
					'library' => 'all',              // all | uploadedTo
					'min_size' => '',
					'max_size' => '',
					'mime_types' => 'mp4,png,jpg,jpeg,gif,webp',
				),
				array (
					'key' => 'field_' . $acf_group . '_solution_card_title',
					'label' => 'Title',
					'name' => 'title',
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
			Vendor\BlueprintBlocks::safe_get_link_fields([
				'name' => 'link',
				'label' => 'Link',
				'includes' => [
					'page' => 'Page Link',
					'url' => 'URL'
				],
				'show_text' => false,
				'supports_button_styles' => false
			])
		),
	),
);
