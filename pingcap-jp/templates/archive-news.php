<?php
use PingCAP\{ Components, Constants, CPT };
use WPUtil\{ Component, Vendor };

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::NEWS,
	'display_filters' => false
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListBlog::class, [
		'wp_query_obj' => $wp_query,
		'featured_id' => CPT\News::getFeaturedId(),
		'api_endpoint' => 'wp/v2/news',
		'card_component' => Components\Cards\CardNews::class
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::NEWS_SETTINGS_BASE . '_news_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
