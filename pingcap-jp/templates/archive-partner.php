<?php
use PingCAP\{ Components, Constants, CPT };
use WPUtil\{ Component, Vendor, Taxonomy };

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::PARTNER,
	'display_filters' => false
	// 'title' pulls from the "Partners / Partner Settings / Partner Archive / Archive Title" admin field
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<div class="tmpl-archive-outer-posts-container">
		<div class="tmpl-archive-posts-container">
			<?php
			global $wp_query;

			Component::render(Components\PostsList\PostsListBlog::class, [
				'wp_query_obj' => $wp_query,
				'featured_id' => CPT\Partner::getFeaturedId(),
				'api_endpoint' => 'wp/v2/partner'
			]);
			?>
		</div>

		<aside class="tmpl-archive-sidebar">
			<?php
			$post_ids = get_posts([
				'fields' => 'ids',
				'post_type' => 'partner',
				'post_status' => 'publish',
				'posts_per_page' => -1
			]);
			$tax_params = $post_ids ? ['object_ids' => $post_ids] : [];

			// phpcs:ignore
			$cur_category = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::PARTNER_ARCHIVE_FILTER_CATEGORY] ?? ''));
			$cat_options = Taxonomy::get_taxonomy_filter_options(
				'category',
				$tax_params
			);

			// phpcs:ignore
			$cur_tag = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::PARTNER_ARCHIVE_FILTER_TAG] ?? ''));
			$tag_options = Taxonomy::get_taxonomy_filter_options(
				'post_tag',
				$tax_params
			);

			// phpcs:ignore
			$cur_search = sanitize_text_field(wp_unslash($_GET['filter_search'] ?? ''));

			Component::render(Components\UI\InputWithIcon::class, [
				'is_form' => true,
				'add_container_attrs' => [
					'id' => 'form_filter_search'
				],
				'add_container_classes' => [
					'banner-resource-archive__filter-control'
				],
				'add_input_attrs' => [
					'id' => 'search',
					'name' => 'search',
					'placeholder' => __('Search', Constants\TextDomains::DEFAULT),
					'value' => $cur_search,
					'aria-label' => __('Search text', Constants\TextDomains::DEFAULT)
				],
				'add_icon_container_attrs' => [
					'aria-label' => __('Search', Constants\TextDomains::DEFAULT)
				],
			]);

			echo '<div class="tag-container">';
			echo '<h4 class="tag-container-title">Categories</h4>';
			echo '<div class="tags">';

			// Get the categories
			$link_extended = isset($_GET['tag']) ? '?tag=' . sanitize_text_field(wp_unslash($_GET['tag'] ?? '')) : '';
			echo '<a href="' . get_post_type_archive_link( 'partner' ) . $link_extended . '" class="button">All</a>';

			foreach ($cat_options as $option)
			{
				$term = get_term_by('name', $option->render($cur_tag), 'category');
				$classes = ['button'];

				if (isset($_GET['category']) && $term->slug === sanitize_text_field(wp_unslash($_GET['category'] ?? '')) ) {
					$classes[] = 'active';
				}

				$link_extended = isset($_GET['tag']) ? '&tag=' . sanitize_text_field(wp_unslash($_GET['tag'] ?? '')) : '';

				echo '<a href="' . get_term_link( $term ) . $link_extended . '" class="' . implode(' ', $classes) . '">' . $term->name . '</a>';
			}

			echo '</div>';
			echo '</div>';

			echo '<div class="tag-container">';
			echo '<h4 class="tag-container-title">Tags</h4>';
			echo '<div class="tags">';

			// Get the tags
			$link_extended = isset($_GET['category']) ? '?category=' . sanitize_text_field(wp_unslash($_GET['category'] ?? '')) : '';
			echo '<a href="' . get_post_type_archive_link( 'partner' ) . $link_extended . '" class="button">All</a>';

			foreach ($tag_options as $option)
			{
				$term = get_term_by('name', $option->render($cur_tag), 'post_tag');
				$classes = ['button'];

				if (isset($_GET['tag']) && $term->slug === sanitize_text_field(wp_unslash($_GET['tag'] ?? '')) ) {
					$classes[] = 'active';
				}

				$link_extended = isset($_GET['category']) ? '&category=' . sanitize_text_field(wp_unslash($_GET['category'] ?? '')) : '';

				echo '<a href="' . get_term_link( $term ) . $link_extended . '" class="' . implode(' ', $classes) . '">' . $term->name . '</a>';
			}

			echo '</div>';
			echo '</div>';

			?>
		</aside>
	</div>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::PARTNER_SETTINGS_BASE . '_partner_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
