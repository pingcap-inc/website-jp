<?php

use WPUtil\Vendor\ACF;
use WPUtil\Arrays;
use Blueprint\Images;

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$block_title_desc = isset($block_title_desc) && is_string($block_title_desc) ? $block_title_desc : ACF::get_sub_field_string('block_title_desc');
$leadership_cards = isset($leadership_cards) && is_array($leadership_cards) ? $leadership_cards : ACF::get_sub_field_array('leadership_cards');

if ($leadership_cards) {
?>
	<div class="block-inner contain">
		<?php if ($block_title || $block_title_desc) { ?>
			<div class="block-section__title-container">
				<?php
				if ($block_title) {
				?>
					<h2 class="block-section__title"><?php echo esc_html($block_title); ?></h2>
				<?php } ?>
				<?php if ($block_title_desc) { ?>
					<div class="block-section__title-desc"><?php echo $block_title_desc; ?></div>
				<?php } ?>
			</div>
		<?php } ?>
		<div class="block-leadership__cards-container" data-num-cards="<?php echo esc_attr(count($leadership_cards)); ?>">
			<?php
			foreach ($leadership_cards as $card) {
				$image = Arrays::get_value_as_array($card, 'image');
				$name = Arrays::get_value_as_string($card, 'name');
				$role = Arrays::get_value_as_string($card, 'role');

				if (!$image || !$name) {
					continue;
				}

			?>
				<div class="block-leadership__card">
					<div class="block-leadership__image-container">
						<?php Images::safe_image_output($image, ['class' => 'block-leadership__image']); ?>
					</div>
					<h5 class="block-leadership__name"><?php echo esc_html($name); ?></h5>
					<?php
					if ($role) {
					?>
						<span class="block-leadership__role"><?php echo esc_html($role); ?></span>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>
		</div>
	</div>
<?php
}
