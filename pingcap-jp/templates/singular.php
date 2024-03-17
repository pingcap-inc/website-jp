<?php
use PingCAP\Components;
use WPUtil\{ Component, Vendor };

get_header();

Component::render(Components\Banners\BannerDefault::class);

?>
<main class="tmpl-singular tmpl-singular--<?php echo esc_attr(get_post_type()); ?>">
	<?php
	if (have_posts())
	{
		while (have_posts())
		{
			the_post();

			if (get_the_content())
			{
				?>
				<section class="contain layout__padded-columns">
					<div class="tmpl-singular__content wysiwyg">
						<?php the_content(); ?>
					</div>
				</section>
				<?php
			}

			Vendor\BlueprintBlocks::safe_display();
		}
	}
	?>
</main>
<?php

get_footer();
