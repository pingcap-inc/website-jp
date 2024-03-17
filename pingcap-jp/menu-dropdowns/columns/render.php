<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{Arrays, Component};
use PingCAP\Components;
use WPUtil\Vendor\{BlueprintBlocks};
use Blueprint\Images;

$featured_products = Arrays::get_value_as_array($values, 'featured_products');
$link_columns = Arrays::get_value_as_array($values, 'link_columns');
$is_feature_right = Arrays::get_value_as_string($values, 'format');
?>
<div class="<?php echo $is_feature_right ? 'menu-dropdown__inner-reserve' : 'menu-dropdown__inner'; ?>">
	<?php if ($featured_products) { ?>
		<div class="menu-dropdown__item menu-dropdown__feature">
			<?php
			foreach ($featured_products as $product) {
				$link = Arrays::get_value_as_array($product, 'product_link');
				$title = Arrays::get_value_as_string($product, 'name');
				$icon_image = $product['icon'] ?? null;
				$description = Arrays::get_value_as_string($product, 'description');
			?>

				<div class="menu-dropdown__feature-column">
					<div class="menu-dropdown__feature-column-title-container">
						<?php
						Images::safe_image_output($icon_image, ['class' => 'menu-dropdown__feature-column-image']);
						Component::render(Components\UI\Button::class, [
							'link' => $link['url'],
							'text' => $title,
							'style' => 'button--secondary',
							'attributes' => ['data-gtag' => 'event:eng_navi_click,item_name:' . $title]
						]);
						?>
					</div>
					<div class="menu-dropdown__feature-column-content">
						<?php echo $description; ?>
					</div>

				</div>
			<?php } ?>
		</div>
	<? } ?>
	<?php
	foreach ($link_columns as $link_column) {
		$label = Arrays::get_value_as_string($link_column, 'label');
		$links = array_map(
			fn ($link) => BlueprintBlocks::get_button_field_values('link', $link),
			Arrays::get_value_as_array($link_column, 'links')
		);
		$icons = Arrays::get_value_as_array($link_column, 'links');
	?>
		<div class="menu-dropdown__item menu-dropdown__links-column">
			<span class="menu-dropdown__links-column-label">
				<?php echo esc_html($label); ?>
			</span>
			<?php
			foreach ($links as $index => $link) {
				$icon = Arrays::get_value_as_string($icons[$index], 'icon');
				$icon_classes = ['menu-dropdown__links-column-icon', $icon];
			?>
				<a href="<?php echo esc_url($link->link); ?>" data-gtag="event:eng_navi_click,item_name:<?php echo $link->text; ?>">
					<i class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>"></i>
					<?php echo esc_html($link->text); ?>
				</a>
			<?php
			}
			?>
		</div>
	<?php
	}
	?>
</div>