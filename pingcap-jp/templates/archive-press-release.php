<?php

use PingCAP\{Components, Constants, CPT};
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::PRESS_RELEASE,
	'display_filters' => false,
	'banner_bg_color' => 'bg-white'
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<div class="tmpl-archive-blog__bg bg-blue"></div>
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListBlog::class, [
		'wp_query_obj' => $wp_query,
		'featured_id' => CPT\PressRelease::getFeaturedId(),
		'api_endpoint' => 'wp/v2/press-release'
	]);
	?>

	<div class="post-type-archive-news bg-gray">
		<div class="contain">
			<h2 class="text-center"><?php echo CPT\News::getArchiveTitle(); ?></h2>
			<div class="posts-list posts-list-news">
				<div class="posts-list__cards-container contain" data-load-more-target="" data-current-page="0" data-total-pages="3" data-posts-per-page="12" data-endpoint="wp/v2/news" data-index-name="">
				</div>
				<div class="posts-list__no-results-container layout__padded-columns text-center hide" data-no-results-container="">
					<h4>No results were found for the selected filters.</h4>
				</div>
				<div class="posts-list__loader-container hide">
					<span class="posts-list__loader-spinner"></span>
				</div>
				<?php Component::render(Components\Archive\LoadMore::class); ?>
			</div>

		</div>
	</div>
</main>

<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::PRESS_RELEASE_SETTINGS_BASE . '_press_release_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
