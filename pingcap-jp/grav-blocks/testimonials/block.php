<?php
use WPUtil\Vendor\{ ACF, BlueprintBlocks };
use WPUtil\Models\BlueprintBlocksLink;
use WPUtil\{ Component, SVG };
use PingCAP\Blocks\Testimonials;

$testimonials = isset($testimonials) && is_array($testimonials) ? $testimonials : ACF::get_sub_field_array('testimonials');

if ($testimonials)
{
	$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
	$title_link_values = isset($title_link_values) && is_a($title_link_values, BlueprintBlocksLink::class) ?
		$title_link_values :
		BlueprintBlocks::get_button_field_values(
			'title_link',
			ACF::get_sub_field_array('title_link_values')
		);

	$transition_speed = isset($transition_speed) && is_int($transition_speed) ? $transition_speed : ACF::get_sub_field_int('transition_speed', ['default' => 10]);
	$enable_autoplay ??= ACF::get_sub_field_int('enable_autoplay');
	$autoplay_speed = $enable_autoplay ? (isset($autoplay_speed) && is_int($autoplay_speed) ? $autoplay_speed : ACF::get_sub_field_int('autoplay_speed', ['default' => 3000])) : 0;
	$adaptive_slide_heights = isset($adaptive_slide_heights) ? intval($adaptive_slide_heights) : ACF::get_sub_field_int('adaptive_slide_heights', ['default' => 1]);

	?>
	<div class="block-inner">
		<div class="contain layout__padded-columns layout__padded-columns--double">
			<div class="block-testimonials__title-container">
				<?php
				if ($block_title)
				{
					?>
					<h4 class="top-line"><?php echo esc_html($block_title); ?></h4>
					<?php
				}

				if ($title_link_values->text && $title_link_values->link)
				{
					?>
					<a href="<?php echo esc_url($title_link_values->link); ?>" class="button button--secondary"><?php echo esc_html($title_link_values->text); ?></a>
					<?php
				}

				if (count($testimonials) > 1)
				{
					?>
					<div class="block-testimonials__nav-desktop">
						<button class="embla__nav-button embla__nav-button--prev" type="button" aria-label="<?php esc_attr_e('Previous testimonial', PingCAP\Constants\TextDomains::DEFAULT); ?>">
							<?php SVG::the_svg('general/chevron-left', ['class' => 'embla__nav-arrow embla__nav-arrow--left']); ?>
						</button>
						<div class="embla__pagination"></div>
						<button class="embla__nav-button embla__nav-button--next" type="button" aria-label="<?php esc_attr_e('Next testimonial', PingCAP\Constants\TextDomains::DEFAULT); ?>">
							<?php SVG::the_svg('general/chevron-right', ['class' => 'embla__nav-arrow embla__nav-arrow--right']); ?>
						</button>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
		if (count($testimonials) > 1)
		{
			?>
			<div
				class="block-testimonials__slides embla-instance"
				data-transition-speed="<?php echo esc_attr($transition_speed); ?>"
				data-enable-autoplay="<?php echo esc_attr($enable_autoplay); ?>"
				data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>"
				data-adaptive-slide-heights="<?php echo esc_attr($adaptive_slide_heights); ?>"
			>
				<div class="embla">
					<div class="embla__container">
						<?php
						foreach ($testimonials as $testimonial_id)
						{
							Testimonials::displayTestimonial($testimonial_id, true);
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			Testimonials::displayTestimonial($testimonials[0], true);
		}

		if (count($testimonials) > 1)
		{
			?>
			<div class="block-testimonials__nav-mobile contain">
				<button class="embla__nav-button embla__nav-button--prev" type="button" aria-label="<?php esc_attr_e('Previous testimonial', PingCAP\Constants\TextDomains::DEFAULT); ?>">
					<?php SVG::the_svg('general/chevron-left', ['class' => 'embla__nav-arrow embla__nav-arrow--left']); ?>
				</button>
				<div class="embla__pagination"></div>
				<button class="embla__nav-button embla__nav-button--next" type="button" aria-label="<?php esc_attr_e('Next testimonial', PingCAP\Constants\TextDomains::DEFAULT); ?>">
					<?php SVG::the_svg('general/chevron-right', ['class' => 'embla__nav-arrow embla__nav-arrow--right']); ?>
				</button>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}
