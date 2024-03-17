<?php

use PingCAP\{Components, Constants, CPT};
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::EBOOK_WHITEPAPER,
	'display_filters' => false,
	'banner_bg_color' => 'bg-white'
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<div class="tmpl-archive-blog__bg bg-blue"></div>
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListEbookWhitepaper::class, [
		'wp_query_obj' => $wp_query,
		'featured_id' => CPT\EbookWhitePaper::getFeaturedId(),
		'api_endpoint' => 'wp/v2/ebook-whitepaper'
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::EBOOK_WHITEPAPER_SETTINGS_BASE . '_ebook_whitepaper_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
