<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{Arrays, Vendor};
use Blueprint\Images;

$section_label = Arrays::get_value_as_string($values, 'section_label');
$links = Arrays::get_value_as_array($values, 'links');

if ($section_label) {
?>
	<div class="mobile-menu-default__section-links-column-label"><?php echo esc_html($section_label); ?></div>
	<div class="mobile-menu-default__section-links-column">
		<div class="mobile-menu-default__section-links-column-links">
		<?php
	}


	foreach ($links as $item) {
		$title = Arrays::get_value_as_string($item, 'title');
		$link = Vendor\BlueprintBlocks::get_button_field_values('link', $item);
		?>

			<a href="<?php echo esc_url($link->link); ?>"><?php echo esc_html($title); ?></a>
		<?php
	}
		?>
		</div>
	</div>