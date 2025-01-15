<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Util};
use Blueprint\Images;
use PingCAP\{CPT};
use WPUtil\Vendor\ACF;

class CardEvent implements IComponent
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
	 * The post category
	 *
	 * @var string
	 */
	public string $category = '';

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

	/**
	 * Flag indicating that this is a featured resource post card
	 *
	 * @var boolean
	 */
	public bool $is_featured = false;

	/**
	 * Additional container classnames
	 *
	 * @var array<string>
	 */
	public array $add_container_classes = [];

	/**
	 * Additional container tag attributes
	 *
	 * @var array<string, string>
	 */
	public array $add_container_attrs = [];


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
		$this->date_start = Arrays::get_value_as_string($params, 'date_start', fn () => ACF::get_field_string('date_start', $this->post_id));
		$this->date_end = Arrays::get_value_as_string($params, 'date_end', fn () => ACF::get_field_string('date_end', $this->post_id));
		$this->date_time_zone = Arrays::get_value_as_array($params, 'date_time_zone', fn () => ACF::get_field_array('date_time_zone', $this->post_id));
		$this->location = Arrays::get_value_as_string($params, 'event_location', fn () => CPT\Event::getPostLocationText($this->post_id));
		$this->category = Arrays::get_value_as_string($params, 'category', fn () => CPT\Event::getPostCategoryText($this->post_id));
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
		$this->content = Arrays::get_value_as_string($params, 'content');
		$this->permalink = Arrays::get_value_as_string($params, 'permalink', fn () => get_the_permalink($this->post_id));
		$this->other_link = ACF::get_field_string('url', $this->post_id);
		$this->image = $params['image'] ?? get_post_thumbnail_id($this->post_id);
		$this->is_featured = Arrays::get_value_as_bool($params, 'is_featured', false);
		$this->add_container_classes = Arrays::get_value_as_array($params, 'add_container_classes');
		$this->add_container_attrs = Arrays::get_value_as_array($params, 'add_container_attrs');

		if (!$this->image) {
			if (isset($params['default_image'])) {
				$this->image = $params['default_image'];
			} else {
				$this->image = CPT\Event::getDefaultCardImage();
			}
		}
	}

	public function render(): void
	{
		$container_classes = array_merge(
			['card-resource', 'bg-white'],
			$this->add_container_classes
		);

		if ($this->is_featured) {
			$container_classes[] = 'card-resource--featured';
		}

		$container_attrs = array_merge([
			'class' => esc_attr(implode(' ', $container_classes)),
			'href' => esc_url($this->other_link ? $this->other_link : $this->permalink)
		], $this->add_container_attrs);

?>
		<a <?php echo Util::attributes_array_to_string($container_attrs); ?>>
			<?php
			if ($this->image) {
				$image_params = [
					'class' => 'card-event__image'
				];

				if ($this->is_featured) {
					$image_params['data-ib-no-cache'] = '1';
				}

			?>
				<div class="card-event__image-container">
					<?php Images::safe_image_output($this->image, $image_params); ?>
				</div>
			<?php
			}
			?>
			<div class="card-event__content-container">

				<?php
				if ($this->date_time_zone) {

					$status_label = CPT\Event::getStatusLabel($this->date_start, $this->date_end, $this->date_time_zone['value']);
					if ($status_label) {
						$status_class = strtolower(str_replace(' ', '-', $status_label));
				?>
						<div class="card-resource__content-head">
							<div class="card-resource__status <?php echo $status_class; ?>">
								<?php echo $status_label; ?>
							</div>
						</div>
				<?php
					}
				}
				?>

				<?php if ($this->is_featured) { ?>
					<h3 class="card-resource__title"><?php echo esc_html($this->title); ?></h3>
				<?php
				} else {
				?>
					<h5 class="card-resource__title"><?php echo esc_html($this->title); ?></h5>
				<?php
				}
				?>

				<?php
				$date_label = CPT\Event::formatDateLabel($this->date_start, $this->date_end);

				if ($date_label) {
				?>
					<p class="card-resource__date">
						<i class="icon-calendar-check"></i>
						<?php
						echo $date_label . ' ' . explode(' ', $this->date_time_zone['label'])[0];
						?>
					</p>
				<?php
				}
				?>

				<?php if ($this->location) { ?>
					<p class="card-resource__location">
						<i class="icon-map-pin"></i>
						<?php
						echo $this->location;
						?>
					</p>
				<?php } ?>

				<?php
				if ($this->content) {
				?>
					<div class="card-resource__content">
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
