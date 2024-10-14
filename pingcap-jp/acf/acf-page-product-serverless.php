<?php
$acf_group = 'tmpl_product_serverless_content';

acf_add_local_field_group(array(
    'key' => 'group_' . $acf_group,
    'title' => 'Product Serverless Content Settings',
    'fields' => array(
        /**
         * Tab: Advanced Features
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_product_features',
            'label' => 'Features',
            'name' => 'tab_product_features',
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
            'key' => 'field_' . $acf_group . '_features_block_title',
            'label' => 'Block Title',
            'name' => 'features_block_title',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'all',         // all | visual | text
            'toolbar' => 'full',     // full | basic
            'media_upload' => 1,
        ),
        array(
            'key' => 'field_' . $acf_group . '_features',
            'label' => 'Features',
            'name' => 'features',
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
            'max' => '',
            'layout' => 'block',         // table | block | row
            'button_label' => 'Add Feature',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $acf_group . '_feature_image',
                    'label' => 'Icon',
                    'name' => 'image',
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
                array(
                    'key' => 'field_' . $acf_group . '_feature_title',
                    'label' => 'Title',
                    'name' => 'title',
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
                    'key' => 'field_' . $acf_group . '_feature_desc',
                    'label' => 'Desc',
                    'name' => 'desc',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',         // all | visual | text
                    'toolbar' => 'full',     // full | basic
                    'media_upload' => 1,
                ),
            ),
        ),
        /**
         * Tab: Community
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_product_community',
            'label' => 'Community',
            'name' => 'tab_product_community',
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
            'key' => 'field_' . $acf_group . '_product_community_title',
            'label' => 'Community Title',
            'name' => 'product_community_title',
            'type' => 'wysiwyg',
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
            'key' => 'field_' . $acf_group . '_product_community_icon',
            'label' => 'Icon',
            'name' => 'product_community_icon',
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
            'max' => '',
            'layout' => 'block',         // table | block | row
            'button_label' => 'Add Icon',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $acf_group . '_community_icon',
                    'label' => 'Icon',
                    'name' => 'image',
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
                array(
                    'key' => 'field_' . $acf_group . '_community_repo',
                    'label' => 'Github Repo Info',
                    'name' => 'repo',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '50',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'github_stars' => 'GitHub stars',
                        'pull_requests' => 'Pull requests',
                        'contributors' => 'Contributors',
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
                array(
                    'key' => 'field_' . $acf_group . '_community_repo_count',
                    'label' => 'Repo Count',
                    'name' => 'repo_count',
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
                    'key' => 'field_' . $acf_group . '_community_title',
                    'label' => 'Title',
                    'name' => 'title',
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
            ),
        ),
        array(
            'key' => 'field_' . $acf_group . '_product_community_sections',
            'label' => 'Sections',
            'name' => 'product_community_sections',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => '',
            'min' => 1,
            'max' => '',
            'layout' => 'block',         // table | block | row
            'button_label' => 'Add Section',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $acf_group . '_section_title',
                    'label' => 'Title',
                    'name' => 'title',
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
                    'key' => 'field_' . $acf_group . '_section_content',
                    'label' => 'Section Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',         // all | visual | text
                    'toolbar' => 'full',     // full | basic
                    'media_upload' => 1,
                ),
            ),
        ),
        /**
         * Tab: Integration
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_product_integration',
            'label' => 'Integration',
            'name' => 'tab_product_integration',
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
            'key' => 'field_' . $acf_group . '_product_integration_title',
            'label' => 'Integration Title',
            'name' => 'product_integration_title',
            'type' => 'wysiwyg',
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
            'key' => 'field_' . $acf_group . '_product_integrations',
            'label' => 'Integration Logo',
            'name' => 'product_integrations',
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
            'max' => '',
            'layout' => 'block',         // table | block | row
            'button_label' => 'Add Logo',
            'sub_fields' => array_merge(
                array(
                    array(
                        'key' => 'field_' . $acf_group . '_product_integration_image',
                        'label' => 'Logo',
                        'name' => 'image',
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
                ),
            )
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '==',
                'value' => 'templates/page-product-serverless.php',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
                'order_no' => 0,
                'group_no' => 1,
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal', // side | normal | acf_after_title
    'style' => 'default', // default | seamless
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
