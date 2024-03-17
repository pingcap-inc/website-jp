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
		'key' => 'field_' . $block . '_display_type',
		'label' => 'Display Type',
		'name' => 'display_type',
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
			'slim' => 'Slim (mid-page)',
			'normal' => 'Normal (bottom of page)'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'slim',
		'layout' => 'horizontal',
	),
	array (
		'key' => 'field_' . $block . '_slim_fields',
		'label' => 'Slim Display Type Fields',
		'name' => 'slim_fields',
		'type' => 'group',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_display_type',
					'operator' => '==',
					'value' => 'slim',
				),
			),
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => ''
		),
		'layout' => 'block',
		'sub_fields' => array(
			array (
				'key' => 'field_' . $block . '_slim_heading',
				'label' => 'Heading',
				'name' => 'heading',
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
				'key' => 'field_' . $block . '_bg_image',
				'label' => 'Background Image',
				'name' => 'bg_image',
				'instructions' => '',
				'type' => 'image',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
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
				'key' => 'field_' . $block . '_slim_text_align_mode',
				'label' => 'Text Align Mode',
				'name' => 'text_align_mode',
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
					'' => 'Left',
					'center' => 'Center',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => '',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_' . $block . '_slim_action_type',
				'label' => 'Action Type',
				'name' => 'action_type',
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
					'button' => 'Button',
					'form' => 'Email Subscribe'
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'button',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_' . $block . '_slim_button_fields',
				'label' => 'Button Fields',
				'name' => 'button_fields',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_slim_action_type',
							'operator' => '==',
							'value' => 'button',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => ''
				),
				'layout' => 'block',
				'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
					'name' => 'button',
					'label' => 'Button',
					'includes' => [
						'page' => 'Page Link',
						'url' => 'URL',
						'file' => 'File Download'
					],
					'supports_button_styles' => false
				])
			),
			array (
				'key' => 'field_' . $block . '_slim_hs_portal_id',
				'label' => 'Portal ID',
				'name' => 'hs_portal_id',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_slim_action_type',
							'operator' => '==',
							'value' => 'form',
						),
					),
				),
				'wrapper' => array (
					'width' => '50',
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
				'key' => 'field_' . $block . '_slim_hs_form_id',
				'label' => 'Form ID',
				'name' => 'hs_form_id',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_slim_action_type',
							'operator' => '==',
							'value' => 'form',
						),
					),
				),
				'wrapper' => array (
					'width' => '50',
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
				'key' => 'field_' . $block . '_slim_hs_email_field',
				'label' => 'HubSpot "Email" Field',
				'name' => 'hs_email_field',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array (
					array (
						array (
							'field' => 'field_' . $block . '_slim_action_type',
							'operator' => '==',
							'value' => 'form',
						),
					),
				),
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 'email',
				'placeholder' => '',
				'formatting' => 'none', // none | html
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
				'readonly' => 0,
				'disabled' => 0,
			)
		)
	),
	array (
		'key' => 'field_' . $block . '_normal_fields',
		'label' => 'Normal Display Type Fields',
		'name' => 'normal_fields',
		'type' => 'group',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_display_type',
					'operator' => '==',
					'value' => 'normal',
				),
			),
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => ''
		),
		'layout' => 'block',
		'sub_fields' => array(
			array (
				'key' => 'field_' . $block . '_normal_columns',
				'label' => 'Columns',
				'name' => 'columns',
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
				'max' => 2,
				'layout' => 'block',         // table | block | row
				'button_label' => 'Add Column',
				'sub_fields' => array (
					array (
						'key' => 'field_' . $block . '_normal_columns_column_title',
						'label' => 'Title',
						'name' => 'title',
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
						'key' => 'field_' . $block . '_normal_columns_column_icon_image',
						'label' => 'Icon Image',
						'name' => 'icon_image',
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
						'key' => 'field_' . $block . '_normal_columns_column_content',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
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
						'key' => 'field_' . $block . '_normal_columns_column_buttons',
						'label' => 'Buttons',
						'name' => 'buttons',
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
						'min' => '',
						'max' => '',
						'layout' => 'block',         // table | block | row
						'button_label' => 'Add Button',
						'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
							'name' => 'button',
							'label' => 'Button',
							'includes' => [
								'page' => 'Page Link',
								'url' => 'URL',
								'file' => 'File Download'
							],
							'supports_button_gtag' => true
						]),
					),
				),
			),
		)
	)
);

return array (
	'label' => 'Call To Action',
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
