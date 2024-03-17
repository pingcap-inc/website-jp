<?php
$acf_group = 'sub_nav';

$sub_nav_fields = array(
    array (
		'key' => 'field_' . $acf_group . '_type',
		'label' => 'Sub Nav Type',
		'name' => $acf_group . '_type',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'anchor' => 'Anchor',
			'tab' => 'Tab',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => 'anchor',
		'layout' => 'horizontal',
	),
    array(
        'key' => 'field_' . $acf_group . '_links',
        'label' => 'Sub Nav',
        'name' => $acf_group . '_links',
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
        'button_label' => 'Add Sub Nav',
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
                'key' => 'field_' . $acf_group . '_anchor',
                'label' => 'Anchor',
                'name' => 'anchor',
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
);

acf_add_local_field_group(array(
    'key' => 'group_' . $acf_group,
    'title' => 'Sub Nav Settings',
    'fields' => $sub_nav_fields,
    'location' => array(
        array(
            array(
                'param' => 'post_type', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '==',
                'value' => 'page',      // if options_page then use: acf-options  | if page_template then use:  template-example.php
                'order_no' => 0,
                'group_no' => 1,
            ),
            array(
                'param' => 'post', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '!=',
                'value' => get_option('page_for_posts'),      // if options_page then use: acf-options  | if page_template then use:  template-example.php
                'order_no' => 0,
                'group_no' => 1,
            ),
            array(
                'param' => 'post', // post_type | post | page | page_template | post_category | taxonomy | options_page
                'operator' => '!=',
                'value' => get_option('page_on_front'),      // if options_page then use: acf-options  | if page_template then use:  template-example.php
                'order_no' => 0,
                'group_no' => 1,
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'acf_after_title',                // side | normal | acf_after_title
    'style' => 'default',                   // default | seamless
    'label_placement' => 'top',             // top | left
    'instruction_placement' => 'label',     // label | field
    'hide_on_screen' => array(),
    'active' => 1,
    'description' => '',
));
