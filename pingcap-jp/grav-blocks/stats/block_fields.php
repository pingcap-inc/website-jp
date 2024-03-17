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
		'key' => 'field_' . $block . '_display_mode',
		'label' => 'Display Mode',
		'name' => 'display_mode',
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
			'grid' => 'Grid',
			'carousel' => 'Content with Carousel'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal',
	),
	array (
		'key' => 'field_' . $block . '_content',
		'label' => 'Content',
		'name' => 'content',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_display_mode',
					'operator' => '==',
					'value' => 'carousel',
				),
			),
		),
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
		'key' => 'field_' . $block . '_stats',
		'label' => 'Stats',
		'name' => 'stats',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 1,
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
		'button_label' => 'Add Stat',
		'sub_fields' => PingCAP\Stats::getACFfields($block)
	),
);

return array (
	'label' => 'Stats',
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
