<?php

use WPUtil\{Arrays, Component, Vendor};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants};
use Blueprint\Images;

$display_type = isset($display_type) && is_string($display_type) ? $display_type : ACF::get_sub_field_string('display_type', ['default' => 'slim']);

?>
<div class="block-inner contain">
	<?php
	if ($display_type === 'slim') {
		$slim_fields = isset($slim_fields) && is_array($slim_fields) ? $slim_fields : ACF::get_sub_field_array('slim_fields');
		$heading = Arrays::get_value_as_string($slim_fields, 'heading');
		$action_type = Arrays::get_value_as_string($slim_fields, 'action_type');
		$text_align_mode = Arrays::get_value_as_string($slim_fields, 'text_align_mode');
		$bg = Arrays::get_value_as_array($slim_fields, 'bg_image');
		$cta_slim_container_classes = ['block-cta__slim-container', $bg ? 'bg-blue' : ''];
		if ($text_align_mode) {
			$cta_slim_container_classes[] = 'block-cta__slim-container--has-center';
		}
		if ($bg) {
			$cta_style = 'background-image:url(' . $bg['url'] . ')';
		}
	?>
		<div class="<?php echo esc_attr(implode(' ', $cta_slim_container_classes)); ?>" style="<?php echo $cta_style ?? ''; ?>">
			<h3 class="block-cta__slim-heading"><?php echo esc_html($heading); ?></h3>
			<?php
			switch ($action_type) {
				case 'button':
					$button_fields = Arrays::get_value_as_array($slim_fields, 'button_fields');
					$button = Vendor\BlueprintBlocks::get_button_field_values('button', $button_fields);

					Component::render(Components\UI\Button::class, [
						'link' => $button->link,
						'text' => $button->text
					]);

					break;

				case 'form':
			?>
					<div class="block-cta__subscribe-form">
						<?php
						$form_id = Arrays::get_value_as_string($slim_fields, 'hs_form_id');
						if ($form_id) {
							echo do_shortcode('[hubspot_form dark="true" portal_id="4466002" form_id="' . esc_attr($form_id) . '"]');
						}
						?>
					</div>
			<?php
					break;

				default:
					break;
			}
			?>
		</div>
	<?php } else if ($display_type === 'minimal') {
		$minimal_fields = isset($minimal_fields) && is_array($minimal_fields) ? $minimal_fields : ACF::get_sub_field_array('minimal_fields');
		$image = Arrays::get_value_as_array($minimal_fields, 'image');
		$content = Arrays::get_value_as_string($minimal_fields, 'content');
	?>
		<div class="block-cta__minimal">
			<div class="block-cta__minimal-image">
				<?php echo Images::safe_image_output($image); ?>
			</div>
			<div class="block-cta__minimal-content">
				<?php echo $content; ?>
			</div>
		</div>
		<?php
	} else {
		$normal_fields = isset($normal_fields) && is_array($normal_fields) ? $normal_fields : ACF::get_sub_field_array('normal_fields');
		$columns = Arrays::get_value_as_array($normal_fields, 'columns');

		foreach ($columns as $column) {
			$title = Arrays::get_value_as_string($column, 'title');
			$icon_image = Arrays::get_value_as_array($column, 'icon_image');
			$content = Arrays::get_value_as_string($column, 'content');
			$buttons = array_map(
				fn($button) => Vendor\BlueprintBlocks::get_button_field_values('button', $button),
				Arrays::get_value_as_array($column, 'buttons')
			);

		?>
			<div class="block-cta__column">
				<?php
				if ($title) {
				?>
					<div class="block-cta__column-title-container">
						<?php
						if ($icon_image) {
							Images::safe_image_output($icon_image, ['class' => 'block-cta__column-icon-image']);
						}
						?>
						<h2 class="block-cta__column-title"><?php echo esc_html($title); ?></h2>
					</div>
				<?php
				}

				if ($content) {
					echo wp_kses_post(wpautop($content));
				}

				if ($buttons) {
				?>
					<div class="block-cta__column-buttons">
						<?php
						foreach ($buttons as $button) {
							Component::render(Components\UI\Button::class, [
								'link' => $button->link,
								'text' => $button->text,
								'style' => $button->style,
								'gtag' => $button->gtag
							]);
						}
						?>
					</div>
				<?php
				}
				?>
			</div>
	<?php
		}
	}
	?>
</div>