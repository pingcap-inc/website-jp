<?php
WPUtil\ThemeSupport::register_menus([
	PingCAP\Constants\Menus::DESKTOP_PRIMARY_MENU => 'Primary Menu',
	PingCAP\Constants\Menus::DESKTOP_SECONDARY_MENU => 'Secondary Menu',
	PingCAP\Constants\Menus::MOBILE_PRIMARY_MENU => 'Primary Menu [Mobile]',
	PingCAP\Constants\Menus::MOBILE_SECONDARY_MENU => 'Secondary Menu [Mobile]',
	PingCAP\Constants\Menus::FOOTER_LINKS_MENU => 'Footer Links',
	PingCAP\Constants\Menus::FOOTER_LEGAL_MENU => 'Footer Legal'
]);

// ensure menu dropdowns are initialized after custom taxonomies ('init' priority 10)
// and post types ('init' priority 11) so that CPTs are selectable in ACF post relationship fields
add_action('init', function () {
	WPUtil\MenuDropdowns::init([
		'render_action' => 'render_menu_dropdowns',
		'container_classes' => ['bg-black']
	]);
}, 20);

/**
 * Create custom admin menu editor fields
 */
WPUtil\CustomMenuFields::create_fields([
	[
		'id' => 'column_index',
		'label' => 'Column',
		'type' => 'select',
		'values' => [
			0 => 'First',
			1 => 'Second',
			2 => 'Third',
			3 => 'Fourth'
		],
		'show_in_menu' => [PingCAP\Constants\Menus::FOOTER_LINKS_MENU],
		'display_callback' => function ($show_value, $menu_item) {
			// make sure the option isn't visible for child menu items
			if ($show_value && (int)$menu_item->menu_item_parent > 0) {
				return false;
			}

			return $show_value;
		}
	],
	[
		'id' => 'dropdown_id',
		'label' => 'Dropdown Menu',
		'type' => 'select',
		'values' => WPUtil\MenuDropdowns::get_menu_dropdown_select_options(),
		'show_in_menu' => [
			PingCAP\Constants\Menus::DESKTOP_PRIMARY_MENU,
			PingCAP\Constants\Menus::MOBILE_PRIMARY_MENU,
		],
		'display_callback' => function ($show_value, $menu_item) {
			// make sure the option isn't visible for child menu items
			if ($show_value && (int)$menu_item->menu_item_parent > 0) {
				return false;
			}

			return $show_value;
		}
	],
]);

/**
 * Change the menu dropdown container opening markup on mobile only
 */
add_filter('menu_dropdown/container_html_open', function ($html_open, $template_name, $dropdown_id, $section) {
	return $section === 'mobile' ? '<div class="mobile-menu-default__primary-group-inner"><div class="mobile-menu-default__primary-group-content">' : $html_open;
}, 10, 4);

/**
 * Change the menu dropdown container closing markup on mobile only
 */
add_filter('menu_dropdown/container_html_close', function ($html_close, $template_name, $dropdown_id, $section) {
	return $section === 'mobile' ? '</div></div>' : $html_close;
}, 10, 4);
