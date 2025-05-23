<?php
$acf_group = 'tmpl_page_tidb_user_day_2025';

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'TiDB User Day 2025 Content Settings',
	'fields' => array (
		/**
         * Tab: Banner
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_banner',
            'label' => 'Banner',
            'name' => 'tab_banner',
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
		array (
			'key' => 'field_' . $acf_group . '_banner_content',
			'label' => 'Content',
			'name' => 'banner_content',
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
			'tabs' => 'text',         // all | visual | text
			'toolbar' => 'full',     // full | basic
			'media_upload' => 0,
		),
		/**
         * Tab: Carousel
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_carousel',
            'label' => 'Carousel',
            'name' => 'tab_carousel',
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
		array (
			'key' => 'field_' . $acf_group . '_carousel_content',
			'label' => 'Content',
			'name' => 'carousel_content',
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
			'tabs' => 'text',         // all | visual | text
			'toolbar' => 'full',     // full | basic
			'media_upload' => 0,
		),
        array (
			'key' => 'field_' . $acf_group . '_carousel_list',
			'label' => 'Carousel image',
			'name' => 'carousel_list',
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
			'button_label' => 'Add Image',
			'sub_fields' => array (
				array(
                    'key' => 'field_' . $acf_group . '_carousel_image',
                    'label' => 'Image',
                    'name' => 'carousel_image',
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
			),
		),
        
		/**
         * Tab: About
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_about',
            'label' => 'About',
            'name' => 'tab_about',
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
		array (
			'key' => 'field_' . $acf_group . '_about_content',
			'label' => 'Content',
			'name' => 'about_content',
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
			'tabs' => 'text',         // all | visual | text
			'toolbar' => 'full',     // full | basic
			'media_upload' => 0,
		),

		/**
         * Tab: Agenda
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_agenda',
            'label' => 'Agenda',
            'name' => 'tab_agenda',
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
		array (
			'key' => 'field_' . $acf_group . '_agenda_block_title',
			'label' => 'Block Title',
			'name' => 'agenda_block_title',
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
			'key' => 'field_' . $acf_group . '_agenda_list',
			'label' => 'Agenda',
			'name' => 'agenda_list',
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
			'button_label' => 'Add Agenda',
			'sub_fields' => array (
				array (
					'key' => 'field_' . $acf_group . '_agenda_card_color',
					'label' => 'Card Color',
					'name' => 'agenda_card_color',
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
						'red' => 'Red',
						'green' => 'Green',
						'blue' => 'Blue',
						'violet' => 'Violet'
					),
					'default_value' => 'red',
					'allow_null' => 0,
					'multiple' => 0,         // allows for multi-select
					'ui' => 0,               // creates a more stylized UI
					'ajax' => 0,
					'placeholder' => '',
					'disabled' => 0,
					'readonly' => 0,
				),
				array (
					'key' => 'field_' . $acf_group . '_agenda_start_time',
					'label' => 'Start Time',
					'name' => 'agenda_start_time',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
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
				array (
					'key' => 'field_' . $acf_group . '_agenda_end_time',
					'label' => 'End Time',
					'name' => 'agenda_end_time',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
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
                    'key' => 'field_' . $acf_group . '_agenda_image',
                    'label' => 'Avatar',
                    'name' => 'agenda_image',
                    'instructions' => '',
                    'type' => 'image',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
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
				array (
					'key' => 'field_' . $acf_group . '_agenda_title',
					'label' => 'Title',
					'name' => 'agenda_title',
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
					'formatting' => 'none',       // none | html
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_' . $acf_group . '_agenda_desc',
					'label' => 'Desc',
					'name' => 'agenda_desc',
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
					'key' => 'field_' . $acf_group . '_agenda_summary',
					'label' => 'Summary',
					'name' => 'agenda_summary',
					'type' => 'textarea',
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
					'maxlength' => '',
					'rows' => 4,
					'new_lines' => "\n",        // wpautop | br | ''
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => 'templates/page-tidb-user-day-2025.php',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
