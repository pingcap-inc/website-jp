<?php

use PingCAP\{Components, Constants, CPT, Taxonomies};
use Blueprint\Images;
use WPUtil\{Component, Vendor};
use WPUtil\Vendor\ACF;

get_header();

Component::render(Components\Banners\BannerCaseStudy::class);

?>
<main class="tmpl-single-case-study">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			$post_id = get_the_ID();

			$customer_term = CPT\CaseStudy::getCustomerTerm($post_id);

			$industry_terms = get_the_terms($post_id, Constants\Taxonomies::INDUSTRY);
			$tag_terms = get_the_terms($post_id, Constants\Taxonomies::BLOG_TAG);
			$sidebar_stats = ACF::get_field_array('sidebar_stats');

			$sidebar_cta = ACF::get_field_array('sidebar_cta', $post_id);
	?>
			<div class="contain tmpl-single-case-study__container">
				<div class="tmpl-single-case-study__content">
					<div class="tmpl-single-case-study__post-content wysiwyg wysiwyg--post-content">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="tmpl-single-case-study__company">
					<div class="tmpl-single-case-study__company-inner <?php echo $sidebar_cta ? '' : 'sticky'; ?>">
						<?php
						if ($customer_term) {
							$image = Taxonomies\Customer::getLogoImageACFObject($customer_term->term_id);

							if ($image) {
						?>
								<div class="tmpl-single-case-study__company-image-container">
									<?php Images::safe_image_output($image, ['class' => 'tmpl-single-case-study__company-image']); ?>
								</div>
							<?php
							}
						}

						if (is_array($industry_terms) || is_array($tag_terms)) {
							?>
							<div class="tmpl-single-case-study__term-links-container">
								<?php
								if (is_array($industry_terms)) {
									$industry_links = array_map(
										fn ($term) => sprintf('<a class="tag" href="%s">%s</a>', get_term_link($term), $term->name),
										$industry_terms
									);

								?>
									<div class="tmpl-single-case-study__term-links">
										<h6><?php esc_html_e('Industry', Constants\TextDomains::DEFAULT); ?></h6>
										<span><?php echo wp_kses_post(implode(', ', $industry_links)); ?></span>
									</div>
								<?php
								}

								if (is_array($tag_terms)) {
									$tag_links = array_map(
										fn ($term) => sprintf('<a class="tag" href="%s">%s</a>', get_term_link($term), $term->name),
										$tag_terms
									);

								?>
									<div class="tmpl-single-case-study__term-links">
										<h6><?php esc_html_e('Tags', Constants\TextDomains::DEFAULT); ?></h6>
										<span><?php echo wp_kses_post(implode(' ', $tag_links)); ?></span>
									</div>
								<?php
								}
								?>
							</div>
						<?php
						}

						if ($sidebar_stats) {
							Component::render(Components\StatsCarousel::class, [
								'stats' => $sidebar_stats,
								'is_small' => true
							]);
						}

						?>
					</div>
					<?php
					if ($sidebar_cta) {
						Component::render(Components\SidebarCTA::class, [
							'sidebar_cta_id' => $sidebar_cta[0],
							'is_sticky' => true
						]);
					}
					?>
				</div>
				<div class="tmpl-single-case-study__company-cta">
					<?php
					if ($sidebar_cta) {
						Component::render(Components\SidebarCTA::class, [
							'sidebar_cta_id' => $sidebar_cta[0],
						]);
					}
					?>
				</div>
				<div class="tmpl-single-case-study__share-icons">
					<div class="tmpl-single-case-study__share-icons-inner">
						<span class="tmpl-single-case-study__share-icons-text"><?php esc_html_e('Share', Constants\TextDomains::DEFAULT); ?>:</span>
						<?php
						Component::render(Components\UI\ShareIcon::class, [
							'site' => 'Facebook'
						]);

						Component::render(Components\UI\ShareIcon::class, [
							'site' => 'Twitter'
						]);

						Component::render(Components\UI\ShareIcon::class, [
							'site' => 'LinkedIn'
						]);
						?>
					</div>
				</div>
			</div>
	<?php

			Vendor\BlueprintBlocks::safe_display();
		}

		Vendor\BlueprintBlocks::safe_display([
			'section' => Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_case_study_post_blocks_grav_blocks',
			'object' => 'option'
		]);
	}
	?>
</main>
<?php

get_footer();
