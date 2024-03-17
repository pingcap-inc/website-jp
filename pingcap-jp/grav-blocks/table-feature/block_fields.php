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
        'key' => 'field_' . $block . '_feature_cards',
        'label' => 'Feature Cards',
        'name' => 'feature_cards',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => array(
            array(
                array(
                    'field' => 'field_' . $block . '_section_type',
                    'operator' => '==',
                    'value' => 'feature',
                ),
            ),
        ),
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'collapsed' => 'field_' . $block . '_feature_card_title',
        'min' => 1,
        'max' => 2,
        'layout' => 'block',         // table | block | row
        'button_label' => 'Add Card',
        'sub_fields' => array(
            array(
                'key' => 'field_' . $block . '_feature_card_title',
                'label' => 'Title',
                'name' => 'title',
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
                'key' => 'field_' . $block . '_feature_card_icon_image',
                'label' => 'Icon Image',
                'name' => 'icon_image',
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
                'key' => 'field_' . $block . '_feature_card_content',
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
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
            array(
                'key' => 'field_' . $block . '_feature_card_buttons',
                'label' => 'Buttons',
                'name' => 'buttons',
                'label' => 'Button',
                'name' => 'button',
                'type' => 'link',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'horizontal',
            ),
        ),
    ),
    array(
        'key' => 'field_' . $block . '_first_col_title',
        'label' => 'Table First Column Title',
        'name' => 'first_col_title',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => array(
            array(
                array(
                    'field' => 'field_' . $block . '_section_type',
                    'operator' => '==',
                    'value' => 'feature',
                ),
            ),
        ),
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'collapsed' => '',
        'min' => 1,
        'max' => '',
        'layout' => 'table',         // table | block | row
        'button_label' => 'Add First Column Title',
        'sub_fields' => array(
            array(
                'key' => 'field_' . $block . '_row_section_title',
                'label' => 'Section Title',
                'name' => 'section_title',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_' . $block . '_row_title_type',
                            'operator' => '==',
                            'value' => 'section_title',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '20',
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
                'key' => 'field_' . $block . '_row_title_value',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
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
                'key' => 'field_' . $block . '_row_description_value',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
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

        ),
    ),
    array(
        'key' => 'field_' . $block . '_columns',
        'label' => 'Table Columns',
        'name' => 'columns',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => array(
            array(
                array(
                    'field' => 'field_' . $block . '_section_type',
                    'operator' => '==',
                    'value' => 'feature',
                ),
            ),
        ),
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'collapsed' => 'field_' . $block . '_column_title',
        'min' => 1,
        'max' => 6,
        'layout' => 'block',         // table | block | row
        'button_label' => 'Add Column',
        'sub_fields' => array(
            array(
                'key' => 'field_' . $block . '_column_title',
                'label' => 'Column Title',
                'name' => 'title',
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
                'key' => 'field_' . $block . '_column_row_values',
                'label' => 'Row Values',
                'name' => 'row_values',
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
                'button_label' => 'Add Row Value',
                'sub_fields' => array(
                    array(
                        'key' => 'field_' . $block . '_row_value_type',
                        'label' => 'Value Type',
                        'name' => 'type',
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
                            'text' => 'Text',
                            'checkmark' => 'Checkmark'
                        ),
                        'default_value' => 'text',
                        'allow_null' => 0,
                        'multiple' => 0,         // allows for multi-select
                        'ui' => 0,               // creates a more stylized UI
                        'ajax' => 0,
                        'placeholder' => '',
                        'disabled' => 0,
                        'readonly' => 0,
                    ),
                    array(
                        'key' => 'field_' . $block . '_row_value_text',
                        'label' => 'Text Value',
                        'name' => 'text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_row_value_type',
                                    'operator' => '==',
                                    'value' => 'text',
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
                        'key' => 'field_' . $block . '_row_value_checkmark_color',
                        'label' => 'Checkmark Color',
                        'name' => 'checkmark_color',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_row_value_type',
                                    'operator' => '==',
                                    'value' => 'checkmark',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'blue' => 'Blue',
                            'green' => 'Green'
                        ),
                        'default_value' => 'blue',
                        'allow_null' => 0,
                        'multiple' => 0,         // allows for multi-select
                        'ui' => 0,               // creates a more stylized UI
                        'ajax' => 0,
                        'placeholder' => '',
                        'disabled' => 0,
                        'readonly' => 0,
                    ),
                ),
            ),
        ),
    ),
);

return array(
    'label' => 'Table Feature',
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
