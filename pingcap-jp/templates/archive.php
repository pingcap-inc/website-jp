<?php
use PingCAP\Components;
use Blueprint\Archives;
use WPUtil\Component;

get_header();

Component::render(Components\Banners\BannerDefault::class, [
	'title' => Archives::get_title()
]);

?>
<main class="tmpl-archive">
	<?php
	if (have_posts())
	{
		?>
		<div class="contain tmpl-archive__cards-container">
			<?php
			while (have_posts())
			{
				the_post();

				Component::render(Components\Cards\CardSearch::class);
			}
			?>
		</div>
		<?php

		Component::render(Components\Archive\Navigation::class);
	}
	else
	{
		?>
		<div class="contain layout__padded-columns">
			<p>No posts were found</p>
		</div>
		<?php
	}
	?>
</main>
<?php

get_footer();
