<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;

class CardSearch implements IComponent
{
	/**
	 * The post id
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * The post title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The card content text
	 *
	 * @var string
	 */
	public string $content = '';

	/**
	 * The post permalink
	 *
	 * @var string
	 */
	public string $permalink = '';


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
		$this->content = Arrays::get_value_as_string($params, 'content', fn () => get_the_excerpt($this->post_id));
		$this->permalink = Arrays::get_value_as_string($params, 'permalink', fn () => get_the_permalink($this->post_id));
	}

	public function render(): void
	{
		?>
		<a class="card-search" href="<?php echo esc_url($this->permalink); ?>">
			<h3 class="card-search__title"><?php echo esc_html($this->title); ?></h3>
			<?php
			if ($this->content)
			{
				?>
				<div class="card-search__content">
					<?php
					// phpcs:ignore
					echo $this->content;
					?>
				</div>
				<?php
			}
			?>
		</a>
		<?php
	}
}
