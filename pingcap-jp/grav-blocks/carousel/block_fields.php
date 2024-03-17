<?php
/*
* Gravitate Content Block
*
* Available Variables:
* $block                  = Name of Block Folder
* $block_backgrounds      = Array for Background Options
* $block_background_image = Array for Background Image Option
*
* This file must return an array();
*/

$block_fields = array(
    array(
        'key' => 'field_' . $block . '_block_title',
        'label' => 'Block Title',
        'name' => 'block_title',
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
        'formatting' => 'none',       // none | html
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
    ),
    array(
        'key' => 'field_' . $block . '_block_title_desc',
        'label' => 'Block Title Desc',
        'name' => 'block_title_desc',
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
        'formatting' => 'none',       // none | html
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
    ),
    array(
		'key' => 'field_' . $block . '_video_mode',
		'label' => 'Video Mode',
		'name' => 'video_mode',
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
        'key' => 'field_' . $block . '_carousel',
        'label' => 'Carousel',
        'name' => 'carousel',
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
        'button_label' => 'Add Carousel',
        'sub_fields' => array_merge(
            array(
                array(
                    'key' => 'field_' . $block . '_carousel_section_color',
                    "label" => "Section Bg Color",
                    "name" => "color",
                    "type" => "color_picker",
                    "instructions" => "",
                    "required" => 0,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
                                'operator' => '==',
                                'value' => 0,
                            ),
                        ),
                    ),
                    "wrapper" => array(
                        "width" => "50",
                        "class" => "",
                        "id" => ""
                    ),
                    "default_value" => "",
                    "enable_opacity" => 0,
                    "return_format" => "string"
                ),
                array(
                    'key' => 'field_' . $block . '_carousel_slide_color',
                    "label" => "Carousel Slide Bg Color",
                    "name" => "slide_color",
                    "type" => "color_picker",
                    "instructions" => "",
                    "required" => 0,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
                                'operator' => '==',
                                'value' => 0,
                            ),
                        ),
                    ),
                    "wrapper" => array(
                        "width" => "50",
                        "class" => "",
                        "id" => ""
                    ),
                    "default_value" => "",
                    "enable_opacity" => 0,
                    "return_format" => "string"
                ),
                array(
                    'key' => 'field_' . $block . '_carousel_title',
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
                                'operator' => '==',
                                'value' => 0,
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
                array(
                    'key' => 'field_' . $block . '_carousel_logo',
                    'label' => 'Logo',
                    'name' => 'logo',
                    'type' => 'image',
                    'required' => 0,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
                                'operator' => '==',
                                'value' => 0,
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
                    'key' => 'field_' . $block . '_carousel_content',
                    'label' => 'Content',
                    'name' => 'content',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
                                'operator' => '==',
                                'value' => 0,
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
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => 'wpautop',        // wpautop | br | ''
                    'readonly' => 0,
                    'disabled' => 0,
                ),
                array (
                    'key' => 'field_' . $block . '_video_image',
                    'label' => 'Video Image',
                    'name' => 'video_image',
                    'instructions' => '',
                    'type' => 'image',
                    'required' => 1,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
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
                array (
                    'key' => 'field_' . $block . '_video_url',
                    'label' => 'Video URL',
                    'name' => 'video_url',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => array (
                        array (
                            array (
                                'field' => 'field_' . $block . '_video_mode',
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
                    'placeholder' => '',
                    'formatting' => 'none', // none | html
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                    'readonly' => 0,
                    'disabled' => 0,
                ),
            ),
        )
    ),

);

return array(
    'label' => 'Carousel',
    'name' => $block,
    'display' => 'block',
    'min' => '',
    'max' => '',
    'sub_fields' => $block_fields,
    'grav_blocks_settings' => array(
        'icon' => 'gravicon-title',
        'description' => ''
    )
);
