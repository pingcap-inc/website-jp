<?php

use PingCAP\{Components, Constants, CPT, Posts};
use Blueprint\Images;
use WPUtil\{Component, Vendor};
use WPUtil\Vendor\ACF;

get_header();

$no_author_post_types = [
	Constants\CPT::COMMUNITY_ACTIVITY,
	Constants\CPT::EVENT,
	Constants\CPT::PARTNER,
	Constants\CPT::PRESS_RELEASE,
	Constants\CPT::EBOOK_WHITEPAPER
];

$post_type = get_post_type(get_the_ID());

$banner_params = [];

if ($post_type === Constants\CPT::COMMUNITY_ACTIVITY) {
	$banner_params['date'] = CPT\CommunityActivity::getDateLabel(get_the_ID());
}

if (in_array($post_type, [Constants\CPT::EVENT, Constants\CPT::PARTNER], true)) {
	$banner_params['date'] = '';
}

if (!in_array($post_type, $no_author_post_types, true)) {
	$additional_author_ids = array_reduce(
		Vendor\ACF::get_field_array('additional_authors'),
		function ($acum, $user) {
			$user_id = intval($user['ID'] ?? 0);

			if ($user_id && !in_array($user_id, $acum, true)) {
				$acum[] = $user_id;
			}

			return $acum;
		},
		[]
	);
	$banner_params['is_author_post_type'] = true;
	$banner_params['additional_author_ids'] = $additional_author_ids;
}

Component::render(Components\Banners\BannerResource::class, $banner_params);

?>
<main class="tmpl-single-post">
	<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();

			$featured_image = Posts::getFeaturedImageACFObject(get_the_ID());

			if ($featured_image) {
	?>
				<div class="contain tmpl-single-post__featured-image-container layout__padded-columns layout__padded-columns--double">
					<?php
					echo Images::safe_image_output($featured_image, ['class' => 'tmpl-single-post__featured-image']); // phpcs:ignore
					?>
				</div>
			<?php
			}
			?>
			<div class="contain tmpl-single-post__container">
				<div class="tmpl-single-post__content">
					<div class="tmpl-single-post__post-content wysiwyg wysiwyg--post-content">
						<?php the_content(); ?>
					</div>

					<?php
					$posttags = get_the_tags();
					if ($posttags) {
					?>
						<div class="meta-tags">
							<?php
							foreach ($posttags as $tag) {
								if ($post_type == 'post') {
									echo '<a href="/blog?tag=' . $tag->slug . '" class="tag">' . $tag->name . '</a>';
								} else {
									echo '<a href="' . get_term_link($tag) . '" class="tag">' . $tag->name . '</a>';
								}
							}
							?>
						</div>
					<?php } ?>
					<br />

					<?php if (ACF::get_field_bool('enable_playground_link')) { ?>
						<p><b><i><i class="tmpl-single-post__icon icon-confetti"></i> Want to explore TiDB without installing any software? Go to </i></b><a href="https://play.tidbcloud.com/?utm_source=pingcap&utm_medium=blogs" class="button button--secondary">TiDB Playground</a></p>
					<?php } ?>
				</div>

				<div class="tmpl-single-post__right-content">
					<?php
					$sidebar_cta = ACF::get_field_array('sidebar_cta', get_the_ID());
					if ($sidebar_cta) {
						Component::render(Components\SidebarCTA::class, [
							'sidebar_cta_id' => $sidebar_cta[0],
							'is_sticky' => true
						]);
					}
					?>
				</div>

				<div class="tmpl-single-post__share-icons">
					<div class="tmpl-single-post__share-icons-inner">
						<span class="tmpl-single-post__share-icons-text"><?php esc_html_e('Share', Constants\TextDomains::DEFAULT); ?>:</span>
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

		$blocks_section = '';

		switch ($post_type) {
			case Constants\CPT::BLOG:
				$blocks_section = Constants\ACF::BLOG_SETTINGS_BASE . '_blog_post_blocks_grav_blocks';
				break;

			case Constants\CPT::TRAINING:
				$blocks_section = Constants\ACF::TRAINING_SETTINGS_BASE . '_training_post_blocks_grav_blocks';
				break;

			case Constants\CPT::EVENT:
				$blocks_section = Constants\ACF::EVENT_SETTINGS_BASE . '_event_post_blocks_grav_blocks';
				break;

			case Constants\CPT::PARTNER:
				$blocks_section = Constants\ACF::PARTNER_SETTINGS_BASE . '_partner_post_blocks_grav_blocks';
				break;

			case Constants\CPT::COMMUNITY_ACTIVITY:
				$blocks_section = Constants\ACF::COMMUNITY_ACTIVITIES_SETTINGS_BASE . '_community_activity_post_blocks_grav_blocks';
				break;

			case Constants\CPT::EBOOK_WHITEPAPER:
				$blocks_section = Constants\ACF::EBOOK_WHITEPAPER_SETTINGS_BASE . '_ebook_whitepaper_post_blocks_grav_blocks';
				break;

			default:
				break;
		}

		Vendor\BlueprintBlocks::safe_display([
			'section' => $blocks_section,
			'object' => 'option'
		]);
	}
	?>
</main>
<?php

get_footer();
