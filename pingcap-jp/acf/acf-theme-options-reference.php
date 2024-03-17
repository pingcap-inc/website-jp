<?php
use PingCAP\Constants;

$acf_group = Constants\ACF::THEME_OPTIONS_REFERENCE_BASE;

acf_add_local_field_group(array (
	'key' => 'group_' . $acf_group,
	'title' => 'Site Reference',
	'fields' => array (
		/**
		 * Tab: Shortcodes
		 */
		array (
			'key' => 'field_' . $acf_group . '_tab_shortcodes',
			'label' => 'Shortcodes',
			'name' => 'tab_shortcodes',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,          // end tabs to start a new group
		),
		array (
			'key' => 'field_' . $acf_group . '_reference_shortcodes',
			'label' => '',
			'name' => 'reference_shortcodes',
			'type' => 'message',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '<p>The following shortcodes are available to use within WYSIWYG editors:<p><h3>hubspot_form</h3><p>Display a HubSpot form. Requires the <code>portal_id</code> and <code>form_id</code> parameters to be specified.</p><p>Example usage: <code>[hubspot_form portal_id="4466002" form_id="3c38f561-c4da-4231-b85d-465e071a835a"]</code></p>',
			'new_lines' => 'wpautop',    // wpautop | br | ''
			'esc_html' => 0,             // uses the WordPress esc_html function
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page', // post_type | post | page | page_template | post_category | taxonomy | options_page
				'operator' => '==',
				'value' => 'acf-theme-options-reference',        // if options_page then use: acf-options  | if page_template then use:  template-example.php
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
	'hide_on_screen' => array (
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
