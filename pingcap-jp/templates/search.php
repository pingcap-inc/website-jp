<?php
use PingCAP\{ Components, Constants };
use WPUtil\{ Component, Vendor };

get_header();

Component::render(Components\Banners\BannerDefault::class, [
	'post_id' => 0,
	'title' => __('Search Results for', Constants\TextDomains::DEFAULT) . ': ' . esc_html(get_search_query()),
	'bottom_arc_enabled' => true,
	'bottom_arc_color' => 'white',
	'no_gutters' => true
]);

?>
<main class="tmpl-search">
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListSearch::class, [
		'wp_query_obj' => $wp_query
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::THEME_OPTIONS_SEARCH_BASE . '_search_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
