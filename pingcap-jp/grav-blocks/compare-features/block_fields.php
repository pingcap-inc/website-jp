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
        'default_value' => 'Compare Features',
        'placeholder' => '',
        'formatting' => 'none', // none | html
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'readonly' => 0,
        'disabled' => 0,
    ),
    array(
        'key' => 'field_' . $block . '_tidb_serverless_link',
        'label' => 'TiDB Serverless Link',
        'name' => 'tidb_serverless_link',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => ''
        ),
        'layout' => 'block',
        'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
            'label' => 'Link',
            'name' => 'link',
            'includes' => [
                'page' => 'Page Link',
                'url' => 'URL'
            ],
            'supports_button_styles' => false,
            'show_text' => true,
        ])
    ),
    array(
        'key' => 'field_' . $block . '_tidb_dedicated_link',
        'label' => 'TiDB Dedicated Link',
        'name' => 'tidb_dedicated_link',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => ''
        ),
        'layout' => 'block',
        'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
            'label' => 'Link',
            'name' => 'link',
            'includes' => [
                'page' => 'Page Link',
                'url' => 'URL'
            ],
            'supports_button_styles' => false,
            'show_text' => true,
        ])
    ),
    array(
        'key' => 'field_' . $block . '_tidb_hosted_link',
        'label' => 'TiDB Self-Hosted Link',
        'name' => 'tidb_hosted_link',
        'type' => 'group',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => ''
        ),
        'layout' => 'block',
        'sub_fields' => WPUtil\Vendor\BlueprintBlocks::safe_get_link_fields([
            'label' => 'Link',
            'name' => 'link',
            'includes' => [
                'page' => 'Page Link',
                'url' => 'URL'
            ],
            'supports_button_styles' => false,
            'show_text' => true,
        ])
    ),
    array(
        'key' => 'field_' . $block . '_features',
        'label' => 'Features',
        'name' => 'features',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
        ),
        'collapsed' => 'field_' . $block . '_feature_title',
        'min' => 1,
        'max' => '',
        'layout' => 'block',         // table | block | row
        'button_label' => 'Add Feature',
        'sub_fields' => array(
            array(
                'key' => 'field_' . $block . '_feature_title',
                'label' => 'Feature Title',
                'name' => 'feature_title',
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
                'key' => 'field_' . $block . '_feature_items',
                'label' => 'Feature Items',
                'name' => 'feature_items',
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
                'layout' => 'table',         // table | block | row
                'button_label' => 'Add Feature Item',
                'sub_fields' => array(
                    array(
                        'key' => 'field_' . $block . '_feature_item_title',
                        'label' => 'Title',
                        'name' => 'feature_item_title',
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
                        'key' => 'field_' . $block . '_feature_item_enable_text',
                        'label' => 'Enable Text',
                        'name' => 'feature_item_enable_text',
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
                        'key' => 'field_' . $block . '_feature_item_serverless',
                        'label' => 'TiDB Serverless',
                        'name' => 'feature_item_serverless',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_feature_item_enable_text',
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
                        'message' => '',
                        'ui' => 1,
                        'ui_on_text' => 'Yes',
                        'ui_off_text' => 'No',
                        'default_value' => 0,
                    ),
                    array(
                        'key' => 'field_' . $block . '_feature_item_dedicated',
                        'label' => 'TiDB Dedicated',
                        'name' => 'feature_item_dedicated',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_feature_item_enable_text',
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
                        'message' => '',
                        'ui' => 1,
                        'ui_on_text' => 'Yes',
                        'ui_off_text' => 'No',
                        'default_value' => 0,
                    ),
                    array(
                        'key' => 'field_' . $block . '_feature_item_hosted',
                        'label' => 'TiDB Self-Hosted',
                        'name' => 'feature_item_hosted',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_feature_item_enable_text',
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
                        'message' => '',
                        'ui' => 1,
                        'ui_on_text' => 'Yes',
                        'ui_off_text' => 'No',
                        'default_value' => 0,
                    ),
                    array(
                        'key' => 'field_' . $block . '_feature_item_serverless_text',
                        'label' => 'TiDB Serverless',
                        'name' => 'feature_item_serverless_text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_feature_item_enable_text',
                                    'operator' => '==',
                                    'value' => 1,
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
                        'key' => 'field_' . $block . '_feature_item_dedicated_text',
                        'label' => 'TiDB Dedicated',
                        'name' => 'feature_item_dedicated_text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_feature_item_enable_text',
                                    'operator' => '==',
                                    'value' => 1,
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
                        'key' => 'field_' . $block . '_feature_item_hosted_text',
                        'label' => 'TiDB Self-Hosted',
                        'name' => 'feature_item_hosted_text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_' . $block . '_feature_item_enable_text',
                                    'operator' => '==',
                                    'value' => 1,
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
                ),
            ),
        ),
    ),
);

return array(
    'label' => 'Compare Features',
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
