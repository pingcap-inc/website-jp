<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{Arrays, Component, Vendor};
use PingCAP\Components;

$featured_products = Arrays::get_value_as_array($values, 'featured_products');
$link_columns = Arrays::get_value_as_array($values, 'link_columns');

foreach ($featured_products as $product) {
	$link = Arrays::get_value_as_array($product, 'product_link');
	$title = Arrays::get_value_as_string($product, 'name');
	$description = Arrays::get_value_as_string($product, 'description');
?>
	<div class="mobile-menu-default__primary-section">
		<?php
		Component::render(Components\UI\Button::class, [
			'link' => $link['url'],
			'text' => $title,
			'style' => 'button-text',
			'attributes' => ['data-gtag' => 'event:jp_navi_click,item_name:' . $title]
		]);
		?>
		<?php echo $description; ?>
	</div>
<?php
}

foreach ($link_columns as $link_column) {
	$label = Arrays::get_value_as_string($link_column, 'label');
	$link_column_style = Arrays::get_value_as_bool($link_column, 'link_column_style');
	$links = array_map(
		fn($link) => Vendor\BlueprintBlocks::get_button_field_values('link', $link),
		Arrays::get_value_as_array($link_column, 'links')
	);
	$icons = Arrays::get_value_as_array($link_column, 'links');
?>
	<?php if ($label === 'エコシステム') { ?>
		<div class="mobile-menu-default__section-links-column">
			<div class="mobile-menu-default__section-links-column-label">Capabilities</div>
			<div class="mobile-menu-default__section-links-column-links ">
				<a href="/ai/" data-gtag="event:jp_navi_click,item_name:Vector Search"><i class="menu-dropdown__links-column-icon icon-exchange"></i>Vector Search</a>
			</div>
		</div>
	<?php } ?>
	<div class="mobile-menu-default__section-links-column">
		<?php if ($label) { ?>
			<div class="mobile-menu-default__section-links-column-label"><?php echo esc_html($label); ?></div>
		<?php } ?>
		<div class="mobile-menu-default__section-links-column-links <?php echo $link_column_style ? 'one' : ''; ?>">
			<?php
			foreach ($links as $index => $link) {
				if (!$link->link || !$link->text) {
					continue;
				}
				$icon = Arrays::get_value_as_string($icons[$index], 'icon');
				$icon_classes = ['menu-dropdown__links-column-icon', $icon];
				if (!$icon) {
					Component::render(Components\UI\Button::class, [
						'link' => $link->link,
						'text' => $link->text,
						'style' => 'button-text',
						'attributes' => ['data-gtag' => 'event:jp_navi_click,item_name:' . $link->text]
					]);
				} else {
			?>
					<a href="<?php echo esc_url($link->link); ?>" data-gtag="event:jp_navi_click,item_name:<?php echo $link->text; ?>"><i class="<?php echo esc_attr(implode(' ', $icon_classes)); ?>"></i><?php echo esc_html($link->text); ?></a>
			<?php
				}
			}
			?>
		</div>
	</div>
	<?php if ($label === 'エコシステム') { ?>
		<div class="mobile-menu-default__section-links-column">
			<div class="mobile-menu-default__section-links-column-links ">
				<a class="button-text" href="/pricing/" data-gtag="event:jp_navi_click,item_name:Pricing">Pricing </a>
			</div>
		</div>
	<?php } ?>
<?php
}
