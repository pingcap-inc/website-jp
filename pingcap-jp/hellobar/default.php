<?php
/**
 * Hello Bar Template: Default Hello Bar
 */

$classes = (isset($classes) && is_array($classes)) ? $classes : [];
$text = isset($text) ? $text : '';
$link = isset($link) ? $link : '';
$link_text = isset($link_text) ? $link_text : '';

if (!in_array('hellobar', $classes, true)) {
	array_unshift($classes, 'hellobar');
}

$classes[] = 'bg-blue';

?>
<section class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<div class="hellobar__wrapper contain">
		<div class="hellobar__text-wrapper">
			<?php
			if ($text)
			{
				?>
				<p class="hellobar__text-content"><?php echo wp_kses_post($text); ?></p>
				<?php
				if ($link && $link_text)
				{
					?>
					<a class="hellobar__link button" href="<?php echo esc_url($link); ?>"><?php echo esc_html($link_text); ?></a>
					<?php
				}
			}
			?>
		</div>
		<button class="hellobar__close" aria-label="Close notification bar">
			<?php WPUtil\SVG::the_svg('general/close', ['class' => 'hellobar__close-icon', 'no_use' => true]); ?>
		</button>
	</div>
</section>
