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
        'key' => 'field_' . $block . '_table_pricing',
        'label' => 'Table Pricing',
        'name' => 'table_pricing',
        'type' => 'repeater',
        'instructions' => 'These are the column labels for the pricing table.',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'collapsed' => 'field_' . $block . '_region_selector_title',
        'min' => '',
        'max' => '',
        'layout' => 'block',  // table | block | row
        'button_label' => 'Add Table Pricing',
        'sub_fields' => array(
            array(
                'key' => 'field_' . $block . '_provider_selector_title',
                'label' => 'Provider Selector Title',
                'name' => 'provider_selector_title',
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
                'placeholder' => '1. Choose Your Provider',
                'formatting' => 'none', // none | html
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array(
                'key' => 'field_' . $block . '_region_selector_title',
                'label' => 'Region Selector Title',
                'name' => 'region_selector_title',
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
                'placeholder' => '2. Select Region',
                'formatting' => 'none', // none | html
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array(
                'key' => 'field_' . $block . '_selector_content',
                'label' => 'Selector Table Content',
                'name' => 'selector_content',
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
        ),
    ),
    array(
        'key' => 'field_' . $block . '_contact_link',
        'label' => 'Region Selector Contact Url',
        'name' => 'contact_link',
        'type' => 'link',
        'required' => 1,
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
);

return array(
    'label' => 'Table Pricing',
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
