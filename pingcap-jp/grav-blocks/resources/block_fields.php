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
		'default_value' => 'Related Resources',
		'placeholder' => '',
		'formatting' => 'none',       // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_' . $block . '_block_title_desc',
		'label' => 'Block Title Desc',
		'name' => 'block_title_desc',
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
		'formatting' => 'none',       // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
	   'key' => 'field_' . $block . '_view_all_enabled',
	   'label' => 'Enable \'View All\' Button',
	   'name' => 'view_all_enabled',
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
	   'default_value' => 0,
	),
	array (
		'key' => 'field_' . $block . '_view_all_text',
		'label' => '\'View All\' Button Text',
		'name' => 'view_all_text',
		'type' => 'text',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_view_all_enabled',
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
		'default_value' => 'View All',
		'placeholder' => '',
		'formatting' => 'none',       // none | html
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_' . $block . '_view_all_link_type',
		'label' => '\'View All\' Link Type',
		'name' => 'view_all_link_type',
		'type' => 'select',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '34',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'' => 'Auto',
			'blog' => 'Blog Archive',
			'training' => 'Training Archive',
			'event' => 'Events Archive',
			'resources' => 'Resources Landing',
			'press-releases' => 'Press Releases',
			'ebooks-whitepapers' => 'eBooks & Whitepapers'
		),
		'default_value' => '',
		'allow_null' => 0,
		'multiple' => 0,         // allows for multi-select
		'ui' => 0,               // creates a more stylized UI
		'ajax' => 0,
		'placeholder' => '',
		'disabled' => 0,
		'readonly' => 0,
	),
	array (
		'key' => 'field_' . $block . '_relationship_source',
		'label' => 'Relationship Source',
		'name' => 'relationship_source',
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
			'' => 'Most recent resources',
			'tag' => 'Related to current tag(s)',
			'category' => 'Related to current category',
			'custom_tag' => 'Related to specific tags',
			'custom_category' => 'Related to specific categories',
			'custom' => 'Custom'
		),
		'default_value' => '',
		'allow_null' => 0,
		'multiple' => 0,         // allows for multi-select
		'ui' => 0,               // creates a more stylized UI
		'ajax' => 0,
		'placeholder' => '',
		'disabled' => 0,
		'readonly' => 0,
	),
	array (
		'key' => 'field_' . $block . '_num_results',
		'label' => 'Number of Results',
		'name' => 'num_results',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '!=',
					'value' => 'custom',
				),
			),
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			3 => '3',
			6 => '6'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 3,
		'layout' => 'horizontal',
	),
	array (
		'key' => 'field_' . $block . '_note_automatic_relationship',
		'label' => 'Note',
		'name' => 'note_automatic_relationship',
		'type' => 'message',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'tag',
				),
			),
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'category',
				),
			),
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'message' => 'The related to current tag(s) and category options will only work if this block is being used within a blog, training, or event post. They will not work if this block is used on a page or any other type of content.',
		'new_lines' => 'wpautop',    // wpautop | br | ''
		'esc_html' => 0,             // uses the WordPress esc_html function
	),
	array (
		'key' => 'field_' . $block . '_custom_tag',
		'label' => 'Custom Tag(s)',
		'name' => 'custom_tag',
		'type' => 'taxonomy',
		'taxonomy' => PingCAP\Constants\Taxonomies::BLOG_TAG,
		'field_type' => 'checkbox',       // checkbox | multi_select | radio | select
		'multiple' => 1,
		'allow_null' => 0,
		'return_format' => 'id',        // object | id
		'add_term' => 0,
		'load_terms' => 0,
		'save_terms' => 0,
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'custom_tag',
				)
			)
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
	),
	array (
		'key' => 'field_' . $block . '_custom_category',
		'label' => 'Custom Category',
		'name' => 'custom_category',
		'type' => 'taxonomy',
		'taxonomy' => PingCAP\Constants\Taxonomies::BLOG_CATEGORY,
		'field_type' => 'checkbox',       // checkbox | multi_select | radio | select
		'multiple' => 1,
		'allow_null' => 0,
		'return_format' => 'id',        // object | id
		'add_term' => 0,
		'load_terms' => 0,
		'save_terms' => 0,
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'custom_category',
				)
			)
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
	),
	array (
		'key' => 'field_' . $block . '_custom_resource_ids',
		'label' => 'Custom Resources',
		'name' => 'custom_resource_ids',
		'type' => 'relationship',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'custom',
				)
			)
		),
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => PingCAP\CPT\Resources::getResourcePostTypes(),
		'taxonomy' => array (),
		'filters' => ['search', 'post_type', 'taxonomy'],
		'elements' => '',
		'min' => 1,
		'max' => 6,
		'return_format' => 'id',     // object | id
	),
	array (
		'key' => 'field_' . $block . '_fill_remaining_resources',
		'label' => 'Fill Remaining Resources',
		'name' => 'fill_remaining_resources',
		'type' => 'true_false',
		'instructions' => 'If not enough resource posts are found using the relationship source, the total amount of posts required by this block will be filled using the most recent resources.',
		'required' => 0,
		'conditional_logic' => array (
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'tag',
				),
			),
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'category',
				),
			),
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'custom_tag',
				),
			),
			array (
				array (
					'field' => 'field_' . $block . '_relationship_source',
					'operator' => '==',
					'value' => 'custom_category',
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
		'default_value' => 1,
	),
);

return array (
	'label' => 'Resources',
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
