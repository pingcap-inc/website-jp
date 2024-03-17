<?php
$acf_group = 'tmpl_featured_content';

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Featured Content Settings',
	'fields' => array (
		array (
			'key' => 'field_' . $acf_group . '_featured_content_type',
			'label' => 'Featured Content Type',
			'name' => 'featured_content_type',
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
				'get-started' => '"Get Started" instructions',
				'form' => 'Form'
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
		),
		array (
			'key' => 'field_' . $acf_group . '_featured_intro_content',
			'label' => 'Featured Intro Content',
			'name' => 'featured_intro_content',
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

		/**
		 * Offline download fields
		 */
		array (
			'key' => 'field_' . $acf_group . '_package_download_title',
			'label' => 'Offline Package Title',
			'name' => 'package_download_title',
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
			'key' => 'field_' . $acf_group . '_package_version',
			'label' => 'Offline package Version',
			'name' => 'package_version',
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
			'min' => 0,
			'max' => '',
			'layout' => 'block',         // table | block | row
			'button_label' => 'Add Package Version',
			'sub_fields' => array (
				array (
					'key' => 'field_' . $acf_group . '_package_version_title',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
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
					'key' => 'field_' . $acf_group . '_package_version_value',
					'label' => 'Value',
					'name' => 'value',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
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
			),
		),
		array (
			'key' => 'field_' . $acf_group . '_package',
			'label' => 'Offline package',
			'name' => 'package',
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
			'min' => 0,
			'max' => '',
			'layout' => 'block',         // table | block | row
			'button_label' => 'Add Package',
			'sub_fields' => array (
				array (
					'key' => 'field_' . $acf_group . '_package_title',
					'label' => 'Title',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
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
					'key' => 'field_' . $acf_group . '_package_value',
					'label' => 'Value',
					'name' => 'value',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
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
			),
		),
		array (
			'key' => 'field_' . $acf_group . '_package_download_page_link',
			'label' => 'Download Page Link',
			'name' => 'package_download_page_link',
			'type' => 'link',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'return_format' => 'array',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),

		/**
		 * Platform ("Get Started") fields
		 */
		array (
			'key' => 'field_' . $acf_group . '_platforms_title',
			'label' => 'Platform Title',
			'name' => 'platform_title',
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
			'key' => 'field_' . $acf_group . '_platforms',
			'label' => 'Platform Instructions',
			'name' => 'platforms',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_' . $acf_group . '_featured_content_type',
						'operator' => '==',
						'value' => 'get-started',
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
			'button_label' => 'Add Platform Instructions',
			'sub_fields' => array (
				array (
					'key' => 'field_' . $acf_group . '_platform_image',
					'label' => 'Image',
					'name' => 'image',
					'instructions' => '',
					'type' => 'image',
					'required' => 1,
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
					'key' => 'field_' . $acf_group . '_platform_title',
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
					'key' => 'field_' . $acf_group . '_platform_pre_steps_content',
					'label' => 'Pre-steps Content',
					'name' => 'pre_steps_content',
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
					'key' => 'field_' . $acf_group . '_platform_steps',
					'label' => 'Steps',
					'name' => 'steps',
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
					'button_label' => 'Add Step',
					'sub_fields' => array (
						array (
							'key' => 'field_' . $acf_group . '_platform_step_title',
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
						array (
							'key' => 'field_' . $acf_group . '_platform_step_commands',
							'label' => 'Commands',
							'name' => 'commands',
							'type' => 'textarea',
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
							'maxlength' => '',
							'rows' => 4,
							'new_lines' => "\n",        // wpautop | br | ''
							'readonly' => 0,
							'disabled' => 0,
						),
					),
				),
				array (
					'key' => 'field_' . $acf_group . '_platform_post_steps_content',
					'label' => 'Post-steps Content',
					'name' => 'post_steps_content',
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
			),
		),

		/**
		 * Form fields
		 */
		array (
			'key' => 'field_' . $acf_group . '_hubspot_portal_id',
			'label' => 'HubSpot Portal ID',
			'name' => 'hubspot_portal_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_' . $acf_group . '_featured_content_type',
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
			'key' => 'field_' . $acf_group . '_hubspot_form_id',
			'label' => 'HubSpot Form ID',
			'name' => 'hubspot_form_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_' . $acf_group . '_featured_content_type',
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

		/**
		 * Sidebar sections
		 */
		array (
			'key' => 'field_' . $acf_group . '_sidebar_sections',
			'label' => 'Sidebar Sections',
			'name' => 'sidebar_sections',
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
			'button_label' => 'Add Sidebar Section',
			'sub_fields' => array_merge(
				array (
					array (
						'key' => 'field_' . $acf_group . '_section_title',
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
					array (
						'key' => 'field_' . $acf_group . '_section_content',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'textarea',
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
						'maxlength' => '',
						'rows' => 3,
						'new_lines' => 'wpautop',        // wpautop | br | ''
						'readonly' => 0,
						'disabled' => 0,
					),
				),
				WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
					'label' => 'Link',
					'name' => 'link',
					'key_modifier' => 'sidebar_section',
					'includes' => [
						'none' => 'None',
						'page' => 'Page Link',
						'url' => 'URL',
						'file' => 'File Download',
					],
					'supports_button_styles' => false
				])
			)
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => 'templates/page-template-featured-content.php',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1,
			),
		)
	),
	'menu_order' => 0,
	'position' => 'normal', // side | normal | acf_after_title
	'style' => 'default', // default | seamless
	'label_placement' => 'top', // top | left
	'instruction_placement' => 'label', // label | field
	'hide_on_screen' => array (
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
		// 13 => 'send-trackbacks'
	),
	'active' => 1,
	'description' => ''
));
