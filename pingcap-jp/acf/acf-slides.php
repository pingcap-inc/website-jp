<?php

use PingCAP\Constants;

$acf_group = 'slides';

acf_add_local_field_group(array(
    'key' => 'group_' . $acf_group,
    'title' => 'Slides Settings',
    'fields' => array_merge(
        WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
            'label' => 'slides Download Link',
            'name' => 'slides_url',
            'key_modifier' => $acf_group . '_slides_url',
            'includes' => [
                'file' => 'File Download',
                'url' => 'URL',
            ],
            'show_text' => false,
            'supports_button_styles' => false,
        ]),
        array(
            array(
                'key' => 'field_' . $acf_group . '_slides_image',
                'label' => 'Slides Image',
                'name' => 'slides_image',
                'instructions' => '',
                'type' => 'image',
                'required' => 1,
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
                'key' => 'field_' . $acf_group . '_slides_content',
                'label' => 'Slides Content',
                'name' => 'slides_content',
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
        )
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '==',
                'value' => Constants\CPT::SLIDES, // if options_page then use: acf-options  | if page_template then use:  template-example.php
                'order_no' => 0,
                'group_no' => 1
            )
        )
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
