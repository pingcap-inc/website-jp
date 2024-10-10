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
		'key' => 'field_' . $block . '_has_block_title',
		'label' => 'Has Block Title',
		'name' => 'has_block_title',
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
		'key' => 'field_' . $block . '_block_title',
		'label' => 'Block Title',
		'name' => 'block_title',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $block . '_has_block_title',
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
		'default_value' => '',
		'tabs' => 'all',         // all | visual | text
		'toolbar' => 'full',     // full | basic
		'media_upload' => 1,
	),
	array(
		'key' => 'field_' . $block . '_format',
		'label' => 'Format',
		'name' => 'format',
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
			'default' => 'Default',
			'side' => 'Sidebar Left',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'default',
		'layout' => 'horizontal'
	),
	array(
		'key' => 'field_' . $block . '_section_title_format',
		'label' => 'Tabs Nav Format',
		'name' => 'format_title',
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
			'title' => 'Title',
			'content' => 'Content',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'image',
		'layout' => 'horizontal'
	),
	array(
		'key' => 'field_' . $block . '_sections',
		'label' => 'Sections',
		'name' => 'sections',
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
		'button_label' => 'Add Section',
		'sub_fields' => array(
			array(
				'key' => 'field_' . $block . '_section_title',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_' . $block . '_section_title_format',
							'operator' => '==',
							'value' => 'title',
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
				'formatting' => 'none', // none | html
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			),
			array(
				'key' => 'field_' . $block . '_title_content',
				'label' => 'Nav Content',
				'name' => 'title_content',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_' . $block . '_section_title_format',
							'operator' => '==',
							'value' => 'content',
						),
					),
				),
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
				'key' => 'field_' . $block . '_section_content',
				'label' => 'Section Content',
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
		),
	),
);

return array(
	'label' => 'Tabs Slide',
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
