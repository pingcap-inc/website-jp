<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Vendor };

$solution_cards = Arrays::get_value_as_array($values, 'solution_cards');

foreach ($solution_cards as $card)
{
	$link = Vendor\BlueprintBlocks::get_button_field_values('link', $card);
	$title = Arrays::get_value_as_string($card, 'title');

	?>
	<a class="mobile-menu-default__section-link-large" href="<?php echo esc_url($link->link); ?>"><?php echo esc_html($title); ?></a>
	<?php
}
