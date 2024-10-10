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
        'required' => 1,
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
        'key' => 'field_' . $block . '_case_cards',
        'label' => 'Cards',
        'name' => 'case_cards',
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
        'button_label' => 'Add Card',
        'sub_fields' => array_merge(
            array(
                array(
                    'key' => 'field_' . $block . '_card_logo',
                    'label' => 'Logo',
                    'name' => 'logo',
                    'type' => 'image',
                    'required' => 0,
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
                    'key' => 'field_' . $block . '_card_title',
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
                    'key' => 'field_' . $block . '_card_desc',
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
                array (
                    'key' => 'field_' . $block . '_case_study_id',
                    'label' => 'Case Study',
                    'name' => 'case_study_id',
                    'type' => 'post_object',
                    'instructions' => '',
                    'required' => 1,
                    'conditional_logic' => 0,
                    'wrapper' => array (
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => PingCAP\Constants\CPT::CASE_STUDY,
                    'taxonomy' => array (),
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'id',     // object | id
                    'ui' => 1,
                ),
            ),
        )
    ),
);

return array(
    'label' => 'Case',
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
