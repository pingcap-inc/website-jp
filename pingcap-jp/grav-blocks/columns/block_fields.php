<?php
/*
*
* Gravitate Content Block
*
* Available Variables:
* $block 					= Name of Block Folder
* $block_backgrounds 		= Array for Background Options
* $block_background_image = Array for Background Image Option
*
* This file must return an array();
*
*/

$block_fields = array(
	array (
		'key' => 'field_' . $block . '_format',
		'label' => 'Format',
		'name' => 'format',
		'type' => 'radio',
		'instructions' => 'Note: This option is only available when using 2 columns',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_num_columns',
					'operator' => '==',
					'value' => 2,
				),
			),
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'' => 'Default',
			'sidebar-left' => 'Sidebar Left',
			'sidebar-right' => 'Sidebar Right'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal'
	),
	array (
		'key' => 'field_' . $block . '_enable_box_container',
		'label' => 'Enable Box Container',
		'name' => 'enable_box_container',
		'type' => 'true_false',
		'instructions' => '<strong>Note</strong>: The box will not be visible if the column count exceeds 2 columns.',
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
		'default_value' => 0,
	),
	array (
		'key' => 'field_' . $block . '_column_num',
		'label' => 'Column Num',
		'name' => 'column_num',
		'type' => 'radio',
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
		'choices' => array (
			'12' => 'is-12(full)',
			'10' => 'is-10',
			'8' => 'is-8',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '8',
		'layout' => 'horizontal'
	),
	array (
		'key' => 'field_' . $block . '_columns',
		'label' => 'Columns',
		'name' => 'columns',
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
		'button_label' => 'Add Column',
		'sub_fields' => array (
			array (
				'key' => 'field_' . $block . '_type',
				'label' => 'Column Type',
				'name' => 'type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array (
					'wysiwyg' => 'WYSIWYG editor',
					'accordion' => 'Accordion',
					'video' => 'Video'
				),
				'default_value' => 'wysiwyg',
				'allow_null' => 0,
				'multiple' => 0,         // allows for multi-select
				'ui' => 0,               // creates a more stylized UI
				'ajax' => 0,
				'placeholder' => '',
				'disabled' => 0,
				'readonly' => 0,
			),

			/**
			 * WYSIWYG fields
			 */
			array (
				'key' => 'field_' . $block . '_wysiwyg',
				'label' => 'WYSIWYG editor',
				'name' => 'wysiwyg',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_type',
							'operator' => '==',
							'value' => 'wysiwyg',
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
				'media_upload' => 1,
			),

			/**
			 * Accordion fields
			 */
			array (
				'key' => 'field_' . $block . '_accordion_column_title',
				'label' => 'Column Title',
				'name' => 'accordion_column_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_type',
							'operator' => '==',
							'value' => 'accordion',
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
				'key' => 'field_' . $block . '_accordion_sections',
				'label' => 'Accordion Sections',
				'name' => 'accordion_sections',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_type',
							'operator' => '==',
							'value' => 'accordion',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 1,
				'max' => '',
				'layout' => 'block',         // table | block | row
				'button_label' => 'Add Accordion Section',
				'sub_fields' => array (
					array (
						'key' => 'field_' . $block . '_accordion_section_title',
						'label' => 'Section Title',
						'name' => 'section_title',
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
					array (
						'key' => 'field_' . $block . '_accordion_section_content',
						'label' => 'Section Content',
						'name' => 'section_content',
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
				),
			),

			/**
			 * Video fields
			 */
			array (
				'key' => 'field_' . $block . '_video_image',
				'label' => 'Video Image',
				'name' => 'video_image',
				'instructions' => '',
				'type' => 'image',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_type',
							'operator' => '==',
							'value' => 'video',
						),
					),
				),
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
				'key' => 'field_' . $block . '_video_url',
				'label' => 'Video URL',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_type',
							'operator' => '==',
							'value' => 'video',
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
				'key' => 'field_' . $block . '_video_content',
				'label' => 'Video Content',
				'name' => 'video_content',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_type',
							'operator' => '==',
							'value' => 'video',
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
		),
	),
);

return array (
	'label' => 'Columns',
	'name' => $block,
	'display' => 'block',
	'min' => '',
	'max' => '',
	'sub_fields' => $block_fields,
	'grav_blocks_settings' => array(
		'version' => '2.0',
		'icon' => 'gravicon-content-2col',
		'description' => ''
	),
);
