<?php
$acf_group = 'sidebar_cta';

acf_add_local_field_group(array(
	'key' => 'group_' . $acf_group,
	'title' => 'Sidebar CTA',
	'fields' => array_merge(
		array(
			array(
				'key' => 'field_' . $acf_group . '_bg',
				'label' => 'Background',
				'name' => 'bg',
				'instructions' => '',
				'type' => 'image',
				'required' => 0,
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
			array (
				'key' => 'field_' . $acf_group . '_title',
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
			array(
				'key' => 'field_' . $acf_group . '_content',
				'label' => 'Content',
				'name' => 'content',
				'type' => 'textarea',
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
				'maxlength' => '',
				'rows' => '',
				'new_lines' => 'wpautop',        // wpautop | br | ''
				'readonly' => 0,
				'disabled' => 0,
			),
		),
		WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
			'label' => 'Button',
			'name' => 'button',
			'includes' => [
				'page' => 'Page Link',
				'url' => 'URL',
			],
			'supports_button_styles' => false,
			'supports_button_gtag' => true
		]),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => PingCAP\Constants\CPT::SIDEBAR_CTA, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		)
	),
	'menu_order' => 0,
	'position' => 'acf_after_title', // side | normal | acf_after_title
	'style' => 'seamless', // default | seamless
	'label_placement' => 'top', // top | left
	'instruction_placement' => 'label', // label | field
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
		// 13 => 'send-trackbacks'
	),
	'active' => 1,
	'description' => ''
));
