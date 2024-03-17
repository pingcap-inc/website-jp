<?php
use PingCAP\{ Components, Constants };
use WPUtil\{ Component, Vendor };

get_header();

Component::render(Components\Banners\BannerAuthor::class);

?>
<main class="tmpl-archive tmpl-archive--author">
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListAuthor::class, [
		'wp_query_obj' => $wp_query
	]);
	?>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::THEME_OPTIONS_AUTHOR_ARCHIVES_BASE . '_author_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
