<?php
namespace PingCAP\Blocks;

use WPUtil\Component;
use Blueprint\Images;
use PingCAP\{ Components, CPT };

abstract class Testimonials
{
	/**
	 * Output the markup used for a testimonial within the Testimonials block
	 *
	 * @param integer $testimonial_id
	 * @param boolean $is_slide
	 * @return void
	 */
	public static function displayTestimonial(int $testimonial_id, bool $is_slide = false, bool $is_featured_image = false)
	{
		$image = CPT\Testimonial::getImage($testimonial_id);
		$content = CPT\Testimonial::getTestimonial($testimonial_id);
		$attribution = CPT\Testimonial::getAttribution($testimonial_id);

		$testimonial_classes = [
			'block-testimonials__testimonial',
			'bg-white'
		];

		if ($image) {
			$testimonial_classes[] = 'block-testimonials__testimonial--has-image';
		}

		if ($is_slide)
		{
			?>
			<div class="embla__slide">
			<?php
		}

		?>
		<div class="contain layout__padded-columns layout__padded-columns--double">
			<div class="<?php echo esc_attr(implode(' ', $testimonial_classes)); ?>">
				<?php
				Images::safe_image_output($image, [
					'class' => 'block-testimonials__image',
					'data-ib-no-cache' => 1
				]);

				Component::render(Components\Testimonial::class, [
					'content' => $content,
					'attribution' => $attribution
				]);
				?>
			</div>
		</div>
		<?php

		if ($is_slide)
		{
			?>
			</div>
			<?php
		}
	}
}
