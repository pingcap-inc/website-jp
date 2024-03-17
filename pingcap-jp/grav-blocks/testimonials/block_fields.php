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
		'key' => 'field_' . $block . '_block_title',
		'label' => 'Block Title',
		'name' => 'block_title',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
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
		'key' => 'field_' . $block . '_title_link_values',
		'label' => 'Title Link Fields',
		'name' => 'title_link_values',
		'type' => 'group',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
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
	array (
		'key' => 'field_' . $block . '_testimonials',
		'label' => 'Testimonials',
		'name' => 'testimonials',
		'type' => 'relationship',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => PingCAP\Constants\CPT::TESTIMONIAL,
		'taxonomy' => array (
		),
		'filters' => ['search'],
		'elements' => '',
		'min' => 1,
		'max' => '',
		'return_format' => 'id',     // object | id
	),
	array (
		'key' => 'field_' . $block . '_transition_speed',
		'label' => 'Transition Speed',
		'name' => 'transition_speed',
		'type' => 'number',
		'instructions' => 'Control the transition speed of slides using a value of 1 (slowest) to 20 (fastest).',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '33',
			'class' => '',
			'id' => '',
		),
		'default_value' => 10,
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'min' => 1,
		'max' => 20,
		'step' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_' . $block . '_enable_autoplay',
		'label' => 'Enable Autoplay',
		'name' => 'enable_autoplay',
		'type' => 'true_false',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '33',
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
		'key' => 'field_' . $block . '_autoplay_speed',
		'label' => 'Autoplay Speed',
		'name' => 'autoplay_speed',
		'type' => 'number',
		'instructions' => 'The amount of time each slide is displayed in milliseconds',
		'required' => 1,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_enable_autoplay',
					'operator' => '==',
					'value' => 1,
				),
			),
		),
		'wrapper' => array (
			'width' => '33',
			'class' => '',
			'id' => '',
		),
		'default_value' => 3000,
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'min' => '',
		'max' => '',
		'step' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_' . $block . '_adaptive_slide_heights',
		'label' => 'Adaptive Slide Heights',
		'name' => 'adaptive_slide_heights',
		'type' => 'true_false',
		'instructions' => 'If this block is configured to use autoplay it\'s recommended to disable adaptive slide heights so the content below this block doesn\'t vertically shift during the automatic slide transitions.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
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
);

return array (
	'label' => 'Testimonials',
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
