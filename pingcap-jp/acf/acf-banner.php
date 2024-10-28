<?php
$acf_group = 'banner';

$banner_fields = array_merge(
	array(
		/**
		 * Tab: Content
		 */
		array(
			'key' => 'field_' . $acf_group . '_tab_content',
			'label' => 'Content',
			'name' => $acf_group . '_tab_content',
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
			'key' => 'field_' . $acf_group . '_banner_display_type',
			'label' => 'Banner Display Type',
			'name' => $acf_group . '_banner_display_type',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'' => 'Default',
				'use-case' => 'Use Case',
				'product' => 'Product'
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
		),
		array(
			'key' => 'field_' . $acf_group . '_text_align_mode',
			'label' => 'Text Align Mode',
			'name' => $acf_group . '_text_align_mode',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33',
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
		array(
			'key' => 'field_' . $acf_group . '_banner_bg_color',
			'label' => 'Background color',
			'name' => $acf_group . '_banner_bg_color',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'bg-black-dark' => 'Dark',
				'bg-black' => 'Black',
				'bg-white' => 'White',
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'bg-black',
			'layout' => 'horizontal',
		),
		array(
			'key' => 'field_' . $acf_group . '_banner_bg',
			'label' => 'Banner full bg',
			'name' => $acf_group . '_banner_bg',
			'instructions' => '',
			'type' => 'image',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '==',
						'value' => '',
					),
				),
			),
			'wrapper' => array(
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
		array(
			'key' => 'field_' . $acf_group . '_title_size',
			'label' => 'Title Container Size',
			'name' => $acf_group . '_title_container_size',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '==',
						'value' => 'product',
					),
				),
			),
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'choices' => array(
				'' => 'Normal',
				'medium' => 'Medium',
				'large' => 'Large',
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
		),
		array(
			'key' => 'field_' . $acf_group . '_subtitle',
			'label' => 'Subtitle',
			'name' => $acf_group . '_subtitle',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '==',
						'value' => 'product',
					),
				),
			),
			'wrapper' => array(
				'width' => '67',
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
		array(
			'key' => 'field_' . $acf_group . '_use_case_illustration',
			'label' => 'Use Case Illustration',
			'name' => $acf_group . '_use_case_illustration',
			'type' => 'file',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '==',
						'value' => 'use-case',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',      // array | url | id
			'library' => 'all',              // all | uploadedTo
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'mp4,png,jpg,jpeg,gif,webp',
		),
		array(
			'key' => 'field_' . $acf_group . '_title_override',
			'label' => 'Title (override)',
			'name' => $acf_group . '_title_override',
			'type' => 'text',
			'instructions' => 'The default page title will be used if this field is empty',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
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
		array(
			'key' => 'field_' . $acf_group . '_content',
			'label' => 'Content',
			'name' => $acf_group . '_content',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
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
	WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
		'label' => 'Button',
		'name' => $acf_group . '_button',
		'includes' => [
			'none' => 'None',
			'page' => 'Page Link',
			'url' => 'URL',
		],
	]),
	array(
		array(
			'key' => 'field_' . $acf_group . '_first_block_pull_up',
			'label' => '"Pull up" first block content',
			'name' => $acf_group . '_first_block_pull_up',
			'type' => 'true_false',
			'instructions' => 'This option will "pull up" the first block content into the bottom portion of the banner. The only block types that support this functionality are Cards and Columns (when using the "Enable Box Container" option). If you leave this option enabled when the first block does not support the functionality, the side image in this banner will not extend over the bottom arc in the banner.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '!=',
						'value' => 'product',
					),
				),
			),
			'wrapper' => array(
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
		array(
			'key' => 'field_' . $acf_group . '_padding_bottom_enabled',
			'label' => 'Enable padding bottom',
			'name' => $acf_group . '_padding_bottom_enabled',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '!=',
						'value' => 'product',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
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
			'key' => 'field_' . $acf_group . '_customer_classes',
			'label' => 'Customer CSS Classes',
			'name' => $acf_group . '_customer_classes',
			'type' => 'text',
			'instructions' => 'Separate with spaces',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '!=',
						'value' => 'product',
					),
				),
			),
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

		/**
		 * Tab: Side Image
		 */
		array(
			'key' => 'field_' . $acf_group . '_tab_side_image',
			'label' => 'Side Image',
			'name' => $acf_group . '_tab_side_image',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_banner_display_type',
						'operator' => '!=',
						'value' => 'use-case',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,          // end tabs to start a new group
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image',
			'label' => 'Side Image',
			'name' => $acf_group . '_side_image',
			'instructions' => '',
			'type' => 'image',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
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
		array(
			'key' => 'field_' . $acf_group . '_side_image_webm',
			'label' => 'Side Image WebM Video',
			'name' => $acf_group . '_side_image_webm',
			'type' => 'file',
			'instructions' => 'If a WebM video file is selected here, it will be used to replace the side image on desktop browser sizes. The existing side image will be used for mobile and tablet browser sizes. This must be a WebM file with a transparent background since it overlaps both the banner background (black) and the page background (white). This video format is supported in most browsers.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',      // array | url | id
			'library' => 'all',              // all | uploadedTo
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'webm'
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_hevc',
			'label' => 'Side Image HEVC Video',
			'name' => $acf_group . '_side_image_hevc',
			'type' => 'file',
			'instructions' => 'If a HEVC video file is selected here, it will be used to replace the side image on desktop browser sizes. The existing side image will be used for mobile and tablet browser sizes. This must be a HEVC file with a transparent background since it overlaps both the banner background (black) and the page background (white). This video format is supported in Safari.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',      // array | url | id
			'library' => 'all',              // all | uploadedTo
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'mov'
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_is_styled',
			'label' => 'Enable Border Radius &amp; Box Shadow',
			'name' => $acf_group . '_side_image_is_styled',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '33',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 1,
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_pull_up',
			'label' => 'Pull Up on Large Displays',
			'name' => $acf_group . '_side_image_pull_up',
			'type' => 'true_false',
			'instructions' => 'By default the side image is vertically offset a small amount from the top of the banner. Enabling this option will remove the vertical offset on large (desktop) viewports.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
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
		array(
			'key' => 'field_' . $acf_group . '_side_image_cover',
			'label' => 'Cover Entire Image Container',
			'name' => $acf_group . '_side_image_cover',
			'type' => 'true_false',
			'instructions' => 'Disable this option if the top or bottom of the image is being cutoff',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '34',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'ui' => 1,
			'ui_on_text' => 'Yes',
			'ui_off_text' => 'No',
			'default_value' => 1,
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_pos_horz',
			'label' => 'Horizontal Position',
			'name' => $acf_group . '_side_image_pos_horz',
			'type' => 'number',
			'instructions' => 'Adjust the horizontal image position from 0 (left aligned) to 100 (right aligned).',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_side_image_cover',
						'operator' => '==',
						'value' => 1,
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 50,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_pos_vert',
			'label' => 'Vertical Position',
			'name' => $acf_group . '_side_image_pos_vert',
			'type' => 'number',
			'instructions' => 'Adjust the vertical image position from 0 (top aligned) to 100 (bottom aligned).',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_' . $acf_group . '_side_image_cover',
						'operator' => '==',
						'value' => 1,
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 50,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_video_url',
			'label' => 'Side Image Video URL',
			'name' => $acf_group . '_side_image_video_url',
			'type' => 'text',
			'instructions' => 'Add a YouTube, Vimeo, or Wistia video link here to include a play button over the side image that will show the video in a modal.',
			'required' => 0,
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
			'key' => 'field_' . $acf_group . '_side_image_max_width_desktop',
			'label' => 'Image Maximum Width',
			'name' => $acf_group . '_side_image_max_width_desktop',
			'type' => 'number',
			'instructions' => 'This setting only applies to desktop screen sizes.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 100,
			'placeholder' => '',
			'prepend' => '',
			'append' => '%',
			'min' => 1,
			'max' => 100,
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_side_image_max_height_desktop',
			'label' => 'Image Maximum Height',
			'name' => $acf_group . '_side_image_max_height_desktop',
			'type' => 'number',
			'instructions' => 'This setting only applies to desktop screen sizes.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => 536,
			'placeholder' => '',
			'prepend' => '',
			'append' => 'px',
			'min' => 1,
			// 'max' => 100,
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),

		/**
		 * Tab: Side Form
		 */
		array(
			'key' => 'field_' . $acf_group . '_tab_side_form',
			'label' => 'Side Form',
			'name' => $acf_group . '_tab_side_form',
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
			'key' => 'field_' . $acf_group . '_side_form_id',
			'label' => 'Form ID',
			'name' => $acf_group . '_side_form_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
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
		array(
			'key' => 'field_' . $acf_group . '_side_form_portal_id',
			'label' => 'Portal ID',
			'name' => $acf_group . '_side_form_portal_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '4466002',
			'placeholder' => '',
			'formatting' => 'none',       // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array(
			'key' => 'field_' . $acf_group . '_side_form_calendly_id',
			'label' => 'Calendly ID',
			'name' => $acf_group . '_side_form_calendly_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
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
		array(
			'key' => 'field_' . $acf_group . '_side_form_calendly_url',
			'label' => 'Calendly Url',
			'name' => $acf_group . '_side_form_calendly_url',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '50',
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
	)
);

acf_add_local_field_group(array(
	'key' => 'group_' . $acf_group,
	'title' => 'Banner Settings',
	'fields' => $banner_fields,
	'location' => array(
		array(
			array(
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => 'page',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1,
			),
			array(
				'param' => 'post', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '!=',
				'value' => get_option('page_for_posts'),      // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1,
			),
			array(
				'param' => 'post', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '!=',
				'value' => get_option('page_on_front'),      // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1,
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',                // side | normal | acf_after_title
	'style' => 'default',                   // default | seamless
	'label_placement' => 'top',             // top | left
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
