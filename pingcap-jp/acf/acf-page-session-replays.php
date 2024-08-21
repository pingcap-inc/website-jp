<?php
$acf_group = 'tmpl_session_replay';

acf_add_local_field_group(array(
    'key' => 'group_' . $acf_group,
    'title' => 'Session Replays Content',
    'fields' => array(
        array(
            'key' => 'field_' . $acf_group . '_header_title',
            'label' => 'Header Title',
            'name' => 'header_title',
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
            'key' => 'field_' . $acf_group . '_header_bg',
            'label' => 'Header Background',
            'name' => 'header_bg',
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
        array(
            'key' => 'field_' . $acf_group . '_home_url',
            'label' => 'Home Url',
            'name' => 'home_url',
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
            'key' => 'field_' . $acf_group . '_content',
            'label' => 'Sections',
            'name' => 'session_replay_content',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => 'field_' . $acf_group . '_title',
            'min' => 0,
            'max' => '',
            'layout' => 'block',         // table | block | row
            'button_label' => 'Add Section',
            'sub_fields' => array(
                array(
                    'key' => 'field_' . $acf_group . '_title',
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
                    'key' => 'field_' . $acf_group . '_video',
                    'label' => 'Video',
                    'name' => 'video',
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
                    'min' => 0,
                    'max' => '',
                    'layout' => 'block',         // table | block | row
                    'button_label' => 'Add video',
                    'sub_fields' => array_merge(
                        array(
                            array(
                                'key' => 'field_' . $acf_group . '_video_image',
                                'label' => 'Image',
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
                                'key' => 'field_' . $acf_group . '_video_url',
                                'label' => 'Url',
                                'name' => 'url',
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
                            'label' => 'Download PDF Button',
                            'name' => 'video_pdf',
                            'includes' => [
                                'file' => 'File Download',
                                'url' => 'URL',
                                'page' => 'Page Link',
                            ],
                            'supports_button_styles' => false,
                        ]),
                    )
                ),

            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '==',
                'value' => 'templates/page-session-replay.php',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
