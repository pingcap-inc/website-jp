<?php

use WPUtil\Arrays;
use WPUtil\Vendor\{ACF, BlueprintBlocks};
use PingCAP\{Constants, CPT, Taxonomies};
use Blueprint\Images;

$customers = ACF::get_sub_field_array('customers');

if ($customers) {
	$block_title = ACF::get_sub_field_string('title');
	$block_title_desc = ACF::get_sub_field_string('title_desc');
	$enabled_animation = ACF::get_sub_field_bool('enabled_animation');
?>
	<div class="block-inner contain">
		<?php if ($block_title || $block_title_desc) { ?>
			<div class="block-section__title-container">
				<?php
				if ($block_title) {
				?>
					<h2 class="block-section__title"><?php echo $block_title; ?></h2>
				<?php } ?>
				<?php if ($block_title_desc) { ?>
					<h5 class="block-section__title-desc"><?php echo $block_title_desc; ?></h5>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="block-logos__logo">
			<?php
			if ($enabled_animation) {
				foreach (array_chunk($customers, 6) as $customers_arr) {
					echo '<div class="block-logos__logo-wrapper">';
					foreach (array_merge($customers_arr, $customers_arr) as $customer) {
						$link_to_case_study = Arrays::get_value_as_bool($customer, 'link_to_case_study');

						$customer_image = Arrays::get_value_as_array($customer, 'logo_image');
						$link_url = BlueprintBlocks::get_button_field_values('link', Arrays::get_value_as_array($customer, 'logo_link'))->link;

						if ($link_to_case_study) {
							$customer_term_id = Arrays::get_value_as_int($customer, 'customer_term_id');
							$cs_post_id = CPT\CaseStudy::getMostRecentIdForCustomer($customer_term_id);

							if ($cs_post_id) {
								$link_url = get_the_permalink($cs_post_id);
							}
						}

						echo '<div class="block-logos__column">';
						if ($link_url) {
							echo '<a href="' . esc_url($link_url) . '">';
						}
						Images::safe_image_output($customer_image, ['class' => 'block-logos__logo-image', 'data-ib-no-cache' => 1]);
						if ($link_url) {
							echo '</a>';
						}
						echo '</div>';
					}
					echo '</div>';
				}
			} else {
				echo '<div class="block-logos__logo-grid">';
				foreach ($customers as $customer) {
					$link_to_case_study = Arrays::get_value_as_bool($customer, 'link_to_case_study');

					$customer_image = Arrays::get_value_as_array($customer, 'logo_image');
					$link_url = BlueprintBlocks::get_button_field_values('link', Arrays::get_value_as_array($customer, 'logo_link'))->link;

					if ($link_to_case_study) {
						$customer_term_id = Arrays::get_value_as_int($customer, 'customer_term_id');
						$cs_post_id = CPT\CaseStudy::getMostRecentIdForCustomer($customer_term_id);

						if ($cs_post_id) {
							$link_url = get_the_permalink($cs_post_id);
						}
					}

					echo '<div class="block-logos__column">';
					if ($link_url) {
						echo '<a href="' . esc_url($link_url) . '">';
					}
					Images::safe_image_output($customer_image, ['class' => 'block-logos__logo-image', 'data-ib-no-cache' => 1]);
					if ($link_url) {
						echo '</a>';
					}
					echo '</div>';
				}
				echo '</div>';
			}
			?>
		</div>

		<?php
		$view_more_link = BlueprintBlocks::get_button_field_values('title_link', ACF::get_sub_field_array('view_more_button'));
		if ($view_more_link->link) {
		?>
			<div class="block-section__more">
				<a class="button button--secondary" href="<?php echo esc_url($view_more_link->link); ?>">
					<?php echo $view_more_link->text; ?>
				</a>
			</div>
		<?php } ?>

	</div>
<?php
}
