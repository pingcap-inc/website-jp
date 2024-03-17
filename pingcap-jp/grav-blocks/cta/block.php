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
		$cta_slim_container_classes = ['block-cta__slim-container', $bg ? 'bg-blue' : 'bg-black'];
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
					<form class="block-cta__subscribe-form" method="POST" action="<?php echo esc_url(home_url()); ?>" data-hs-portal-id="<?php echo esc_attr(Arrays::get_value_as_string($slim_fields, 'hs_portal_id')); ?>" data-hs-form-id="<?php echo esc_attr(Arrays::get_value_as_string($slim_fields, 'hs_form_id')); ?>" data-hs-name-field="<?php echo esc_attr(Arrays::get_value_as_string($slim_fields, 'hs_name_field')); ?>" data-hs-email-field="<?php echo esc_attr(Arrays::get_value_as_string($slim_fields, 'hs_email_field')); ?>">
						<input type="email" name="cta_email" placeholder="<?php _e('Email Address', Constants\TextDomains::DEFAULT); ?>" aria-label="<?php _e('Enter your email address', Constants\TextDomains::DEFAULT); ?>">
						<button class="button" type="submit" aria-label="<?php _e('Subscribe', Constants\TextDomains::DEFAULT); ?>">
							&gt;
						</button>
					</form>
			<?php
					break;

				default:
					break;
			}
			?>
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
				fn ($button) => Vendor\BlueprintBlocks::get_button_field_values('button', $button),
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