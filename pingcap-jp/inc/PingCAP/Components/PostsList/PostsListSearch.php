<?php
namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Component, Taxonomy };
use WPUtil\Vendor\ACF;
use PingCAP\{ Components, Constants, CPT };

class PostsListSearch implements IComponent
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


	public function __construct(array $params)
	{
		$this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_obj'], 'WP_Query') ? $params['wp_query_obj'] : null;
		$this->block_display = Arrays::get_value_as_bool($params, 'block_display');
		$this->current_page = Arrays::get_value_as_int($params, 'current_page', 1);
		$this->no_results_message = Arrays::get_value_as_string($params, 'no_results_message', function () {
			return ACF::get_field_string(
				Constants\ACF::THEME_OPTIONS_SEARCH_BASE . '_no_results_message',
				'option',
				[
					'default' => Constants\DefaultValues::SEARCH_NO_RESULTS_MESSAGE
				]
			);
		});
	}

	public function render(): void
	{
		Component::render(Components\PostsList\PostsList::class, [
			'wp_query_obj' => $this->wp_query_obj,
			'card_component' => Components\Cards\CardSearch::class,
			'block_display' => $this->block_display,
			'add_container_classes' => ['posts-list-search', 'layout__padded-columns', 'layout__padded-columns--double'],
			'current_page' => $this->current_page,
			'no_results_message' => $this->no_results_message,
			'filter_render_functions' => [
				// search
				function () {
					// phpcs:disable WordPress.Security.NonceVerification.Recommended
					$cur_search = sanitize_text_field(wp_unslash($_GET['s'] ?? ''));

					?>
					<label for="filter_search"><?php esc_html_e('Search', Constants\TextDomains::DEFAULT); ?></label>
					<?php
					Component::render(Components\UI\InputWithIcon::class, [
						'is_form' => true,
						'add_container_attrs' => [
							'id' => 'form_filter_search'
						],
						'add_container_classes' => [
							'posts-list__filter-search'
						],
						'add_input_attrs' => [
							'id' => 'filter_search',
							'name' => 'filter_search',
							'placeholder' => __('Search', Constants\TextDomains::DEFAULT),
							'value' => $cur_search
						],
						'add_icon_container_attrs' => [
							'aria-label' => __('Search', Constants\TextDomains::DEFAULT)
						],
					]);
				}
			]
		]);
	}
}
