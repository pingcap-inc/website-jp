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
		'key' => 'field_' . $block . '_format',
		'label' => 'Format',
		'name' => 'format',
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
			'' => 'Sidebar Left',
			'column' => 'Column',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal'
	),
	array (
		'key' => 'field_' . $block . '_nav_title',
		'label' => 'Navigation Title',
		'name' => 'nav_title',
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
		'key' => 'field_' . $block . '_nav_title_desc',
		'label' => 'Navigation Title Desc',
		'name' => 'nav_title_desc',
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
		'key' => 'field_' . $block . '_nav_block_title',
		'label' => 'Navigation Block Title',
		'name' => 'nav_block_title',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_format',
					'operator' => '==',
					'value' => '',
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
		'key' => 'field_' . $block . '_nav_content',
		'label' => 'Navigation Content',
		'name' => 'nav_content',
		'type' => 'wysiwyg',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_format',
					'operator' => '==',
					'value' => '',
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
		'key' => 'field_' . $block . '_section_title_format',
		'label' => 'Tabs Button Format',
		'name' => 'format_title',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_format',
					'operator' => '==',
					'value' => 'column',
				),
			),
		),
		'wrapper' => array (
			'width' => '50',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'image' => 'Image',
			'text' => 'Title',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'image',
		'layout' => 'horizontal'
	),
	array (
		'key' => 'field_' . $block . '_section_column_format',
		'label' => 'Section column size',
		'name' => 'column_num',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_format',
					'operator' => '==',
					'value' => 'column',
				),
			),
		),
		'wrapper' => array (
			'width' => '50',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'12' => 'is-12(is-full)',
			'10' => 'is-10',
			'8' => 'is-8',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '12',
		'layout' => 'horizontal'
	),
	array (
		'key' => 'field_' . $block . '_sections',
		'label' => 'Sections',
		'name' => 'sections',
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
		'button_label' => 'Add Section',
		'sub_fields' => array (
			array (
				'key' => 'field_' . $block . '_section_title',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_format',
							'operator' => '==',
							'value' => '',
						),
					),
				),
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
				'key' => 'field_' . $block . '_section_image',
				'label' => 'Section Image',
				'name' => 'image',
				'instructions' => '',
				'type' => 'image',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_format',
							'operator' => '==',
							'value' => '',
						),
					),
				),
				'wrapper' => array (
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
			array (
				'key' => 'field_' . $block . '_section_title_text',
				'label' => 'Title',
				'name' => 'title_text',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_section_title_format',
							'operator' => '==',
							'value' => 'text',
						),
					),
				),
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
				'key' => 'field_' . $block . '_section_title_image',
				'label' => 'Title Image',
				'name' => 'title_image',
				'instructions' => '',
				'type' => 'image',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_section_title_format',
							'operator' => '==',
							'value' => 'image',
						),
					),
				),
				'wrapper' => array (
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
			array (
				'key' => 'field_' . $block . '_section_content',
				'label' => 'Section Content',
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
				'media_upload' => 1,
			),
		),
	),
);

return array (
	'label' => 'Tabs',
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
