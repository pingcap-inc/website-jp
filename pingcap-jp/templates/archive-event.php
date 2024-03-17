<?php

use PingCAP\{Components, Constants, CPT};
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::EVENT,
	'display_filters' => false,
	'banner_bg_color' => 'bg-white'
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<div class="tmpl-archive-blog__bg bg-blue"></div>
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListEvent::class, [
		'wp_query_obj' => $wp_query,
		'featured_id' => CPT\Event::getFeaturedId(),
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::EVENT_SETTINGS_BASE . '_event_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
