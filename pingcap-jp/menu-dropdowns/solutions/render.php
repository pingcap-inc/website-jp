<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Component, Vendor };
use PingCAP\Components;

$solution_cards = Arrays::get_value_as_array($values, 'solution_cards');

?>
<div class="menu-dropdown-solutions__inner" data-card-count="<?php echo esc_attr(count($solution_cards)); ?>">
	<?php
	foreach ($solution_cards as $card)
	{
		$link = Vendor\BlueprintBlocks::get_button_field_values('link', $card);

		Component::render(Components\Cards\CardIllustration::class, [
			'illustration_file_info' => Arrays::get_value_as_array($card, 'illustration_file'),
			'title' => Arrays::get_value_as_string($card, 'title'),
			'permalink' => $link->link
		]);
	}
	?>
</div>
