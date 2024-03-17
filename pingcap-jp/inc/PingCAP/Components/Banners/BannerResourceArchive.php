<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Taxonomy};
use PingCAP\{Components, Constants, CPT, PageLinks};
use PingCAP\Models\BreadcrumbLink;
use Blueprint\Images;

class BannerResourceArchive implements IComponent
{
	/**
	 * The post type to source banner settings from
	 *
	 * @var string
	 */
	public string $post_type = Constants\CPT::BLOG;

	/**
	 * The banner title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * Flag indicating that the filter controls should be displayed
	 *
	 * @var boolean
	 */
	public bool $display_filters = true;


	public function __construct(array $params)
	{
		$this->post_type = Arrays::get_value_as_string($params, 'post_type', Constants\CPT::BLOG);
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => $this->getTitle());
		$this->display_filters = Arrays::get_value_as_bool($params, 'display_filters', true);
		$this->banner_bg_color = Arrays::get_value_as_string($params, 'banner_bg_color', 'bg-black');
		$this->banner_image = Arrays::get_value_as_array($params, 'banner', fn () => $this->getBanner());
	}

	protected function getTitle(): string
	{
		switch ($this->post_type) {
			case Constants\CPT::BLOG:
				return CPT\Blog::getArchiveTitle();

			case Constants\CPT::TRAINING:
				return CPT\Training::getArchiveTitle();

			case Constants\CPT::EVENT:
				return CPT\Event::getArchiveTitle();

			case Constants\CPT::PARTNER:
				return CPT\Partner::getArchiveTitle();

			case Constants\CPT::PRESS_RELEASE:
				return CPT\PressRelease::getArchiveTitle();

			case Constants\CPT::NEWS:
				return CPT\News::getArchiveTitle();

			case Constants\CPT::EBOOK_WHITEPAPER:
				return CPT\EbookWhitePaper::getArchiveTitle();

			case Constants\CPT::VIDEO:
				return CPT\Video::getArchiveTitle();

			default:
				break;
		}

		return '';
	}

	protected function getBanner(): array
	{
		switch ($this->post_type) {
			case Constants\CPT::BLOG:
				return CPT\Blog::getArchiveBanner();
			default:
				break;
		}

		return [];
	}

	protected function getValidPostIds(): array
	{
		$post_ids = get_posts([
			'fields' => 'ids',
			'post_type' => $this->post_type,
			'post_status' => 'publish',
			'posts_per_page' => -1
		]);

		return $post_ids;
	}

	protected function getBreadcrumbLinks(): array
	{
		$archive_post_type = get_queried_object()->name ?? '';

		$links = [];

		switch ($archive_post_type) {
				// if the $archive_post_type value is empty it's indicating the "post" type
			case '':
				$links[] = new BreadcrumbLink(
					CPT\Blog::getArchiveTitle(),
					get_post_type_archive_link(Constants\CPT::BLOG)
				);
				break;

			case Constants\CPT::EVENT:
				$links[] = new BreadcrumbLink(
					CPT\Event::getArchiveTitle(),
					get_post_type_archive_link(Constants\CPT::EVENT)
				);
				break;

			case Constants\CPT::NEWS:
			case Constants\CPT::PRESS_RELEASE:
				break;

			default:
				$resources_page_id = PageLinks::getResourcesPageId();

				if ($resources_page_id) {
					$links[] = new BreadcrumbLink(
						get_the_title($resources_page_id),
						get_the_permalink($resources_page_id)
					);
				}
				break;
		}

		return $links;
	}

	public function render(): void
	{
		$post_ids = $this->getValidPostIds();
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
		$cur_search = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::BLOG_ARCHIVE_FILTER_SEARCH] ?? ''));

		$banner_classes = ['banner', 'banner-resource-archive'];
		if ($this->banner_bg_color) {
			$banner_classes[] = $this->banner_bg_color;
		}
		if ($this->banner_image) {
			$banner_classes[] = 'has-image';
		}

?>
		<div class="<?php echo esc_attr(implode(' ', $banner_classes)); ?>">
			<div class="banner-resource-archive__inner contain">
				<div class="banner-resource-archive__row-filters">
					<h1 class="banner-resource-archive__title"><?php echo esc_html($this->title); ?></h1>
					<?php
					if ($this->display_filters) {
					?>
						<div class="banner-resource-archive__filters">
							<select class="banner-resource-archive__filter-control" name="filter_category" id="filter_category" aria-label="<?php esc_attr_e('Category', Constants\TextDomains::DEFAULT); ?>">
								<option value=""><?php esc_html_e('Filter by Category', Constants\TextDomains::DEFAULT); ?></option>
								<?php
								foreach ($cat_options as $option) {
									echo $option->render($cur_category); // phpcs:ignore
								}
								?>
							</select>
							<select class="banner-resource-archive__filter-control" name="filter_tag" id="filter_tag" aria-label="<?php esc_attr_e('Tag', Constants\TextDomains::DEFAULT); ?>">
								<option value=""><?php esc_html_e('Filter by Tag', Constants\TextDomains::DEFAULT); ?></option>
								<?php
								foreach ($tag_options as $option) {
									echo $option->render($cur_tag); // phpcs:ignore
								}
								?>
							</select>
							<?php
							Component::render(Components\UI\InputWithIcon::class, [
								'is_form' => true,
								'add_container_attrs' => [
									'id' => 'form_filter_search'
								],
								'add_container_classes' => [
									'banner-resource-archive__filter-control'
								],
								'add_input_attrs' => [
									'id' => 'filter_search',
									'name' => 'filter_search',
									'placeholder' => __('Search', Constants\TextDomains::DEFAULT),
									'value' => $cur_search,
									'aria-label' => __('Search text', Constants\TextDomains::DEFAULT)
								],
								'add_icon_container_attrs' => [
									'aria-label' => __('Search', Constants\TextDomains::DEFAULT)
								],
							]);
							?>
						</div>
					<?php
					}
					?>
				</div>
				<?php if ($this->banner_image) {
					Images::safe_image_output($this->banner_image, [
						'class' => 'banner-resource-archive__image',
					]);
				} ?>
			</div>
		</div>
<?php
	}
}
