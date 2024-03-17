<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\Vendor\ACF;
use WPUtil\Arrays;
use Blueprint\Images;
use PingCAP\{ Constants, CPT };

class CardCommunityActivity implements IComponent
{
	/**
	 * The post id
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * The activity start date
	 *
	 * @var string
	 */
	public string $date_start = '';

	/**
	 * The activity end date
	 *
	 * @var string
	 */
	public string $date_end = '';

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

	/**
	 * The post featured image
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $image = null;


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
		$this->date_start = Arrays::get_value_as_string($params, 'date_start', fn () => ACF::get_field_string('date_start', $this->post_id));
		$this->date_end = Arrays::get_value_as_string($params, 'date_end', fn () => ACF::get_field_string('date_end', $this->post_id));
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
		$this->content = Arrays::get_value_as_string($params, 'content', fn () => get_the_excerpt($this->post_id));
		$this->permalink = Arrays::get_value_as_string($params, 'permalink', fn () => get_the_permalink($this->post_id));
		$this->image = $params['image'] ?? get_post_thumbnail_id($this->post_id);

		if (!$this->image) {
			$this->image = $params['default_image'] ?? CPT\CommunityActivity::getDefaultCardImage();
		}
	}

	public function render(): void
	{
		?>
		<a class="card-community-activity bg-white" href="<?php echo esc_url($this->permalink); ?>">
			<?php
			if ($this->image)
			{
				?>
				<div class="card-community-activity__image-container">
					<?php Images::safe_image_output($this->image, ['class' => 'card-community-activity__image']); ?>
				</div>
				<?php
			}
			?>
			<div class="card-community-activity__content-container">
				<?php
				$date_label = CPT\CommunityActivity::formatDateLabel($this->date_start, $this->date_end);

				if ($date_label)
				{
					?>
					<p class="card-community-activity__date"><?php echo esc_html($date_label); ?></p>
					<?php
				}
				?>
				<h5 class="card-community-activity__title"><?php echo esc_html($this->title); ?></h5>
				<?php
				if ($this->content)
				{
					?>
					<div class="card-community-activity__content">
						<?php echo wp_kses_post($this->content); ?>
					</div>
					<?php
				}
				?>
			</div>
		</a>
		<?php
	}
}
