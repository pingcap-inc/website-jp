<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Component, Vendor };
use PingCAP\Components;

$products = Arrays::get_value_as_array($values, 'products');

?>
<div class="menu-dropdown-cta__inner">
	<?php
	foreach ($products as $product)
	{
		$links = Arrays::get_value_as_array($product, 'links');
		$links_markup = array_map(function ($link) {
			$link_values = Vendor\BlueprintBlocks::get_button_field_values('link', $link);

			return Component::render_to_string(Components\UI\Button::class, [
				'link' => $link_values->link,
				'text' => $link_values->text,
				'style' => 'button--secondary'
			]);
		}, $links);

		Component::render(Components\Cards\CardProduct::class, [
			'icon_image' => $product['icon'] ?? null,
			'title' => Arrays::get_value_as_string($product, 'name'),
			'description' => implode('', $links_markup),
			'permalink' => ''
		]);
	}
	?>
</div>
