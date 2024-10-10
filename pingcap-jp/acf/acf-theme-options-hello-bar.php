<?php

use PingCAP\Constants;

$acf_group = Constants\ACF::THEME_OPTIONS_HELLO_BAR;

acf_add_local_field_group(array(
    'key' => 'group_' . $acf_group,
    'title' => 'Hello Bar',
    'fields' => array_merge(
        array(
            array(
                'key' => 'field_' . $acf_group . '_enable_hello_bar',
                'label' => 'Enable Hello Bar',
                'name' => $acf_group . '_enable_hello_bar',
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
                'key' => 'field_' . $acf_group . '_hello_bar_bg',
                'label' => 'Background Color',
                'name' =>  $acf_group . '_hello_bar_bg',
                'type' => 'select',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array('red' => 'Red', 'violet' => 'Violet', 'blue' => 'Blue', 'green' => 'Green'),
                'default_value' => 'red',
                'allow_null' => 0,
                'multiple' => 0,         // allows for multi-select
                'ui' => 0,               // creates a more stylized UI
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array(
                'key' => 'field_' . $acf_group . '_hello_bar_text',
                'label' => 'CTA Text',
                'name' => $acf_group . '_hello_bar_text',
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
                'key' => 'field_' . $acf_group . '_hello_bar_link',
                'label' => 'Button Link',
                'name' => $acf_group . '_hello_bar_link',
                'type' => 'link',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
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

        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'options_page', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '==',
                'value' => 'acf-theme-options-hello-bar',        // if options_page then use: acf-options  | if page_template then use:  template-example.php
                'order_no' => 0,
                'group_no' => 1,
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',                 // side | normal | acf_after_title
    'style' => 'default',                    // default | seamless
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
