<?php
use PingCAP\{ Constants, CPT };
use WPUtil\Vendor;

$acf_group = Constants\ACF::MENU_DROPDOWN_RESOURCES;

return array(
	array (
		'key' => 'field_' . $acf_group . '_featured_resources',
		'label' => 'Featured Resources',
		'name' => 'featured_resources',
		'type' => 'relationship',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'post_type' => CPT\Resources::getResourcePostTypes(),
		'taxonomy' => array (),
		'filters' => array (
			'search',
			'post_type',
			'taxonomy',
		),
		'elements' => '',
		'min' => '',
		'max' => 2,
		'return_format' => 'id',     // object | id
	),
	array (
		'key' => 'field_' . $acf_group . '_links',
		'label' => 'Links',
		'name' => 'links',
		'type' => 'repeater',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'collapsed' => '',
		'min' => '',
		'max' => '',
		'layout' => 'block',         // table | block | row
		'button_label' => 'Add Link',
		'sub_fields' => Vendor\BlueprintBlocks::safe_get_link_fields([
			'name' => 'link',
			'label' => 'Link',
			'includes' => [
				'page' => 'Page Link',
				'url' => 'URL'
			],
			'supports_button_styles' => false
		]),
	),
);
