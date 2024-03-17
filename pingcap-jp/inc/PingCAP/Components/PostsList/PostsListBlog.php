<?php

namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Content};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants};

// phpcs:disable WordPress.Security.NonceVerification.Recommended

class PostsListBlog implements IComponent
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
	 * The featured post ID
	 *
	 * @var integer
	 */
	public int $featured_id = 0;

	/**
	 * The WordPress REST API endpoint to add as the "data-endpoint" attribute
	 * on the cards container
	 *
	 * @var string
	 */
	public string $api_endpoint = 'wp/v2/posts';

	/**
	 * The Algolia index to add as the "data-index-name" attribute
	 * on the cards container
	 *
	 * @var string
	 */
	public string $index_name = '';

	/**
	 * The card component class name
	 *
	 * @var string
	 */
	public string $card_component = Components\Cards\CardResource::class;


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
		$this->featured_id = Arrays::get_value_as_int($params, 'featured_id');
		$this->api_endpoint = Arrays::get_value_as_string($params, 'api_endpoint', 'wp/v2/posts');
		$this->index_name = Arrays::get_value_as_string($params, 'index_name');
		$this->card_component = Arrays::get_value_as_string($params, 'card_component', Components\Cards\CardResource::class);
		$this->filter_render_functions = Arrays::get_value_as_array($params, 'filter_render_functions');
	}

	public function render(): void
	{
		Component::render(Components\PostsList\PostsList::class, [
			'wp_query_obj' => $this->wp_query_obj,
			'card_component' => $this->card_component,
			'block_display' => $this->block_display,
			'featured_id' => $this->featured_id,
			'add_container_classes' => [$this->index_name ? 'posts-list-blog-algolia' : 'posts-list-blog'],
			'add_card_container_attrs' => ['data-endpoint' => $this->api_endpoint, 'data-index-name' => $this->index_name],
			'current_page' => $this->current_page,
			'no_results_message' => $this->no_results_message,
			'filter_render_functions' => $this->filter_render_functions

		]);
	}
}
