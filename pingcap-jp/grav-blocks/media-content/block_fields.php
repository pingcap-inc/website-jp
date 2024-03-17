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
	array (
		'key' => 'field_' . $block . '_bg',
		'label' => 'Background Image',
		'name' => 'block_bg',
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
		'key' => 'field_' . $block . '_bg_mobile',
		'label' => 'Background Image (mobile)',
		'name' => 'block_bg_mobile',
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
		'key' => 'field_' . $block . '_content',
		'label' => 'Content',
		'name' => 'content',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'tabs' => 'all',         // all | visual | text
		'toolbar' => 'full',     // full | basic
		'media_upload' => 0,
	),
	array (
		'key' => 'field_' . $block . '_center_content',
		'label' => 'Vertically Center Content',
		'name' => 'center_content',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '50',
			'class' => '',
			'id' => '',
		),
		'message' => '',
		'ui' => 1,
		'ui_on_text' => 'Yes',
		'ui_off_text' => 'No',
		'default_value' => 1,
	),
	array (
		'key' => 'field_' . $block . '_image',
		'label' => 'Image',
		'name' => 'image',
		'instructions' => '',
		'type' => 'image',
		'required' => 1,
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
		'key' => 'field_' . $block . '_image_size',
		'label' => 'Image Size',
		'name' => 'image_size',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '50',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'small' => 'Small',
			'medium' => 'Medium',
			'large' => 'Large',
			'xlarge' => 'Extra Large'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'medium',
		'layout' => 'horizontal',
	),
	array (
		'key' => 'field_' . $block . '_image_alignment',
		'label' => 'Image Alignment',
		'name' => 'image_alignment',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '50',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'left' => 'Left',
			'right' => 'Right'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'right',
		'layout' => 'horizontal',
	),
	array (
		'key' => 'field_' . $block . '_constrain_image',
		'label' => 'Constrain Image',
		'name' => 'constrain_image',
		'type' => 'true_false',
		'instructions' => 'If enabled, this option will prevent the image from exceeding a height relative to the content height.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
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
	array (
		'key' => 'field_' . $block . '_image_shadow',
		'label' => 'Enable Image Shadow',
		'name' => 'image_shadow',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
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
);

$block_fields = array_merge(
	$block_fields,
	WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
		'label' => 'Image Link',
		'name' => 'image_link',
		'show_text' => false,
		'supports_button_styles' => false
	])
);

return array (
	'label' => 'Media with Content',
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
