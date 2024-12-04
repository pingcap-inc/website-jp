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
		'formatting' => 'none', // none | html
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
		'formatting' => 'none', // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array(
		'key' => 'field_' . $block . '_column_count',
		'label' => 'Columns',
		'name' => 'column_count',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '50',
			'class' => '',
			'id' => '',
		),
		'choices' => array(
			2 => 'Two',
			3 => 'Three',
			4 => 'Four'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal',
	),
	array(
		'key' => 'field_' . $block . '_center_content',
		'label' => 'Center Content',
		'name' => 'center_content',
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
		'key' => 'field_' . $block . '_grid_items',
		'label' => 'Grid Items',
		'name' => 'grid_items',
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
		'button_label' => 'Add Grid Item',
		'sub_fields' => array(
			array(
				'key' => 'field_' . $block . '_item_icon_image',
				'label' => 'Icon Image',
				'name' => 'icon_image',
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
				'key' => 'field_' . $block . '_item_icon_size',
				'label' => 'Icon Image Size',
				'name' => 'icon_size',
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
					'is-40x40' => '40 x 40',
					'is-50x50' => '50 x 50',
					'is-80x80' => '80 x 80',
					'is-128x128' => '128 x 128',
					'is-150x150' => '150 x 150',
					'is-180x120' => '180 x 120',
				),
				'default_value' => 'is-80x80',
				'allow_null' => 0,
				'multiple' => 0,         // allows for multi-select
				'ui' => 0,               // creates a more stylized UI
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),
			array(
				'key' => 'field_' . $block . '_item_content',
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
				'media_upload' => 0,
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
		])
	),
);

return array(
	'label' => 'Icon Grid',
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
