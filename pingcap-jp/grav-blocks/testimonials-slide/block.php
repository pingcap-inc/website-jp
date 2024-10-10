<?php

use WPUtil\Vendor\{ACF};
use WPUtil\{Arrays, SVG};

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$block_desc = isset($block_desc) && is_string($block_desc) ? $block_desc : ACF::get_sub_field_string('block_desc');
$testimonials = isset($testimonials) && is_array($testimonials) ? $testimonials : ACF::get_sub_field_array('testimonials');

if ($testimonials) {
?>
	<div class="block-inner contain">
		<?php if ($block_title) { ?>
			<div class="block-title center">
				<h5><?php echo $block_title; ?></h5>
				<p class="desc"><?php echo $block_desc; ?></p>
			</div>
		<?php } ?>
		<div class="embla-instance">
			<div class="embla">
				<div class="embla__container">
					<?php
					foreach ($testimonials as $testimonial) {
						$color = Arrays::get_value_as_string($testimonial, 'color');
						$content = Arrays::get_value_as_string($testimonial, 'content');
						$name = Arrays::get_value_as_string($testimonial, 'name');
						$position = Arrays::get_value_as_string($testimonial, 'position');
					?>
						<div class="embla__slide">
							<div class="block-testimonials-slide__card">
								<div class="block-testimonials-slide__card-content">
									<?php SVG::the_svg('general/comma', ['class' => $color]); ?>
									<p><?php echo $content; ?></p>
								</div>
								<div class="block-testimonials-slide__card-author">
									<?php SVG::the_svg('general/avatar-' . $color, ['no_use' => true]); ?>
									<div><?php echo $name; ?><br><span><?php echo $position; ?></span></div>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="embla__pagination"></div>
			</div>
		</div>
	</div>
<?php
}
