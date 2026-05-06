<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{Arrays, Vendor};
use Blueprint\Images;

$section_label = Arrays::get_value_as_string($values, 'section_label');
$links = Arrays::get_value_as_array($values, 'links');

?>
<div class="menu-dropdown-ai__inner">
	<?php if ($section_label) { ?>
		<span class="menu-dropdown-ai__label"><?php echo esc_html($section_label); ?></span>
	<?php } ?>
	<div class="menu-dropdown-ai__links">
		<?php
		foreach ($links as $item) {
			$icon = Arrays::get_value_as_array($item, 'icon');
			$title = Arrays::get_value_as_string($item, 'title');
			$description = Arrays::get_value_as_string($item, 'description');
			$link = Vendor\BlueprintBlocks::get_button_field_values('link', $item);
		?>
			<a class="menu-dropdown-ai__link" href="<?php echo esc_url($link->link); ?>" data-gtag="event:eng_navi_click,item_name:<?php echo esc_attr($title); ?>">
				<?php if ($icon) { ?>
					<div class="menu-dropdown-ai__link-icon">
						<?php Images::safe_image_output($icon); ?>
					</div>
				<?php } ?>
				<div class="menu-dropdown-ai__link-content">
					<span class="menu-dropdown-ai__link-title"><?php echo esc_html($title); ?></span>
					<?php if ($description) { ?>
						<span class="menu-dropdown-ai__link-desc"><?php echo esc_html($description); ?></span>
					<?php } ?>
				</div>
			</a>
		<?php } ?>
	</div>
</div>
