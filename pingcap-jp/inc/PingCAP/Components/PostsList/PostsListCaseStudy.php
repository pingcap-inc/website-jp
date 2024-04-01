<?php

namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Taxonomy};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants, CPT};

// phpcs:disable WordPress.Security.NonceVerification.Recommended

class PostsListCaseStudy implements IComponent
{
	/**
	 * The WP_Query object
	 *
	 * @var WP_Query|null
	 */
	public $wp_query_obj = null;

	/**
	 * Flag indicating that the posts list will be displayed in a block. Adds the
	 * "posts-list--block" class to the container element.
	 *
	 * @var bool
	 */
	public bool $block_display = false;

	/**
	 * The current results page number
	 *
	 * @var int
	 */
	public int $current_page = 1;

	/**
	 * The message shown when there are no results to display
	 *
	 * @var string
	 */
	public string $no_results_message = '';

	/**
	 * An array of WP_Term objects representing "orphaned" customer terms
	 * that aren't used by any case study posts
	 *
	 * @var array<\WP_Term>
	 */
	public array $orphaned_customer_terms = [];


	public function __construct(array $params)
	{
		$this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_obj'], 'WP_Query') ? $params['wp_query_obj'] : null;
		$this->block_display = Arrays::get_value_as_bool($params, 'block_display');
		$this->current_page = Arrays::get_value_as_int($params, 'current_page', 1);
		$this->no_results_message = Arrays::get_value_as_string($params, 'no_results_message', function () {
			return ACF::get_field_string(
				Constants\ACF::BLOG_SETTINGS_BASE . '_no_results_message',
				'option',
				[
					'default' => Constants\DefaultValues::ARCHIVE_NO_RESULTS_MESSAGE
				]
			);
		});
		$this->orphaned_customer_terms = Arrays::get_value_as_array($params, 'orphaned_customer_terms');
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

	public function render(): void
	{
?>
		<div class="posts-list-case-study__overflow-container">
			<?php
			Component::render(Components\PostsList\PostsList::class, [
				'wp_query_obj' => $this->wp_query_obj,
				'card_component' => Components\Cards\CardCaseStudy::class,
				'block_display' => $this->block_display,
				'add_container_classes' => ['posts-list-case-study'],
				'add_card_container_attrs' => ['data-endpoint' => 'wp/v2/case-study'],
				'current_page' => $this->current_page,
				'no_results_message' => $this->no_results_message,
				'pre_content_render_callback' => function () {
					$featured_ids = CPT\CaseStudy::getFeaturedIds();

					$autoplay_enabled = ACF::get_field_int(
						Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_featured_posts_autoplay_enabled',
						'option',
						[ 'default' => 1 ]
					);

					$autoplay_speed = ACF::get_field_int(
						Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_featured_posts_autoplay_speed',
						'option',
						['default' => 4000]
					);

					$post_ids = $this->getValidPostIds();
					$tax_params = $post_ids ? ['object_ids' => $post_ids] : [];
			
					$cur_industry = CPT\CaseStudy::getIndustryQueryParamValue();
					$industry_options = Taxonomy::get_taxonomy_filter_options(
						Constants\Taxonomies::INDUSTRY,
						$tax_params
					);
			
					$cur_search = CPT\CaseStudy::getSearchQueryParamValue();

					if ($featured_ids) {
			?>
					<div class="posts-list-case-study__featured-container bg-blue">
						<div class="posts-list-case-study__featured-slides contain embla-instance" data-transition-speed="10" data-autoplay-enabled="<?php echo esc_attr($autoplay_enabled); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>">
							<div class="embla">
								<div class="embla__container">
									<?php
									foreach ($featured_ids as $id) {
									?>
										<div class="embla__slide">
											<?php
											Component::render(Components\CaseStudyFeatured::class, [
												'post_id' => $id,
												'is_featured' => true
											]);
											?>
										</div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<div class="posts-list-case-study__featured-nav contain">
							<div class="embla__pagination"></div>
						</div>
					</div>

					<div class="posts-list-case-study__filters-container contain">
						<div class="banner-case-study-archive__filters">
							<select class="banner-case-study-archive__filter-control" name="filter_industry" id="filter_industry" aria-label="<?php esc_attr_e('Industry', Constants\TextDomains::DEFAULT); ?>">
								<option value=""><?php esc_html_e('業種でフィルタ', Constants\TextDomains::DEFAULT); ?></option>
								<?php
								foreach ($industry_options as $option) {
									echo $option->render($cur_industry); // phpcs:ignore
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
									'placeholder' => __('検索', Constants\TextDomains::DEFAULT),
									'value' => $cur_search,
									'aria-label' => __('検索', Constants\TextDomains::DEFAULT)
								],
								'add_icon_container_attrs' => [
									'aria-label' => __('検索', Constants\TextDomains::DEFAULT)
								],
							]);
							?>
						</div>
					</div>
			<?php
					}
				},
				'post_render_cards_callback' => function () {
					if ($this->orphaned_customer_terms) {
						foreach ($this->orphaned_customer_terms as $customer_term) {
							Component::render(Components\Cards\CardCustomer::class, [
								'customer_term_id' => $customer_term->term_id,
								'customer_name' => $customer_term->name,
								'customer_description' => $customer_term->description ?? ''
							]);
						}
					}
				}
			]);
			?>
		</div>
<?php
	}
}
