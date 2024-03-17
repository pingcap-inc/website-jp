<?php

use WPUtil\Vendor\ACF;
use WPUtil\{Component, SVG};
use PingCAP\{Blocks, Components, Constants, CPT};

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$block_title_desc = isset($block_title_desc) && is_string($block_title_desc) ? $block_title_desc : ACF::get_sub_field_string('block_title_desc');
$view_all_enabled = $view_all_enabled ?? ACF::get_sub_field_bool('view_all_enabled');

$relationship_source = isset($relationship_source) && is_string($relationship_source) ?
	$relationship_source :
	ACF::get_sub_field_string('relationship_source');

$post_ids = [];

switch ($relationship_source) {
	case 'tag':
		$tags = get_the_terms(get_the_ID(), Constants\Taxonomies::BLOG_TAG);
		$tag_ids = is_array($tags) ? array_map(fn ($tag) => $tag->term_id, $tags) : [];

		$post_ids = CPT\Resources::getRelatedPostIds(get_the_ID(), [
			'taxonomy' => Constants\Taxonomies::BLOG_TAG,
			'term_ids' => $tag_ids,
			'fill_remaining' => ACF::get_sub_field_bool('fill_remaining_posts', ['default' => true]),
			'num_posts' => ACF::get_sub_field_int('num_results', ['default' => 3])
		]);

		break;

	case 'category':
		$cats = get_the_terms(get_the_ID(), Constants\Taxonomies::BLOG_CATEGORY);
		$cat_ids = is_array($cats) ? array_map(fn ($cat) => $cat->term_id, $cats) : [];

		$post_ids = CPT\Resources::getRelatedPostIds(get_the_ID(), [
			'taxonomy' => Constants\Taxonomies::BLOG_CATEGORY,
			'term_ids' => $cat_ids,
			'fill_remaining' => ACF::get_sub_field_bool('fill_remaining_posts', ['default' => true]),
			'num_posts' => ACF::get_sub_field_int('num_results', ['default' => 3])
		]);

		break;

	case 'custom_tag':
		$tag_ids = ACF::get_sub_field_array('custom_tag');

		$post_ids = CPT\Resources::getRelatedPostIds(get_the_ID(), [
			'taxonomy' => Constants\Taxonomies::BLOG_TAG,
			'term_ids' => $tag_ids,
			'fill_remaining' => ACF::get_sub_field_bool('fill_remaining_posts', ['default' => true]),
			'num_posts' => ACF::get_sub_field_int('num_results', ['default' => 3])
		]);

		break;

	case 'custom_category':
		$cat_ids = ACF::get_sub_field_array('custom_category');

		$post_ids = CPT\Resources::getRelatedPostIds(get_the_ID(), [
			'taxonomy' => Constants\Taxonomies::BLOG_CATEGORY,
			'term_ids' => $cat_ids,
			'fill_remaining' => ACF::get_sub_field_bool('fill_remaining_posts', ['default' => true]),
			'num_posts' => ACF::get_sub_field_int('num_results', ['default' => 3])
		]);

		break;

	case 'custom':
		$post_ids = isset($custom_resource_ids) && is_array($custom_resource_ids) ? $custom_resource_ids : ACF::get_sub_field_array('custom_resource_ids');

		break;

	default:
		// get most recent posts
		$post_ids = get_posts([
			'fields' => 'ids',
			'post_type' => CPT\Resources::getResourcePostTypes(),
			'post_status' => 'publish',
			'posts_per_page' => ACF::get_sub_field_int('num_results', ['default' => 3]), // phpcs:ignore
			'post__not_in' => [get_the_ID()]
		]);

		break;
}

// When pulling the most recent posts from the 'default' case in the above switch
// statement, any "sticky" posts will also be added to the results causing the
// "posts_per_page" value to different from what is actually returned. Let's make
// sure that only 3 (or 6) posts are actually displayed.
if ($relationship_source !== 'custom') {
	$num_posts = ACF::get_sub_field_int('num_results', ['default' => 3]);

	if (count($post_ids) > $num_posts) {
		$post_ids = array_slice($post_ids, 0, $num_posts);
	}
}

if (count($post_ids)) {
?>
	<div class="block-inner">
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

		<div class="block-resources__cards contain">
			<?php
			foreach ($post_ids as $post_id) {
				Component::render(Components\Cards\CardResource::class, [
					'post_id' => $post_id
				]);
			}
			?>
		</div>
		<div class="block-resources__cards-mobile">
			<div class="block-resources__mobile-slides contain embla-instance" data-transition-speed="10">
				<div class="embla">
					<div class="embla__container">
						<?php
						foreach ($post_ids as $post_id) {
						?>
							<div class="embla__slide">
								<?php
								Component::render(Components\Cards\CardResource::class, [
									'post_id' => $post_id
								]);
								?>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="block-resources__mobile-nav contain">
				<button class="embla__nav-button embla__nav-button--prev" type="button" aria-label="<?php esc_attr_e('Previous resource', Constants\TextDomains::DEFAULT); ?>">
					<?php SVG::the_svg('general/chevron-left', ['class' => 'embla__nav-arrow embla__nav-arrow--left']); ?>
				</button>
				<div class="embla__pagination"></div>
				<button class="embla__nav-button embla__nav-button--next" type="button" aria-label="<?php esc_attr_e('Next resource', Constants\TextDomains::DEFAULT); ?>">
					<?php SVG::the_svg('general/chevron-right', ['class' => 'embla__nav-arrow embla__nav-arrow--right']); ?>
				</button>
			</div>
		</div>

		<?php
		if ($view_all_enabled) {
			$view_all_text = isset($view_all_text) && is_string($view_all_text) ?
				$view_all_text :
				ACF::get_sub_field_string(
					'view_all_text',
					['default' => __('View All', Constants\TextDomains::DEFAULT)]
				);

			$view_all_link_type = isset($view_all_link_type) && is_string($view_all_link_type) ?
				$view_all_link_type :
				ACF::get_sub_field_string('view_all_link_type');

			$view_all_link = Blocks\RelatedResources::getViewAllLink($view_all_link_type);

		?>
			<div class="block-section__more">
				<a class="button button--secondary" href="<?php echo esc_url($view_all_link); ?>">
					<?php echo esc_html($view_all_text); ?>
				</a>
			</div>
		<?php
		}
		?>
	</div>
<?php
}
