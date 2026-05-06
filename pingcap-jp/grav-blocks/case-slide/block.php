<?php

use WPUtil\Vendor\ACF;
use WPUtil\Vendor\BlueprintBlocks;
use WPUtil\{Arrays, SVG};
use Blueprint\Images;
use PingCAP\{Constants};

$block_eyebrow = ACF::get_sub_field_string('block_eyebrow');
$block_title = ACF::get_sub_field_string('block_title');
$block_desc = ACF::get_sub_field_string('block_desc');
$view_all_link = ACF::get_sub_field_string('view_all_link');
$view_all_text = ACF::get_sub_field_string('view_all_text') ?: 'View all customer stories';
$cards = ACF::get_sub_field_array('case_cards');

if ($cards) {
?>
	<div class="block-inner contain">
		<?php if ($block_title) { ?>
			<div class="block-title center">
				<?php if ($block_eyebrow) { ?>
					<div class="title-mono"><?php echo $block_eyebrow; ?></div>
				<?php } ?>
				<h2><?php echo $block_title; ?></h2>
				<?php if ($block_desc) { ?>
					<p class="desc"><?php echo $block_desc; ?></p>
				<?php } ?>
			</div>
		<?php } ?>
		<div class="embla-instance">
			<div class="embla">
				<div class="embla__container">
					<?php foreach ($cards as $card) {
						$tag = Arrays::get_value_as_string($card, 'tag');
						$tag_color = Arrays::get_value_as_string($card, 'tag_color') ?: 'red';
						$image = Arrays::get_value_as_array($card, 'logo');
						$company_name = Arrays::get_value_as_string($card, 'company_name');
						$title = Arrays::get_value_as_string($card, 'title');
						$desc = Arrays::get_value_as_string($card, 'desc');
						$stat_1_value = Arrays::get_value_as_string($card, 'stat_1_value');
						$stat_1_label = Arrays::get_value_as_string($card, 'stat_1_label');
						$stat_2_value = Arrays::get_value_as_string($card, 'stat_2_value');
						$stat_2_label = Arrays::get_value_as_string($card, 'stat_2_label');
						$link_values = BlueprintBlocks::get_button_field_values('link', $card);
						$link = $link_values->link;
						$button_text = $link_values->text ?: 'Read the story';
					?>
						<div class="embla__slide">
							<a class="block-case-slide__card" href="<?php echo $link; ?>">
								<?php if ($tag) { ?>
									<div class="block-case-slide__card-tag block-case-slide__card-tag--<?php echo $tag_color; ?>">
										<span class="block-case-slide__card-tag-dot"></span>
										<?php echo $tag; ?>
									</div>
								<?php } ?>
								<div class="block-case-slide__card-logo">
									<?php if ($image) {
										Images::safe_image_output($image, ['data-lazy-ignore' => 'true']);
									} elseif ($company_name) { ?>
										<span class="block-case-slide__card-logo-text"><?php echo $company_name; ?></span>
									<?php } ?>
								</div>
								<h3 class="block-case-slide__card-title"><?php echo $title; ?></h3>
								<?php if ($desc) { ?>
									<p class="block-case-slide__card-desc"><?php echo $desc; ?></p>
								<?php } ?>
								<?php if ($stat_1_value || $stat_2_value) { ?>
									<div class="block-case-slide__card-stats">
										<?php if ($stat_1_value) { ?>
											<div class="block-case-slide__card-stat">
												<span class="block-case-slide__card-stat-value"><?php echo $stat_1_value; ?></span>
												<?php if ($stat_1_label) { ?>
													<span class="block-case-slide__card-stat-label"><?php echo $stat_1_label; ?></span>
												<?php } ?>
											</div>
										<?php } ?>
										<?php if ($stat_2_value) { ?>
											<div class="block-case-slide__card-stat">
												<span class="block-case-slide__card-stat-value"><?php echo $stat_2_value; ?></span>
												<?php if ($stat_2_label) { ?>
													<span class="block-case-slide__card-stat-label"><?php echo $stat_2_label; ?></span>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
								<div>
									<span class="button-link">
										<?php echo $button_text; ?>
									</span>
								</div>
							</a>
						</div>
					<?php } ?>
				</div>
				<div class="embla__controls">
					<button class="embla__nav-button embla__nav-button--prev" type="button" aria-label="<?php esc_attr_e('Previous resource', Constants\TextDomains::DEFAULT); ?>">
						<?php SVG::the_svg('general/chevron-left', ['class' => 'embla__nav-arrow embla__nav-arrow--left']); ?>
					</button>
					<div class="embla__pagination"></div>
					<button class="embla__nav-button embla__nav-button--next" type="button" aria-label="<?php esc_attr_e('Next resource', Constants\TextDomains::DEFAULT); ?>">
						<?php SVG::the_svg('general/chevron-right', ['class' => 'embla__nav-arrow embla__nav-arrow--right']); ?>
					</button>
				</div>
			</div>
		</div>
		<?php if ($view_all_link) { ?>
			<div class="block-case-slide__view-all">
				<a class="button-link" href="<?php echo $view_all_link; ?>"><?php echo $view_all_text; ?></a>
			</div>
		<?php } ?>
	</div>
<?php
}
