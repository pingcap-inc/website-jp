<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Vendor };

$featured_products = Arrays::get_value_as_array($values, 'featured_products');
$link_columns = Arrays::get_value_as_array($values, 'link_columns');

foreach ($featured_products as $product)
{
	$link = Vendor\BlueprintBlocks::get_button_field_values('product_link', $product);
	$title = Arrays::get_value_as_string($product, 'name');

	?>
	<a class="mobile-menu-default__section-link-large" href="<?php echo esc_url($link->link); ?>"><?php echo esc_html($title); ?></a>
	<?php
}

foreach ($link_columns as $link_column)
{
	$label = Arrays::get_value_as_string($link_column, 'label');
	$links = array_map(
		fn ($link) => Vendor\BlueprintBlocks::get_button_field_values('link', $link),
		Arrays::get_value_as_array($link_column, 'links')
	);

	?>
	<div class="mobile-menu-default__section-links-column">
		<span class="mobile-menu-default__section-links-column-label"><?php echo esc_html($label); ?></span>
		<?php
		foreach ($links as $link)
		{
			if (!$link->link || !$link->text) {
				continue;
			}

			?>
			<a href="<?php echo esc_url($link->link); ?>"><?php echo esc_html($link->text); ?></a>
			<?php
		}
		?>
	</div>
	<?php
}
