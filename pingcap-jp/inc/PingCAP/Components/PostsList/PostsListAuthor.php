<?php
namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Component, Content, Taxonomy };
use WPUtil\Vendor\ACF;
use PingCAP\{ Components, Constants, CPT };

// phpcs:disable WordPress.Security.NonceVerification.Recommended

class PostsListAuthor implements IComponent
{
	/**
	 * The WP_Query object
	 *
	 * @var WP_Query|null
	 */
	public $wp_query_obj = null;

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
	 * The author id
	 *
	 * @var integer
	 */
	public int $author_id = 0;


	public function __construct(array $params)
	{
		$this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_obj'], 'WP_Query') ? $params['wp_query_obj'] : null;
		$this->current_page = Arrays::get_value_as_int($params, 'current_page', 1);
		$this->no_results_message = Arrays::get_value_as_string($params, 'no_results_message', function () {
			return ACF::get_field_string(
				Constants\ACF::THEME_OPTIONS_AUTHOR_ARCHIVES_BASE . '_no_results_message',
				'option',
				[
					'default' => Constants\DefaultValues::AUTHOR_ARCHIVE_NO_RESULTS_MESSAGE
				]
			);
		});
		$this->author_id = Arrays::get_value_as_int($params, 'author_id', fn () => intval(get_query_var('custom_author_id')));
	}

	public function render(): void
	{
		$author_id = $this->author_id;

		Component::render(Components\PostsList\PostsList::class, [
			'wp_query_obj' => $this->wp_query_obj,
			'card_component' => Components\Cards\CardResource::class,
			'block_display' => false,
			'add_container_classes' => ['posts-list-author'],
			'add_card_container_attrs' => ['data-author-id' => $this->author_id],
			'current_page' => $this->current_page,
			'no_results_message' => $this->no_results_message,
			'pre_content_render_callback' => function () use ($author_id) {
				?>
				<h4 class="posts-list-author__posts-from-title top-line contain">Posts from <?php echo get_the_author_meta('display_name', $author_id); ?></h4>
				<?php
			}
		]);
	}
}
