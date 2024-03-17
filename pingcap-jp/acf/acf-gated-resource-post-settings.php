<?php
use PingCAP\Constants;

$acf_group = 'gated_resource_settings';

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Gated Resource Settings',
	'fields' => array (
		array (
            'key' => 'field_'.$acf_group.'_gated_resource_template',
            'label' => 'Use Gated Resource Template?',
            'name' => 'gated_resource_template',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,  // acf_conditional
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
            'key' => 'field_'.$acf_group.'_gated_resource_image',
            'label' => 'Gated Resource Image',
            'name' => 'gated_resource_image',
            'instructions' => '',
            'type' => 'image',
            'required' => 0,
            'conditional_logic' => array (
                array (
                    array (
                        'field' => 'field_' . $acf_group . '_gated_resource_template',
                        'operator' => '==',
                        'value' => 1,
                    ),
                ),
            ),
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'return_format' => 'object',  // array | url | id
            'preview_size' => 'medium',
            'library' => 'all',  // all | uploadedTo
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
        array (
            'key' => 'field_'.$acf_group.'_gated_resource_content',
            'label' => 'Gated Resource Content',
            'name' => 'gated_resource_content',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array (
                array (
                    array (
                        'field' => 'field_' . $acf_group . '_gated_resource_template',
                        'operator' => '==',
                        'value' => 1,
                    ),
                ),
            ),
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',  // all | visual | text
            'toolbar' => 'full',  // full | basic
            'media_upload' => 1,
        ),
        array (
            'key' => 'field_'.$acf_group.'_gated_resource_sidebar_content',
            'label' => 'Sidebar Content',
            'name' => 'gated_resource_sidebar_content',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => array (
                array (
                    array (
                        'field' => 'field_' . $acf_group . '_gated_resource_template',
                        'operator' => '==',
                        'value' => 1,
                    ),
                ),
            ),
            'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',  // all | visual | text
            'toolbar' => 'full',  // full | basic
            'media_upload' => 1,
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
                        'field' => 'field_' . $acf_group . '_gated_resource_template',
                        'operator' => '==',
                        'value' => 1,
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
                        'field' => 'field_' . $acf_group . '_gated_resource_template',
                        'operator' => '==',
                        'value' => 1,
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
			'key' => 'field_' . $acf_group . '_hubspot_salesforce_id',
			'label' => 'HubSpot Salesforce ID',
			'name' => 'hubspot_salesforce_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => array (
                array (
                    array (
                        'field' => 'field_' . $acf_group . '_gated_resource_template',
                        'operator' => '==',
                        'value' => 1,
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
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => Constants\CPT::EBOOK_WHITEPAPER, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		),
		array (
			array (
				'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => Constants\CPT::EVENT, // if options_page then use: acf-options  | if page_template then use:  template-example.php
				'order_no' => 0,
				'group_no' => 1
			)
		),
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
