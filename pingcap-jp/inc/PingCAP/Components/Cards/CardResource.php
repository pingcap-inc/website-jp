<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Util};
use Blueprint\Images;
use PingCAP\{Constants, CPT};
use WPUtil\Vendor\ACF;

class CardResource implements IComponent
{
	/**
	 * The post id
	 *
	 * @var integer
	 */
	public int $post_id = 0;

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
		$this->category = Arrays::get_value_as_string($params, 'category');
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
		$this->content = Arrays::get_value_as_string($params, 'content');
		$this->permalink = Arrays::get_value_as_string($params, 'permalink', fn () => get_the_permalink($this->post_id));
		$this->image = $params['image'] ?? get_post_thumbnail_id($this->post_id);
		$this->is_featured = Arrays::get_value_as_bool($params, 'is_featured', false);
		$this->add_container_classes = Arrays::get_value_as_array($params, 'add_container_classes');
		$this->add_container_attrs = Arrays::get_value_as_array($params, 'add_container_attrs');

		if (!$this->category) {
			switch (get_post_type($this->post_id)) {
				case Constants\CPT::BLOG:
					$this->category = CPT\Blog::getPostCategoryText($this->post_id);
					break;

				case Constants\CPT::TRAINING:
					$this->category = CPT\Training::getPostCategoryText($this->post_id);
					break;

				case Constants\CPT::EVENT:
					$this->category = CPT\Event::getPostCategoryText($this->post_id);
					break;

				case Constants\CPT::PARTNER:
					$this->category = CPT\Partner::getPostCategoryText($this->post_id);
					break;

				case Constants\CPT::PRESS_RELEASE:
					$this->category = CPT\PressRelease::getPostCategoryText($this->post_id);
					break;

				case Constants\CPT::NEWS:
					$this->category = CPT\News::getPostCategoryText($this->post_id);
					break;

				case Constants\CPT::EBOOK_WHITEPAPER:
					$this->category = CPT\EbookWhitePaper::getPostCategoryText($this->post_id);
					break;

				default:
					break;
			}
		}

		if (!$this->image) {
			if (isset($params['default_image'])) {
				$this->image = $params['default_image'];
			} else {
				switch (get_post_type($this->post_id)) {
					case Constants\CPT::BLOG:
						$this->image = CPT\Blog::getDefaultCardImage();
						break;

					case Constants\CPT::TRAINING:
						$this->image = CPT\Training::getDefaultCardImage();
						break;

					case Constants\CPT::EVENT:
						$this->image = CPT\Event::getDefaultCardImage();
						break;

					case Constants\CPT::PARTNER:
						$this->image = CPT\Partner::getDefaultCardImage();
						break;

					case Constants\CPT::PRESS_RELEASE:
						$this->image = CPT\PressRelease::getDefaultCardImage();
						break;

					case Constants\CPT::NEWS:
						$this->image = CPT\News::getDefaultCardImage();
						break;

					default:
						break;
				}
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
			if (get_post_type($this->post_id) === Constants\CPT::BLOG) {
				$container_classes[] = 'post';
			}
		}

		$container_attrs = array_merge([
			'class' => esc_attr(implode(' ', $container_classes)),
			'href' => esc_url($this->permalink)
		], $this->add_container_attrs);

?>
		<a <?php echo Util::attributes_array_to_string($container_attrs); ?>>
			<?php
			$image_params = [
				'class' => 'card-resource__image'
			];
			if ($this->image) {
			?>
				<div class="card-resource__image-container">
					<?php Images::safe_image_output($this->image, $image_params); ?>
				</div>
			<?php
			}
			?>
			<div class="card-resource__content-container">
				<?php
				if ($this->category) {
				?>
					<div class="card-resource__content-head">
						<div class="card-resource__category"><?php echo esc_html($this->category); ?></div>
						<?php if (get_post_type($this->post_id) === Constants\CPT::BLOG) { ?>
							<div class="card-resource__date"><?php echo get_the_date('F j, Y', $this->post_id); ?></div>
						<?php } ?>
					</div>
				<?php
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
