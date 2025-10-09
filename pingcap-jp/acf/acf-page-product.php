<?php
$acf_group = 'tmpl_product_content';

acf_add_local_field_group(array(
    'key' => 'group_' . $acf_group,
    'title' => 'Product Content Settings',
    'fields' => array(
        /**
         * Tab: Advanced Features
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_product_features',
            'label' => 'Advanced Features',
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
            ),
        ),
        /**
         * Tab: Advantages
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_product_advantages',
            'label' => 'Advantages',
            'name' => 'tab_product_advantages',
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
            'key' => 'field_' . $acf_group . '_product_advantages_bg',
            'label' => 'Background Color',
            'name' => 'product_advantages_bg',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'bg-blue' => 'Blue',
                'bg-green' => 'Green',
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
            'key' => 'field_' . $acf_group . '_product_advantages_title',
            'label' => 'Advantages Title',
            'name' => 'product_advantages_title',
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
            'key' => 'field_' . $acf_group . '_product_advantages_subtitle',
            'label' => 'Advantages Subtitle',
            'name' => 'product_advantages_desc',
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
            'key' => 'field_' . $acf_group . '_product_advantages',
            'label' => 'Advantages',
            'name' => 'product_advantages',
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
            'button_label' => 'Add Advantages',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $acf_group . '_advantage_title',
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
                    'key' => 'field_' . $acf_group . '_advantage_desc',
                    'label' => 'Desc',
                    'name' => 'desc',
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
            ),
        ),
        array(
            'key' => 'field_' . $acf_group . '_product_advantages_products',
            'label' => 'Product',
            'name' => 'product_advantages_products',
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
            'button_label' => 'Add Product',
            'sub_fields' => array_merge(
                array(
                    array(
                        'key' => 'field_' . $acf_group . '_product_image',
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
                        'key' => 'field_' . $acf_group . '_product_title',
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
                        'key' => 'field_' . $acf_group . '_product_desc',
                        'label' => 'Desc',
                        'name' => 'desc',
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
                ),
                WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
                    'label' => 'Link',
                    'name' => 'link',
                    'key_modifier' => 'product',
                    'includes' => [
                        'page' => 'Page Link',
                        'url' => 'URL',
                        'none' => 'None',
                    ],
                    'supports_button_styles' => false,
                    'show_text' => true
                ])
            )
        ),
        /**
         * Tab: Resources
         */
        array(
            'key' => 'field_' . $acf_group . '_tab_product_resources',
            'label' => 'Resources',
            'name' => 'tab_product_resources',
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
            'key' => 'field_' . $acf_group . '_product_resources_title',
            'label' => 'Resources Title',
            'name' => 'product_resources_title',
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
            'key' => 'field_' . $acf_group . '_product_resources',
            'label' => 'Resources',
            'name' => 'product_resources',
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
            'button_label' => 'Add Card',
            'sub_fields' => array_merge(
            array(
                array(
                    'key' => 'field_' . $acf_group . '_resource_image',
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
                    'key' => 'field_' . $acf_group . '_resource_title',
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
                    'key' => 'field_' . $acf_group . '_resource_desc',
                    'label' => 'Desc',
                    'name' => 'desc',
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
            ),
            WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
                'label' => 'Link',
                'name' => 'link',
                'key_modifier' => 'resource',
                'includes' => [
                    'page' => 'Page Link',
                    'url' => 'URL',
                    'none' => 'None',
                ],
                'supports_button_styles' => false,
                'show_text' => true
            ])
            )
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '==',
                'value' => 'templates/page-product.php',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
