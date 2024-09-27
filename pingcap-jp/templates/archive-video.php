<?php

use PingCAP\{Components, Constants, CPT};
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::VIDEO,
	'display_filters' => false,
	'banner_bg_color' => 'bg-white'
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListBlog::class, [
		'wp_query_obj' => $wp_query,
		'featured_id' => CPT\VIDEO::getFeaturedId(),
		'api_endpoint' => 'wp/v2/video',
		'card_component' => Components\Cards\CardVideo::class,
		'filter_render_functions' => [function () {
			Component::render(Components\PostsList\PostsListFilter::class, ['post_type' => Constants\CPT::VIDEO]);
		}]
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::VIDEO_SETTINGS_BASE . '_event_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
