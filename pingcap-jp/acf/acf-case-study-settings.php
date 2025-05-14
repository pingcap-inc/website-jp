<?php

use PingCAP\Constants;

$acf_group = Constants\ACF::CASE_STUDY_SETTINGS_BASE;

acf_add_local_field_group(array(
	'key' => 'group_' . $acf_group,
	'title' => 'Case Study Settings',
	'fields' => array(
		/**
		 * Tab: Case Study Archive
		 */
		array(
			'key' => 'field_' . $acf_group . '_tab_case_study_archive',
			'label' => 'Case Study Archive',
			'name' => 'tab_case_study_archive',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,          // end tabs to start a new group
		),
		array(
			'key' => 'field_' . $acf_group . '_archive_title',
			'label' => 'Archive Title',
			'name' => $acf_group . '_archive_title',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Customers',
			'placeholder' => '',
			'formatting' => 'none', // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_archive_heading_text',
			'label' => 'Archive Heading Text',
			'name' => $acf_group . '_archive_heading_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
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
			'key' => 'field_' . $acf_group . '_featured_posts',
			'label' => 'Featured Case Studies',
			'name' => $acf_group . '_featured_posts',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => 'Add Feature',
			'sub_fields' => array(
				array(
					'key' => 'field_' . $acf_group . '_featured_posts_video_image',
					'label' => 'Video Image',
					'name' => 'video_image',
					'type' => 'image',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'return_format' => 'url',       // array | url | id
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
					'key' => 'field_' . $acf_group . '_featured_posts_video_url',
					'label' => 'Video Url',
					'name' => 'video_url',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
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
					'key' => 'field_' . $acf_group . '_featured_posts_title',
					'label' => 'Title',
					'name' =>  'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
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
					'key' => 'field_' . $acf_group . '_featured_posts_name',
					'label' => 'Name',
					'name' =>  'name',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
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
				array(
					'key' => 'field_' . $acf_group . '_featured_posts_position',
					'label' => 'Position',
					'name' =>  'position',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array(
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
			)
		),
		array(
			'key' => 'field_' . $acf_group . '_hide_on_archive_page_ids',
			'label' => 'Hide case studies on the archive page',
			'name' => $acf_group . '_hide_on_archive_page_ids',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => PingCAP\Constants\CPT::CASE_STUDY,
			'taxonomy' => [],
			'filters' => ['search', 'taxonomy'],
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'id',     // object | id
		),
		array(
			'key' => 'field_' . $acf_group . '_case_study_archive_blocks',
			'label' => 'Case Study Archive',
			'name' => $acf_group . '_case_study_archive_blocks',
			'type' => 'clone',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'clone' => array(
				0 => 'group_grav_blocks',
			),
			'display' => 'seamless',
			'layout' => 'block',
			'prefix_label' => 1,
			'prefix_name' => 1,
		),

		/**
		 * Tab: Case Study Post Blocks
		 */
		array(
			'key' => 'field_' . $acf_group . '_tab_case_study_post_blocks',
			'label' => 'Case Study Post Blocks',
			'name' => 'tab_case_study_post_blocks',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,          // end tabs to start a new group
		),
		array(
			'key' => 'field_' . $acf_group . '_case_study_post_blocks',
			'label' => 'Case Study Post',
			'name' => $acf_group . '_case_study_post_blocks',
			'type' => 'clone',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'clone' => array(
				0 => 'group_grav_blocks',
			),
			'display' => 'seamless',
			'layout' => 'block',
			'prefix_label' => 1,
			'prefix_name' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => 'case-study-settings',        // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1,
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',                 // side | normal | acf_after_title
	'style' => 'seamless',                    // default | seamless
	'label_placement' => 'top',                // top | left
	'instruction_placement' => 'label',     // label | field
	'hide_on_screen' => array(
		// 0 => 'permalink',
		// 1 => 'the_content',
		// 2 => 'excerpt',
		// 3 => 'custom_fields',
		// 4 => 'discussion',
		// 5 => 'comments',
		// 6 => 'revisions',
		// 7 => 'slug',
		// 8 => 'author',
		// 9 => 'format',
		// 10 => 'featured_image',
		// 11 => 'categories',
		// 12 => 'tags',
		// 13 => 'send-trackbacks',
	),
	'active' => 1,
	'description' => '',
));
