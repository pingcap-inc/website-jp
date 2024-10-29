<?php

use WPUtil\Vendor\{ACF, BlueprintBlocks};
use WPUtil\{Arrays, Component};
use PingCAP\Components;

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$block_title_desc = isset($block_title_desc) && is_string($block_title_desc) ? $block_title_desc : ACF::get_sub_field_string('block_title_desc');
$card_type = isset($card_type) && is_string($card_type) ? $card_type : ACF::get_sub_field_string('card_type');

if (!in_array($card_type, ['', 'media', 'solution', 'integration', 'bg', 'workload', 'tier'], true)) {
	$card_type = '';
}

$cards = isset($cards) && is_array($cards) ? $cards : [];

if (!$cards) {
	switch ($card_type) {
		case 'solution':
			$cards = ACF::get_sub_field_array('solution_cards');
			break;

		case 'integration':
			$cards = ACF::get_sub_field_array('integration_cards');
			break;

		case 'bg':
			$cards = ACF::get_sub_field_array('bg_cards');
			break;

		case 'media':
			$cards = ACF::get_sub_field_array('media_cards');
			break;

		case 'workload':
			$cards = ACF::get_sub_field_array('workload_cards');
			break;

		case 'tier':
			$cards = ACF::get_sub_field_array('tier_cards');
			break;

		default:
			$cards = ACF::get_sub_field_array('default_cards');
			break;
	}
}

if ($cards) {
	$num_cols = 1;
	$block_classes = ['block-inner', 'contain'];

	switch ($card_type) {
		case 'solution':
			$num_cols = 4;
			break;

		case 'integration':
			$num_cols = 3;
			break;

		case 'bg':
			$num_cols = 4;
			break;

		case 'tier':
			$block_classes[] = 'tier';
			break;

		case 'workload':
			$block_classes[] = 'workload';
			break;

		default:
			$num_cols = count($cards) % 2 === 0 ? 2 : 3;

			if (count($cards) === 1) {
				$num_cols = 1;
			}

			break;
	}

?>
	<div class="<?php echo esc_attr(implode(' ', $block_classes)); ?>">

		<?php if ($block_title || $block_title_desc) { ?>
			<div class="block-section__title-container contain">
				<?php
				if ($block_title) {
				?>
					<h2 class="block-section__title"><?php echo esc_html($block_title); ?></h2>

				<?php } ?>
				<?php
				if ($block_title_desc) {
				?>
					<div class="block-section__title-desc"><?php echo $block_title_desc; ?></div>

				<?php } ?>
			</div>
		<?php } ?>

		<div class="block-cards__container" data-num-cols="<?php echo esc_attr($num_cols); ?>">

			<?php
			foreach ($cards as $card) {
				$component_name = Components\Cards\CardTextContent::class;
				$render_params = [];

				switch ($card_type) {
					case 'solution':
						$component_name = Components\Cards\CardIllustration::class;
						$link = BlueprintBlocks::get_button_field_values('link', $card);

						$render_params = [
							'illustration_file_info' => Arrays::get_value_as_array($card, 'illustration_file'),
							'title' => Arrays::get_value_as_string($card, 'title'),
							'permalink' => $link->link
						];

						break;

					case 'integration':
						$component_name = Components\Cards\CardIntegration::class;
						$link = BlueprintBlocks::get_button_field_values('link', $card);

						$render_params = [
							'image' => Arrays::get_value_as_array($card, 'image'),
							'is_full' => Arrays::get_value_as_bool($card, 'is_full'),
							'title' => Arrays::get_value_as_string($card, 'title'),
							'content' => Arrays::get_value_as_string($card, 'content'),
							'permalink' => $link->link
						];

						break;

					case 'bg':
						$component_name = Components\Cards\CardBg::class;
						$link = BlueprintBlocks::get_button_field_values('link', $card);

						$render_params = [
							'image' => Arrays::get_value_as_array($card, 'image'),
							'card_bg_color' => Arrays::get_value_as_string($card, 'card_bg_color'),
							'title' => Arrays::get_value_as_string($card, 'title'),
							'desc' => Arrays::get_value_as_string($card, 'desc'),
							'permalink' => $link->link,
							'permalink_text' => $link->text
						];

						break;

					case 'workload':
						$component_name = Components\Cards\CardWorkload::class;

						$render_params = [
							'image' => Arrays::get_value_as_array($card, 'image'),
							'subtitle' => Arrays::get_value_as_string($card, 'subtitle'),
							'title' => Arrays::get_value_as_string($card, 'title'),
							'content' => Arrays::get_value_as_string($card, 'content'),
						];

						break;

					case 'media':
						$component_name = Components\Cards\CardMedia::class;
						$link = BlueprintBlocks::get_button_field_values('link', $card);

						$render_params = [
							'icon_type' => Arrays::get_value_as_string($card, 'icon_type'),
							'icon_image' => Arrays::get_value_as_array($card, 'icon_image'),
							'icon_font' => Arrays::get_value_as_string($card, 'icon_font'),
							'title' => Arrays::get_value_as_string($card, 'title'),
							'content' => Arrays::get_value_as_string($card, 'content'),
							'permalink' => $link->link,
							'permalink_text' => $link->text,
						];

						break;

					case 'tier':
						$component_name = Components\Cards\CardTier::class;

						$render_params = [
							'title' => Arrays::get_value_as_string($card, 'title'),
							'sub_title' => Arrays::get_value_as_string($card, 'sub_title'),
							'button' => Arrays::get_value_as_array($card, 'button'),
							'second_button' => Arrays::get_value_as_array($card, 'second_button'),
							'content' => Arrays::get_value_as_string($card, 'content'),
							'set_price' => Arrays::get_value_as_bool($card, 'set_price'),
							'tabs' => Arrays::get_value_as_array($card, 'tabs'),
							'link' => Arrays::get_value_as_array($card, 'link'),
						];

						break;

					default:
						$link = BlueprintBlocks::get_button_field_values('button', $card);

						$render_params = [
							'svg_icon' => Arrays::get_value_as_array($card, 'svg_icon'),
							'title' => Arrays::get_value_as_string($card, 'title'),
							'label' => Arrays::get_value_as_string($card, 'label'),
							'content' => Arrays::get_value_as_string($card, 'content'),
							'link_text' => $link->text,
							'link_url' => $link->link
						];

						break;
				}

				Component::render($component_name, $render_params);
			}
			?>

		</div>

		<?php
		$view_more_link = BlueprintBlocks::get_button_field_values('title_link', ACF::get_sub_field_array('view_more_button'))->link;
		if ($view_more_link) {
		?>
			<div class="block-section__more">
				<a class="button button--secondary" href="<?php echo esc_url($view_more_link); ?>">
					View More
				</a>
			</div>
		<?php
		}
		?>
	</div>
<?php
}
