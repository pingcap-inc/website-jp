<?php

use PingCAP\{Components, Constants, CPT};
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::BLOG,
	'display_filters' => false,
]);

?>
<main class="tmpl-archive tmpl-archive-blog bg-black-dark">
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListBlog::class, [
		'wp_query_obj' => $wp_query,
		'featured_id' => CPT\Blog::getFeaturedId(),
		'api_endpoint' => 'wp/v2/search',
		'index_name' => 'wp_posts_post',
		'card_component' => Components\Cards\CardBlog::class,
		'filter_render_functions' => [function () {
			Component::render(Components\PostsList\PostsListFilter::class, ['post_type' => Constants\CPT::BLOG]);
		}]
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::BLOG_SETTINGS_BASE . '_blog_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
