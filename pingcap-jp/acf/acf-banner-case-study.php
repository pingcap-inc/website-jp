<?php
$acf_group = 'banner_case_study';

$banner_fields = array(
	array(
		'key' => 'field_' . $acf_group . '_text_align_mode',
		'label' => 'Text Align Mode',
		'name' => $acf_group . '_text_align_mode',
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
	array(
		'key' => 'field_' . $acf_group . '_enable_video_link',
		'label' => 'Enable Video Link',
		'name' => $acf_group . '_enable_video_link',
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
		'key' => 'field_' . $acf_group . '_video_link_text',
		'label' => 'Video Link Text',
		'name' => $acf_group . '_video_link_text',
		'type' => 'text',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $acf_group . '_enable_video_link',
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
		'key' => 'field_' . $acf_group . '_video_link_url',
		'label' => 'Video Link URL',
		'name' => $acf_group . '_video_link_url',
		'type' => 'text',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $acf_group . '_enable_video_link',
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
		'key' => 'field_' . $acf_group . '_additional_content',
		'label' => 'Additional Content',
		'name' => $acf_group . '_additional_content',
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
	array(
		'key' => 'field_' . $acf_group . '_side_content_type',
		'label' => 'Side Content Type',
		'name' => $acf_group . '_side_content_type',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array(
			'' => 'None',
			'testimonial' => 'Testimonial',
			'image' => 'Image'
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal',
	),

	/**
	 * Side content testimonial fields
	 */
	array(
		'key' => 'field_' . $acf_group . '_testimonial_id',
		'label' => 'Testimonial',
		'name' => $acf_group . '_testimonial_id',
		'type' => 'post_object',
		'instructions' => '',
		'required' => 1,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $acf_group . '_side_content_type',
					'operator' => '==',
					'value' => 'testimonial',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => PingCAP\Constants\CPT::TESTIMONIAL,
		'taxonomy' => array(),
		'allow_null' => 0,
		'multiple' => 0,
		'return_format' => 'id',     // object | id
		'ui' => 1,
	),

	/**
	 * Side content image fields
	 */
	array(
		'key' => 'field_' . $acf_group . '_side_image',
		'label' => 'Side Image',
		'name' => $acf_group . '_side_image',
		'instructions' => '',
		'type' => 'image',
		'required' => 0,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $acf_group . '_side_content_type',
					'operator' => '==',
					'value' => 'image',
				),
			),
		),
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
		'key' => 'field_' . $acf_group . '_side_image_max_height_desktop',
		'label' => 'Image Maximum Height',
		'name' => $acf_group . '_side_image_max_height_desktop',
		'type' => 'number',
		'instructions' => 'This setting only applies to desktop screen sizes.',
		'required' => 0,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $acf_group . '_side_content_type',
					'operator' => '==',
					'value' => 'image',
				),
			),
		),
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => 200,
		'placeholder' => '',
		'prepend' => '',
		'append' => 'px',
		'min' => 1,
		// 'max' => 100,
		'step' => '',
		'readonly' => 0,
		'disabled' => 0,
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
					'field' => 'field_' . $acf_group . '_side_content_type',
					'operator' => '==',
					'value' => 'image',
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
					'field' => 'field_' . $acf_group . '_side_content_type',
					'operator' => '==',
					'value' => 'image',
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
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => array(
			array(
				array(
					'field' => 'field_' . $acf_group . '_side_content_type',
					'operator' => '==',
					'value' => 'image',
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
				'value' => PingCAP\Constants\CPT::CASE_STUDY,      // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
