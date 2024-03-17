<?php

use WPUtil\Vendor\ACF;
use WPUtil\{Arrays, Component};
use PingCAP\{Components, Constants, CPT, Taxonomies};
use Blueprint\Images;

$block_title = ACF::get_sub_field_string('title');
$case_study_id = ACF::get_sub_field_int('case_study_id');
$link_text = ACF::get_sub_field_string('link_text', [
	'default' => __('Full Case Study', Constants\TextDomains::DEFAULT)
]);

if ($case_study_id) {
	$customer_term = CPT\CaseStudy::getCustomerTerm($case_study_id);
	$customer_image = $customer_term ? Taxonomies\Customer::getLogoImageACFObject($customer_term->term_id) : null;
	$featured_content_type = ACF::get_field_string('featured_content_type', $case_study_id);
	$featured_testimonial_id = 0;
	$featured_stats = [];

	switch ($featured_content_type) {
		case 'testimonial':
			$featured_testimonial_id = ACF::get_field_int('featured_testimonial_id', $case_study_id);

			break;

		case 'stats':
			$featured_stats = ACF::get_field_array('featured_stats', $case_study_id);

			break;

		default:
			break;
	}

?>
	<div class="block-inner contain">
		<div class="block-section__title-container">
			<h2 class="block-section__title"><?php esc_html_e('Case Study', Constants\TextDomains::DEFAULT); ?></h2>
		</div>
		<div class="block-case-study__grid">
			<div class="block-case-study__container">
				<?php
				if ($customer_image) {
				?>
					<div class="block-case-study__logo">
						<?php Images::safe_image_output($customer_image, ['class' => 'block-case-study__logo-image']); ?>
					</div>
				<?php
				}
				?>
				<div class="block-case-study__content">
					<h5 class="block-case-study__post-title"><?php echo esc_html(get_the_title($case_study_id)); ?></h5>
					<?php echo wp_kses_post(wpautop(get_the_excerpt($case_study_id))); ?>
				</div>
				<div class="block-case-study__btn-container">
					<a class="button" href="<?php echo esc_url(get_the_permalink($case_study_id)); ?>"><?php echo esc_html($link_text); ?></a>
				</div>
			</div>
			<?php
			if ($featured_content_type) {
			?>
				<div class="block-case-study__box-content bg-white">
					<?php
					switch ($featured_content_type) {
						case 'testimonial':
							if ($featured_testimonial_id) {
								$content = CPT\Testimonial::getTestimonial($featured_testimonial_id);
								$attribution = CPT\Testimonial::getAttribution($featured_testimonial_id);

								Component::render(Components\Testimonial::class, [
									'content' => $content,
									'attribution' => $attribution
								]);
							}

							break;

						case 'stats':
							if ($featured_stats) {
								foreach ($featured_stats as $stat) {
									Component::render(Components\BasicStat::class, [
										'value' => Arrays::get_value_as_string($stat, 'stat_value'),
										'description' => Arrays::get_value_as_string($stat, 'stat_desc')
									]);
								}
							}

							break;

						default:
							break;
					}
					?>
				</div>
			<?php
			}
			?>
		</div>
	</div>
<?php
}
