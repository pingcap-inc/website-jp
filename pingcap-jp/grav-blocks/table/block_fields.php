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
		'key' => 'field_' . $block . '_block_instructions',
		'label' => 'Block Instructions',
		'name' => 'block_instructions',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => 'In order for this block to display content correctly, the number of "Row Values" within each column must be the same as the number of "Row Titles". The number to the left of each "Row Titles" item and each column "Row Values" item cooresponds to the row number in which the value will be displayed.',
		'new_lines' => 'wpautop',    // wpautop | br | ''
		'esc_html' => 0,             // uses the WordPress esc_html function
	),
	array (
		'key' => 'field_' . $block . '_first_col_title',
		'label' => 'First Column Title',
		'name' => 'first_col_title',
		'type' => 'text',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => __('Feature', PingCAP\Constants\TextDomains::DEFAULT),
		'placeholder' => '',
		'formatting' => 'none', // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_' . $block . '_row_titles',
		'label' => 'Row Titles',
		'name' => 'row_titles',
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
		'button_label' => 'Add Row Title',
		'sub_fields' => array (
			array (
				'key' => 'field_' . $block . '_row_title_value',
				'label' => 'Title',
				'name' => 'title',
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
		),
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
		'max' => 6,
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Column',
		'sub_fields' => array (
			array (
				'key' => 'field_' . $block . '_column_title',
				'label' => 'Column Title',
				'name' => 'title',
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
				'key' => 'field_' . $block . '_column_row_values',
				'label' => 'Row Values',
				'name' => 'row_values',
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
				'button_label' => 'Add Row Value',
				'sub_fields' => array (
					array (
						'key' => 'field_' . $block . '_row_value_type',
						'label' => 'Value Type',
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
							'text' => 'Text',
							'checkmark' => 'Checkmark'
						),
						'default_value' => 'text',
						'allow_null' => 0,
						'multiple' => 0,         // allows for multi-select
						'ui' => 0,               // creates a more stylized UI
						'ajax' => 0,
						'placeholder' => '',
						'disabled' => 0,
						'readonly' => 0,
					),
					array (
						'key' => 'field_' . $block . '_row_value_text',
						'label' => 'Text Value',
						'name' => 'text',
						'type' => 'text',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => array (
							array (
								array (
									'field' => 'field_' . $block . '_row_value_type',
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
						'key' => 'field_' . $block . '_row_value_checkmark',
						'label' => 'Checkmark Value',
						'name' => 'checkmark',
						'type' => 'true_false',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array (
							array (
								array (
									'field' => 'field_' . $block . '_row_value_type',
									'operator' => '==',
									'value' => 'checkmark',
								),
							),
						),
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
				),
			),
		),
	),
);

return array (
	'label' => 'Table',
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
