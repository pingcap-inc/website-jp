<?php
use WPUtil\Vendor\{ ACF, BlueprintBlocks };
use PingCAP\{ Components, Constants };

get_header();

$title = ACF::get_field_string(Constants\ACF::THEME_OPTIONS_404_BASE . '_title', 'option');
$content = ACF::get_field_string(Constants\ACF::THEME_OPTIONS_404_BASE . '_content', 'option');

if (!$title) {
	$title = '404 - Not Found';
}

WPUtil\Component::render(Components\Banners\BannerDefault::class, [
	'title' => $title,
	'bottom_arc_enabled' => true,
	'bottom_arc_color' => 'white',
	'no_gutters' => true,
	'is_404' => true,
]);

?>
<main class="tmpl-404">
	<?php
	if ($content)
	{
		?>
		<section class="block-container">
			<div class="block-inner contain layout__padded-columns layout__padded-columns--double wysiwyg">
				<div class="tmpl-404__content">
					<?php
					// phpcs:ignore
					echo $content;
					?>
				</div>
			</div>
		</section>
		<?php
	}

	BlueprintBlocks::safe_display([
		'section' => Constants\ACF::THEME_OPTIONS_404_BASE . '_404_blocks_grav_blocks',
		'object' => 'option'
	]);
	?>
</main>
<?php

get_footer();
