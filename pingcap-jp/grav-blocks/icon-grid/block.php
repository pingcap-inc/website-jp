<?php

use WPUtil\Vendor\{ACF, BlueprintBlocks};
use WPUtil\Arrays;
use Blueprint\Images;

$grid_items = isset($grid_items) && is_array($grid_items) ? $grid_items : ACF::get_sub_field_array('grid_items');

if ($grid_items) {
	$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
	$block_title_desc = isset($block_title_desc) && is_string($block_title_desc) ? $block_title_desc : ACF::get_sub_field_string('block_title_desc');
	$column_count = isset($column_count) && is_int($column_count) ? $column_count : ACF::get_sub_field_int('column_count', ['default' => 2]);
	$center_content = $center_content ?? ACF::get_sub_field_bool('center_content', ['default' => false]);

	$inner_classes = ['block-inner', 'contain'];

	if ($column_count === 2) {
		$inner_classes[] = 'layout__padded-columns';
	}

	$container_classes = ['block-icon-grid__item-container'];

	if ($center_content) {
		$container_classes[] = 'block-icon-grid__item-container--center';
	}

?>
	<div class="<?php echo esc_attr(implode(' ', $inner_classes)); ?>">
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
		<div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>" data-column-count="<?php echo esc_attr($column_count); ?>">
			<?php
			foreach ($grid_items as $item) {
				$icon_image = Arrays::get_value_as_array($item, 'icon_image');
				$content = Arrays::get_value_as_string($item, 'content');
				$icon_size = Arrays::get_value_as_string($item, 'icon_size');

				if (!$icon_image || !$content) {
					continue;
				}

			?>
				<div class="block-icon-grid__item wysiwyg">
					<?php
					Images::safe_image_output($icon_image, ['class' => 'block-icon-grid__item-icon-image ' . $icon_size]);

					echo wp_kses_post(wpautop($content));
					?>
				</div>
			<?php
			}
			?>
		</div>

		<?php
		$view_more_link = BlueprintBlocks::get_button_field_values('title_link', ACF::get_sub_field_array('view_more_button'));
		if ($view_more_link->link && $view_more_link->text) {
		?>
			<div class="block-section__more">
				<a class="button button--secondary" href="<?php echo esc_url($view_more_link->link); ?>">
					<?php echo $view_more_link->text; ?>
				</a>
			</div>
		<?php
		}
		?>
	</div>
<?php
}
