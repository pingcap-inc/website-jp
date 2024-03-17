<?php
namespace PingCAP\Components\Archive;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use PingCAP\Constants;

class LoadMore implements IComponent
{
	/**
	 * The WP_Query object
	 *
	 * @var WP_Query|null
	 */
	public $wp_query_obj = null;

	/**
	 * The current archive page number
	 *
	 * @var int
	 */
	public int $paged = 1;

	/**
	 * The button text
	 *
	 * @var string
	 */
	public string $button_text = 'Load More';

	/**
	 * The maximum archive page value
	 *
	 * @var int
	 */
	public int $max_page = 1;

	/**
	 * The next archive page value
	 *
	 * @var int
	 */
	public int $next_page = 2;


	public function __construct(array $params)
	{
		$this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_object'], 'WP_Query') ? $params['wp_query_object'] : null;
		$this->paged = Arrays::get_value_as_int($params, 'paged', function () {
			global $paged;

			return $paged ? intval($paged) : 1;
		});
		$this->button_text = Arrays::get_value_as_string($params, 'button_text', __('Load More', Constants\TextDomains::DEFAULT));

		if (!$this->wp_query_obj) {
			global $wp_query;

			$this->wp_query_obj = $wp_query;
		}

		if ($this->wp_query_obj) {
			$this->max_page = $this->wp_query_obj->max_num_pages;
		}

		$this->next_page = $this->paged + 1;
	}

	public function render(): void
	{
		$container_classes = [
			'archive__load-more-container',
			'contain'
		];

		if (is_single() || $this->next_page > $this->max_page) {
			$container_classes[] = 'hide';
		}

		?>
		<div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
			<button type="button" class="button js__load-more"><?php echo esc_html($this->button_text); ?></button>
		</div>
		<?php
	}
}
