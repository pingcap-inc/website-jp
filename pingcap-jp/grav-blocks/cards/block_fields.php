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
		'key' => 'field_' . $block . '_block_title',
		'label' => 'Block Title',
		'name' => 'block_title',
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
		'formatting' => 'none',       // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array(
		'key' => 'field_' . $block . '_block_title_desc',
		'label' => 'Block Title Desc',
		'name' => 'block_title_desc',
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
		'formatting' => 'none',       // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array(
		'key' => 'field_' . $block . '_card_num_cols',
		'label' => 'Card Column Num',
		'name' => 'card_num_cols',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array(
			'' => 'default',
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal',
	),
	array(
		'key' => 'field_' . $block . '_card_type',
		'label' => 'Card Type',
		'name' => 'card_type',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array(
			'' => 'Text Content',
			'media' => 'Media',
			'solution' => 'Solution',
			'integration' => 'Integration',
			'workload' => 'Workload',
			'bg' => 'Bg Color',
			'tier' => 'Tier',
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

	array(
		'key' => 'field_' . $block . '_default_cards',
		'label' => 'Cards',
		'name' => 'default_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => '',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_card_default_label',
					'label' => 'Label',
					'name' => 'label',
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
					'key' => 'field_' . $block . '_card_default_title',
					'label' => 'Title',
					'name' => 'title',
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
					'key' => 'field_' . $block . '_card_default_border_color',
					'label' => 'Card Border Color',
					'name' => 'border_color',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'' => 'Color',
						'border-color-gray' => 'Gray',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'horizontal',
				),
				array(
					'key' => 'field_' . $block . '_card_default_image_position',
					'label' => 'Icon position',
					'name' => 'image_position',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'' => 'Left',
						'column' => 'Top',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => '',
					'layout' => 'horizontal',
				),
				array(
					'key' => 'field_' . $block . '_card_default_svg_icon',
					'label' => 'Icon',
					'name' => 'svg_icon',
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
					'key' => 'field_' . $block . '_card_hide_content',
					'label' => 'Hide Content',
					'name' => 'hide_content',
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
					'key' => 'field_' . $block . '_card_default_content',
					'label' => 'Content',
					'name' => 'content',
					'type' => 'textarea',
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
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',        // wpautop | br | ''
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
				'label' => 'Link',
				'name' => 'button',
				'includes' => [
					'page' => 'Page Link',
					'url' => 'URL',
					'file' => 'File Download',
					'none' => 'None',
				],
				'supports_button_styles' => false
			])
		)
	),

	array(
		'key' => 'field_' . $block . '_solution_cards',
		'label' => 'Cards',
		'name' => 'solution_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => 'solution',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_card_illustration_file',
					'label' => 'Illustration File',
					'name' => 'illustration_file',
					'type' => 'file',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
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
				array(
					'key' => 'field_' . $block . '_card_illustration_title',
					'label' => 'Title',
					'name' => 'title',
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
			WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
				'label' => 'Link',
				'name' => 'link',
				'key_modifier' => 'illustration',
				'includes' => [
					'page' => 'Page Link',
					'url' => 'URL',
					'file' => 'File Download',
					'none' => 'None',
				],
				'supports_button_styles' => false,
				'show_text' => false
			])
		)
	),

	array(
		'key' => 'field_' . $block . '_integration_cards',
		'label' => 'Cards',
		'name' => 'integration_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => 'integration',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_card_integration_image',
					'label' => 'Image',
					'name' => 'image',
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
					'preview_size' => 'thumbnail',
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
					'key' => 'field_' . $block . '_card_integration_image_size',
					'label' => 'Enable Image Full Size',
					'name' => 'is_full',
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
					'key' => 'field_' . $block . '_card_integration_title',
					'label' => 'Title',
					'name' => 'title',
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
					'key' => 'field_' . $block . '_card_integration_content',
					'label' => 'Content',
					'name' => 'content',
					'type' => 'textarea',
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
					'maxlength' => '',
					'rows' => '',
					'new_lines' => 'wpautop',        // wpautop | br | ''
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
				'label' => 'Link',
				'name' => 'link',
				'key_modifier' => 'integration',
				'includes' => [
					'page' => 'Page Link',
					'url' => 'URL',
					'file' => 'File Download',
					'none' => 'None',
				],
				'supports_button_styles' => false,
				'show_text' => false
			])
		)
	),

	array(
		'key' => 'field_' . $block . '_bg_cards',
		'label' => 'Cards',
		'name' => 'bg_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => 'bg',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_card_bg_color',
					'label' => 'Card Bg Color',
					'name' => 'card_bg_color',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'red' => 'Red',
						'violet' => 'Violet',
						'blue' => 'Blue',
						'green' => 'Green'
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
				array(
					'key' => 'field_' . $block . '_card_bg_image',
					'label' => 'Image',
					'name' => 'image',
					'instructions' => '',
					'type' => 'image',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',       // array | url | id
					'preview_size' => 'thumbnail',
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
					'key' => 'field_' . $block . '_card_bg_title',
					'label' => 'Title',
					'name' => 'title',
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
					'key' => 'field_' . $block . '_card_bg_desc',
					'label' => 'Desc',
					'name' => 'desc',
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
					'formatting' => 'none', // none | html
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array(
					'key' => 'field_' . $block . '_has_demo',
					'label' => 'Has Demo',
					'name' => 'has_demo',
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
			),
			WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
				'label' => 'Link',
				'name' => 'link',
				'key_modifier' => 'bg',
				'includes' => [
					'page' => 'Page Link',
					'url' => 'URL',
					'none' => 'None',
				],
				'supports_button_styles' => false,
				'show_text' => true
			])
		)
	),

	array(
		'key' => 'field_' . $block . '_media_cards',
		'label' => 'Cards',
		'name' => 'media_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => 'media',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_has_border',
					'label' => 'Has Border',
					'name' => 'has_border',
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
					'key' => 'field_' . $block . '_item_icon_type',
					'label' => 'Icon type',
					'name' => 'icon_type',
					'type' => 'radio',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'image' => 'Image',
						'font' => 'Font',
					),
					'other_choice' => 0,
					'save_other_choice' => 0,
					'default_value' => 'image',
					'layout' => 'horizontal',
				),
				array(
					'key' => 'field_' . $block . '_item_icon_image',
					'label' => 'Icon Image',
					'name' => 'icon_image',
					'instructions' => '',
					'type' => 'image',
					'required' => 1,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_' . $block . '_item_icon_type',
								'operator' => '==',
								'value' => 'image',
							),
						),
					),
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'object',       // array | url | id
					'preview_size' => 'thumbnail',
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
					'key' => 'field_' . $block . '_item_icon_font',
					'label' => 'Icon Font',
					'name' => 'icon_font',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_' . $block . '_item_icon_type',
								'operator' => '==',
								'value' => 'font',
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
					'formatting' => 'none',       // none | html
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array(
					'key' => 'field_' . $block . '_item_title',
					'label' => 'Title',
					'name' => 'title',
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
					'formatting' => 'none',       // none | html
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array(
					'key' => 'field_' . $block . '_item_content',
					'label' => 'Content',
					'name' => 'content',
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
					'rows' => 4,
					'new_lines' => "\n",        // wpautop | br | ''
					'readonly' => 0,
					'disabled' => 0,
				),
			),
			WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
				'label' => 'Link',
				'name' => 'link',
				'includes' => [
					'none' => 'None',
					'page' => 'Page Link',
					'url' => 'URL'
				],
				'supports_button_styles' => false,
			])
		)
	),

	array(
		'key' => 'field_' . $block . '_workload_cards',
		'label' => 'Cards',
		'name' => 'workload_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => 'workload',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_item_image',
					'label' => 'Icon Image',
					'name' => 'image',
					'instructions' => '',
					'type' => 'image',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'array',       // array | url | id
					'preview_size' => 'thumbnail',
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
					'key' => 'field_' . $block . '_item_subtitle',
					'label' => 'Subtitle',
					'name' => 'subtitle',
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
					'formatting' => 'none',       // none | html
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array(
					'key' => 'field_' . $block . '_item_title',
					'label' => 'Title',
					'name' => 'title',
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
					'formatting' => 'none',       // none | html
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array(
					'key' => 'field_' . $block . '_item_content',
					'label' => 'Content',
					'name' => 'content',
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
					'rows' => 4,
					'new_lines' => "\n",        // wpautop | br | ''
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		)
	),

	array(
		'key' => 'field_' . $block . '_tier_cards',
		'label' => 'Tier Cards',
		'name' => 'tier_cards',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_card_type',
					'operator' => '==',
					'value' => 'tier',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => 'field_' . $block . '_card_title',
		'min' => 1,
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Card',
		'sub_fields' => array_merge(
			array(
				array(
					'key' => 'field_' . $block . '_card_tier_title',
					'label' => 'Title',
					'name' => 'title',
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
					'key' => 'field_' . $block . '_card_tier_subtitle',
					'label' => 'Sub Title',
					'name' => 'sub_title',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'height' => '20',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',         // all | visual | text
					'toolbar' => 'full',     // full | basic
					'media_upload' => 0,
				),
				array(
					'key' => 'field_' . $block . '_card_tier_button',
					'label' => 'Button',
					'name' => 'button',
					'type' => 'link',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'horizontal',
				),
				array(
					'key' => 'field_' . $block . '_card_tier_second_button',
					'label' => 'Second Button',
					'name' => 'second_button',
					'type' => 'link',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'horizontal',
				),
				array(
					'key' => 'field_' . $block . '_card_tier_content',
					'label' => 'Content',
					'name' => 'content',
					'type' => 'wysiwyg',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'tabs' => 'all',         // all | visual | text
					'toolbar' => 'full',     // full | basic
					'media_upload' => 1,
				),
				array(
					'key' => 'field_' . $block . '_set_price',
					'label' => 'Set Price',
					'name' => 'set_price',
					'type' => 'true_false',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '33',
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
					'key' => 'field_' . $block . '_tabs',
					'label' => 'Providers',
					'name' => 'tabs',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_' . $block . '_set_price',
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
					'collapsed' => '',
					'min' => 1,
					'max' => '',
					'layout' => 'block',         // table | block | row
					'button_label' => 'Add Provider',
					'sub_fields' => array(
						array(
							'key' => 'field_' . $block . '_provider_logo',
							'label' => 'Logo',
							'name' => 'logo',
							'instructions' => '',
							'type' => 'image',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'object',       // array | url | id
							'preview_size' => 'thumbnail',
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
							'key' => 'field_' . $block . '_tabs_content',
							'label' => 'Pricing',
							'name' => 'tabs_content',
							'type' => 'wysiwyg',
							'instructions' => '',
							'required' => 1,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'tabs' => 'all',         // all | visual | text
							'toolbar' => 'full',     // full | basic
							'media_upload' => 0,
						),
					),
				),
				array(
					'key' => 'field_' . $block . '_card_tier_link',
					'label' => 'Link',
					'name' => 'link',
					'type' => 'link',
					'required' => 0,
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
	),
	array(
		'key' => 'field_' . $block . '_view_more_button',
		'label' => 'View More Link',
		'name' => 'view_more_button',
		'type' => 'group',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
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
			'show_text' => false,
		])
	),
);

return array(
	'label' => 'Cards',
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
