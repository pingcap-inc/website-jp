<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{Arrays, Component};
use PingCAP\Components;
use WPUtil\Vendor\{BlueprintBlocks};

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
				$description = Arrays::get_value_as_string($product, 'description');
			?>

				<div class="menu-dropdown__feature-column">
					<div class="menu-dropdown__feature-column-title-container">
						<?php
						Component::render(Components\UI\Button::class, [
							'link' => $link['url'],
							'text' => $title,
							'style' => 'button-text',
							'attributes' => ['data-gtag' => 'event:jp_navi_click,item_name:' . $title]
						]);
						?>
					</div>
					<div class="menu-dropdown__feature-column-content">
						<?php echo $description; ?>
					</div>

				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php
	foreach ($link_columns as $link_column) {
		$label = Arrays::get_value_as_string($link_column, 'label');
		$links = array_map(
			fn($link) => BlueprintBlocks::get_button_field_values('link', $link),
			Arrays::get_value_as_array($link_column, 'links')
		);
		$icons = Arrays::get_value_as_array($link_column, 'links');
	?>
		<div class="menu-dropdown__item menu-dropdown__links-column">
			<?php if ($label === 'エコシステム') { ?>
				<div class="menu-dropdown__item-ai">
					<span class="menu-dropdown__links-column-label">
						Capabilities
					</span>
					<a href="/ai/" data-gtag="event:jp_navi_click,item_name:ai">
						<i class="icon-exchange"></i>
						Vector Search
					</a>
				</div>
			<?php } ?>
			<span class="menu-dropdown__links-column-label">
				<?php echo esc_html($label); ?>
			</span>
			<?php
			foreach ($links as $index => $link) {
				$icon = Arrays::get_value_as_string($icons[$index], 'icon');
				$icon_classes = ['menu-dropdown__links-column-icon', $icon];
			?>
				<a href="<?php echo esc_url($link->link); ?>" data-gtag="event:jp_navi_click,item_name:<?php echo $link->text; ?>">
					<i class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>"></i>
					<?php echo esc_html($link->text); ?>
				</a>
			<?php
			}
			?>
			<?php if ($label === 'エコシステム') { ?>
				<div class="menu-dropdown__item-pricing">
					<a class="button-text" href="/pricing/" data-gtag="event:jp_navi_click,item_name:pricing">
						料金
					</a>
				</div>
			<?php } ?>
		</div>
	<?php
	}
	?>
</div>