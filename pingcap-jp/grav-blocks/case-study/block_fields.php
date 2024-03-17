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
		'key' => 'field_' . $block . '_case_study_id',
		'label' => 'Case Study',
		'name' => 'case_study_id',
		'type' => 'post_object',
		'instructions' => 'Note: Text content for this block is pulled from the excerpt of the selected case study. The case study "Featured Content Settings" will determine what content is shown on the right side of this block.',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => PingCAP\Constants\CPT::CASE_STUDY,
		'taxonomy' => array (),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'id',     // object | id
		'ui' => 1,
	),
	array (
		'key' => 'field_' . $block . '_link_text',
		'label' => 'Link Text',
		'name' => 'link_text',
		'type' => 'text',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => __('Full Case Study', PingCAP\Constants\TextDomains::DEFAULT),
		'placeholder' => '',
		'formatting' => 'none', // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
);

return array (
	'label' => 'Case Study',
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
