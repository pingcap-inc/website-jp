<?php

namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Util};
use PingCAP\Components;

class PostsList implements IComponent
{
	/**
	 * The WP_Query object
	 *
	 * @var WP_Query|null
	 */
	public $wp_query_obj = null;

	/**
	 * The card component. This can referencing either a component file or a the
	 * name of a class component that extends IComponent.
	 *
	 * @var string
	 */
	public string $card_component = '';

	/**
	 * Flag indicating that the posts list will be displayed in a block. Adds the
	 * "posts-list--block" class to the container element.
	 *
	 * @var bool
	 */
	public bool $block_display = false;

	/**
	 * Array of featured post ids
	 *
	 * @var int
	 */
	public int $featured_id = 0;

	/**
	 * Flag indicating that the featured row will be hidden. The markup will still
	 * be generated as long as the featured id is valid, but a "hide" class will
	 * be applied.
	 *
	 * @var boolean
	 */
	public bool $hide_featured = false;

	/**
	 * Array of class strings that will be added to the container element
	 *
	 * @var array<string>
	 */
	public array $add_container_classes = [];

	/**
	 * Array of attributes in key/value format that should be added to the default
	 * card container attributes
	 *
	 * @var array
	 */
	public array $add_card_container_attrs = [];

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
	 * Callback function that can be used to render content prior to any featured
	 * or card content
	 *
	 * @var callable|null
	 */
	public $pre_content_render_callback = null;

	/**
	 * Callback function used to modify the featured post card parameters
	 *
	 * @var callable|null
	 */
	public $featured_render_params_callback = null;

	/**
	 * Callback function used to modify the post card parameters
	 *
	 * @var callable|null
	 */
	public $card_render_params_callback = null;

	/**
	 * Callback function that is run prior to the output of each card column
	 *
	 * @var callable|null
	 */
	public $pre_card_column_callback = null;

	/**
	 * Callback function that is run before the default cards have been rendered
	 * and allows for rendering additional cards within the container
	 *
	 * @var callable|null
	 */
	public $pre_render_cards_callback = null;

	/**
	 * Callback function that is run after the default cards have been rendered
	 * and allows for rendering additional cards within the container
	 *
	 * @var callable|null
	 */
	public $post_render_cards_callback = null;

	/**
	 * Array of callable functions that are used to build the filter sections
	 *
	 * @var array<callable>
	 */
	public $filter_render_functions = [];


	public function __construct(array $params)
	{
		$this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_obj'], 'WP_Query') ? $params['wp_query_obj'] : null;
		$this->card_component = Arrays::get_value_as_string($params, 'card_component');
		$this->block_display = Arrays::get_value_as_bool($params, 'block_display');
		$this->featured_id = Arrays::get_value_as_int($params, 'featured_id');
		$this->hide_featured = Arrays::get_value_as_bool($params, 'hide_featured');
		$this->add_container_classes = Arrays::get_value_as_array($params, 'add_container_classes');
		$this->add_card_container_attrs = Arrays::get_value_as_array($params, 'add_card_container_attrs');
		$this->post_type = Arrays::get_value_as_int($params, 'post_type', 1);
		$this->current_page = Arrays::get_value_as_int($params, 'current_page', 1);
		$this->no_results_message = Arrays::get_value_as_string($params, 'no_results_message');

		$this->pre_content_render_callback = isset($params['pre_content_render_callback']) && is_callable($params['pre_content_render_callback']) ?
			$params['pre_content_render_callback'] :
			null;

		$this->featured_render_params_callback = isset($params['featured_render_params_callback']) && is_callable($params['featured_render_params_callback']) ?
			$params['featured_render_params_callback'] :
			null;

		$this->card_render_params_callback = isset($params['card_render_params_callback']) && is_callable($params['card_render_params_callback']) ?
			$params['card_render_params_callback'] :
			null;

		$this->pre_card_column_callback = isset($params['pre_card_column_callback']) && is_callable($params['pre_card_column_callback']) ?
			$params['pre_card_column_callback'] :
			null;

		$this->pre_render_cards_callback = isset($params['pre_render_cards_callback']) && is_callable($params['pre_render_cards_callback']) ?
			$params['pre_render_cards_callback'] :
			null;

		$this->post_render_cards_callback = isset($params['post_render_cards_callback']) && is_callable($params['post_render_cards_callback']) ?
			$params['post_render_cards_callback'] :
			null;

		$this->filter_render_functions = Arrays::get_value_as_array($params, 'filter_render_functions');
	}

	public function render(): void
	{
		if (!$this->wp_query_obj || !$this->card_component) {
			return;
		}

		$container_classes = array_merge(['posts-list'], $this->add_container_classes);

		if ($this->block_display) {
			$container_classes[] = 'posts-list--block';
		}

?>
		<div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
			<?php
			if ($this->pre_content_render_callback && is_callable($this->pre_content_render_callback)) {
				$func = $this->pre_content_render_callback;
				$func();
			}

			if ($this->featured_id) {
				$row_classses = ['posts-list__row-featured', 'contain'];

			?>
				<div class="<?php echo esc_attr(implode(' ', $row_classses)); ?>">
					<?php
					$params = [
						'post_id' => $this->featured_id,
						'is_featured' => true,
						'post_type' => $this->post_type
					];

					if (is_callable($this->featured_render_params_callback)) {
						$func = $this->featured_render_params_callback;
						$params = $func($params, $this->featured_id);
					}

					Component::render($this->card_component, $params);
					?>
				</div>
			<?php
			}

			if ($this->filter_render_functions) {
			?>
				<div class="posts-list__row-filters contain">
					<?php
					foreach ($this->filter_render_functions as $filter_render_func) {
					?>
						<div class="posts-list__filter">
							<?php
							if (is_callable($filter_render_func)) {
								$filter_render_func();
							}
							?>
						</div>
					<?php
					}
					?>
				</div>
			<?php
			}

			$total_pages = intval($this->wp_query_obj->max_num_pages ?? 1);
			$posts_per_page = intval($this->wp_query_obj->query_vars['posts_per_page'] ?? get_option('posts_per_page'));

			$no_results_classes = [
				'posts-list__no-results-container',
				'layout__padded-columns',
				'text-center'
			];

			if ($this->wp_query_obj->posts) {
				$no_results_classes[] = 'hide';
			}

			?>
			<div class="posts-list__cards-container contain" data-load-more-target data-current-page="<?php echo esc_attr($this->current_page); ?>" data-total-pages="<?php echo esc_attr($total_pages); ?>" data-posts-per-page="<?php echo esc_attr($posts_per_page); ?>" <?php if ($this->add_card_container_attrs) {
																																																																				echo Util::attributes_array_to_string($this->add_card_container_attrs);
																																																																			} // phpcs:ignore 
																																																																			?>>
				<?php
				if (is_callable($this->pre_render_cards_callback)) {
					$func = $this->pre_render_cards_callback;
					$func();
				}

				foreach ($this->wp_query_obj->posts as $cur_index => $cur_post) {
					if (is_callable($this->pre_card_column_callback)) {
						$func = $this->pre_card_column_callback;
						$func($cur_index, $cur_post->ID);
					}

					$params = [
						'post_id' => $cur_post->ID
					];

					if (is_callable($this->card_render_params_callback)) {
						$func = $this->card_render_params_callback;
						$params = $func($params, $cur_post->ID);
					}

					Component::render($this->card_component, $params);
				}

				if (is_callable($this->post_render_cards_callback)) {
					$func = $this->post_render_cards_callback;
					$func();
				}
				?>
			</div>
			<div class="<?php echo esc_attr(implode(' ', $no_results_classes)); ?>" data-no-results-container>
				<h4><?php echo esc_html($this->no_results_message); ?></h4>
			</div>
			<div class="posts-list__loader-container hide">
				<span class="posts-list__loader-spinner"></span>
			</div>
			<?php Component::render(Components\Archive\LoadMore::class); ?>
		</div>
<?php
	}
}
