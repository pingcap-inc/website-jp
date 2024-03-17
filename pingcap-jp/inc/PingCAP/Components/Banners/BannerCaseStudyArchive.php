<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Taxonomy};
use PingCAP\{Components, Constants, CPT};
use PingCAP\Models\BreadcrumbLink;

class BannerCaseStudyArchive implements IComponent
{
	/**
	 * The banner title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The banner heading text
	 *
	 * @var string
	 */
	public string $heading_text = '';

	/**
	 * The banner has filters
	 *
	 * @var bool
	 */
	public bool $has_filters = false;


	public function __construct(array $params)
	{
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => CPT\CaseStudy::getArchiveTitle());
		$this->heading_text = Arrays::get_value_as_string($params, 'heading_text', fn () => CPT\CaseStudy::getArchiveHeadingText());
		$this->has_filters = Arrays::get_value_as_bool($params, 'has_filters');
	}

	protected function getValidPostIds(): array
	{
		$post_ids = get_posts([
			'fields' => 'ids',
			'post_type' => Constants\CPT::CASE_STUDY,
			'post_status' => 'publish',
			'posts_per_page' => -1
		]);

		return $post_ids;
	}

	protected function getBreadcrumbLinks(): array
	{
		$links = [];

		$archive_link = get_post_type_archive_link(Constants\CPT::CASE_STUDY);

		if ($archive_link) {
			$links[] = new BreadcrumbLink($this->title, $archive_link);
		}

		return $links;
	}

	public function render(): void
	{
		$post_ids = $this->getValidPostIds();
		$tax_params = $post_ids ? ['object_ids' => $post_ids] : [];

		$cur_industry = CPT\CaseStudy::getIndustryQueryParamValue();
		$industry_options = Taxonomy::get_taxonomy_filter_options(
			Constants\Taxonomies::INDUSTRY,
			$tax_params
		);

		$cur_tag = CPT\CaseStudy::getTagQueryParamValue();
		$tag_options = Taxonomy::get_taxonomy_filter_options(
			Constants\Taxonomies::BLOG_TAG,
			$tax_params
		);

		$cur_search = CPT\CaseStudy::getSearchQueryParamValue();

?>
		<div class="banner banner-case-study-archive banner--bottom-arc banner--bottom-arc-white bg-white">
			<div class="banner-case-study-archive__inner contain">
				<div class="banner-case-study-archive__row-filters">
					<h1 class="banner-case-study-archive__title"><?php echo esc_html($this->title); ?></h1>
					<?php if ($this->has_filters) { ?>
						<div class="banner-case-study-archive__filters">
							<select class="banner-case-study-archive__filter-control" name="filter_industry" id="filter_industry" aria-label="<?php esc_attr_e('Industry', Constants\TextDomains::DEFAULT); ?>">
								<option value=""><?php esc_html_e('Filter by Industry', Constants\TextDomains::DEFAULT); ?></option>
								<?php
								foreach ($industry_options as $option) {
									echo $option->render($cur_industry); // phpcs:ignore
								}
								?>
							</select>
							<select class="banner-case-study-archive__filter-control" name="filter_tag" id="filter_tag" aria-label="<?php esc_attr_e('Tag', Constants\TextDomains::DEFAULT); ?>">
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
									'banner-case-study-archive__filter-control'
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
					<?php } ?>
				</div>
				<?php
				if ($this->heading_text) {
				?>
					<h2 class="banner-case-study-archive__heading-text"><?php echo esc_html($this->heading_text); ?></h2>
				<?php
				}
				?>
			</div>
		</div>
<?php
	}
}
