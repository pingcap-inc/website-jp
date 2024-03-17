<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Component, Vendor };
use PingCAP\Components;

$featured_products = Arrays::get_value_as_array($values, 'featured_products');
$link_columns = Arrays::get_value_as_array($values, 'link_columns');

?>
<div class="menu-dropdown-products__inner">
	<?php
	foreach ($featured_products as $product)
	{
		$link = Vendor\BlueprintBlocks::get_button_field_values('product_link', $product);

		Component::render(Components\Cards\CardProduct::class, [
			'icon_image' => $product['icon'] ?? null,
			'title' => Arrays::get_value_as_string($product, 'name'),
			'description' => Arrays::get_value_as_string($product, 'description'),
			'permalink' => $link->link
		]);
	}

	foreach ($link_columns as $link_column)
	{
		$label = Arrays::get_value_as_string($link_column, 'label');
		$links = array_map(
			fn ($link) => Vendor\BlueprintBlocks::get_button_field_values('link', $link),
			Arrays::get_value_as_array($link_column, 'links')
		);

		?>
		<div class="menu-dropdown-products__links-column">
			<span class="menu-dropdown-products__links-column-label"><?php echo esc_html($label); ?></span>
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
	?>
</div>
