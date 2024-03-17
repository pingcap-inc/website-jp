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
		'default_value' => __('Open Positions', PingCAP\Constants\TextDomains::DEFAULT),
		'placeholder' => '',
		'formatting' => 'none', // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_' . $block . '_message',
		'label' => 'Lever Settings',
		'name' => 'message',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => 'Lever settings are configured on the "Theme Settings / Integrations / Lever" page.',
		'new_lines' => 'wpautop',    // wpautop | br | ''
		'esc_html' => 0,             // uses the WordPress esc_html function
	),
);

return array (
	'label' => 'Open Positions',
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
