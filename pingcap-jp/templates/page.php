<?php
use PingCAP\{ Banners, Components };
use WPUtil\{ Component, Vendor };

get_header();

Component::render(Components\Banners\BannerDefault::class);
Component::render(Components\SubNav::class);

?>
<main class="tmpl-page">
	<?php
	if (have_posts())
	{
		while (have_posts())
		{
			the_post();

			if (Banners::firstBlockPullUpEnabled()) {
				add_filter('PingCAP/blocks/first_block_pull_up', '__return_true');
			}

			Vendor\BlueprintBlocks::safe_display();

			if (Banners::firstBlockPullUpEnabled()) {
				remove_filter('PingCAP/blocks/first_block_pull_up', '__return_true');
			}
		}
	}
	?>
</main>
<?php

get_footer();
