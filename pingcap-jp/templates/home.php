<?php

use PingCAP\{Components, Constants, CPT};
use WPUtil\{Component, Vendor, Taxonomy};
use WPUtil\Vendor\ACF;

get_header();

Component::render(Components\Banners\BannerResourceArchive::class, [
	'post_type' => Constants\CPT::BLOG,
	'display_filters' => false,
	'banner_bg_color' => 'bg-white'
]);

?>
<main class="tmpl-archive tmpl-archive-blog">
	<div class="tmpl-archive-blog__bg bg-blue blog"></div>
	<div class="tmpl-archive-outer-posts-container">
		<div class="tmpl-archive-posts-container">
			<?php
			global $wp_query;

			Component::render(Components\PostsList\PostsListBlog::class, [
				'wp_query_obj' => $wp_query,
				'featured_id' => CPT\Blog::getFeaturedId(),
				'api_endpoint' => 'wp/v2/search',
				'index_name' => 'wp_posts_post'
			]);
			?>
		</div>

		<aside class="tmpl-archive-sidebar">
			<?php
			$post_ids = get_posts([
				'fields' => 'ids',
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => -1
			]);
			$tax_params = $post_ids ? ['object_ids' => $post_ids] : [];

			// phpcs:ignore
			$cur_category = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::BLOG_ARCHIVE_FILTER_CATEGORY] ?? ''));
			$cat_options = Taxonomy::get_taxonomy_filter_options(
				Constants\Taxonomies::BLOG_CATEGORY,
				$tax_params
			);

			// phpcs:ignore
			$cur_tag = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::BLOG_ARCHIVE_FILTER_TAG] ?? ''));
			$tag_options = Taxonomy::get_taxonomy_filter_options(
				Constants\Taxonomies::BLOG_TAG,
				$tax_params
			);

			// phpcs:ignore
			$cur_search = sanitize_text_field(wp_unslash($_GET['filter_search'] ?? ''));

			Component::render(Components\UI\InputWithIcon::class, [
				'is_form' => false,
				'add_container_attrs' => [
					'id' => 'form_filter_search'
				],
				'add_container_classes' => [
					'banner-resource-archive__filter-control'
				],
				'add_input_attrs' => [
					'id' => 'filter_search',
					'name' => 'filter_search',
					'placeholder' => __('検索', Constants\TextDomains::DEFAULT),
					'value' => $cur_search,
					'aria-label' => __('検索', Constants\TextDomains::DEFAULT)
				],
				'add_icon_container_attrs' => [
					'aria-label' => __('検索', Constants\TextDomains::DEFAULT)
				],
			]);

			echo '<div class="tag-container">';
			echo '<h4 class="tag-container-title">Categories</h4>';
			echo '<div class="tags">';

			// Get the categories
			// $link_extended = isset($_GET['tag']) ? '?tag=' . sanitize_text_field(wp_unslash($_GET['tag'] ?? '')) : '';
			// echo '<a href="' . get_post_type_archive_link('post') . $link_extended . '" class="button">All</a>';

			// foreach ($cat_options as $option) {
			// 	$term = get_term_by('name', $option->render($cur_tag), 'category');
			// 	$classes = ['button'];

			// 	if (isset($_GET['category']) && $term->slug === sanitize_text_field(wp_unslash($_GET['category'] ?? ''))) {
			// 		$classes[] = 'active';
			// 	}

			// 	$link_extended = isset($_GET['tag']) ? '&tag=' . sanitize_text_field(wp_unslash($_GET['tag'] ?? '')) : '';

			// 	echo '<a href="' . get_term_link($term) . $link_extended . '" data-value="' . $term->name . '" class="' . implode(' ', $classes) . '">' . $term->name . '</a>';
			// }

			echo '</div>';
			echo '</div>';

			// Get the tags
			echo '<div class="brand hide"></div>'; 

			// Get the region
			echo '<div class="region hide"></div>'; 

			// Get the recommend
			$recommended_list = ACF::get_field_array(Constants\ACF::BLOG_SETTINGS_BASE . '_blog_recommended_posts', 'option');
			if ($recommended_list) {
				echo '<div class="tag-container">';
				echo '<h4 class="tag-container-title">Recommended posts</h4>';
				echo '<div class="tags tags-list">';


				foreach ($recommended_list as $list) {
					$item = $list[Constants\ACF::BLOG_SETTINGS_BASE . '_blog_recommended_posts_item'];

					echo '<a class="tag-item" href="' . get_permalink($item->ID) . '">';
					echo '<div class="tag-item-title">' . $item->post_title . '</div>';
					echo '<div class="tag-item-content">' . get_the_category($item->ID)[0]->name . '&nbsp;&nbsp;' . get_the_time('Y-m-d', $item->ID) . '</div>';
					echo '</a>';
				}

				echo '</div>';
				echo '</div>';
			}

			// Get the most popular posts
			$most_popular_list = ACF::get_field_array(Constants\ACF::BLOG_SETTINGS_BASE . '_blog_most_popular_posts', 'option');
			if ($most_popular_list) {
				echo '<div class="tag-container">';
				echo '<h4 class="tag-container-title">Most popular posts</h4>';
				echo '<div class="tags tags-list">';


				foreach ($most_popular_list as $list) {
					$item = $list[Constants\ACF::BLOG_SETTINGS_BASE . '_blog_most_popular_posts_item'];

					echo '<a class="tag-item" href="' . get_permalink($item->ID) . '">';
					echo '<div class="tag-item-title">' . $item->post_title . '</div>';
					echo '<div class="tag-item-content">' . get_the_category($item->ID)[0]->name . '&nbsp;&nbsp;' . get_the_time('Y-m-d', $item->ID) . '</div>';
					echo '</a>';
				}

				echo '</div>';
				echo '</div>';
			}
			?>
			<br/>
			<a href="https://ask.pingcap.com/" class="button button--secondary">Discuss with the Community</a>
		</aside>
	</div>
</main>
<?php

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::BLOG_SETTINGS_BASE . '_blog_archive_blocks_grav_blocks',
	'object' => 'option'
]);

get_footer();
