<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Util };
use Blueprint\Images;

class CardIntegration implements IComponent
{
	/**
	 * The integration card image
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $image = null;

	/**
	 * The integration card image size
	 *
	 * @var boolean
	 */
	public $is_full = false;

	/**
	 * The integration card title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The integration card content
	 *
	 * @var string
	 */
	public string $content = '';

	/**
	 * The integration card permalink
	 *
	 * @var string
	 */
	public string $permalink = '';


	public function __construct(array $params)
	{
		$this->image = $params['image'] ?? null;
		$this->is_full = Arrays::get_value_as_bool($params, 'is_full');
		$this->title = Arrays::get_value_as_string($params, 'title');
		$this->content = Arrays::get_value_as_string($params, 'content');
		$this->permalink = Arrays::get_value_as_string($params, 'permalink');
	}

	public function render(): void
	{
		$tag = $this->permalink ? 'a' : 'div';
		$attrs = [
			'class' => 'card-integration bg-white'
		];

		if($this->is_full) {
			$attrs['class']= 'card-integration bg-white is-full';
		}

		if ($this->permalink) {
			$attrs['href'] = esc_url($this->permalink);
		}

		?>
		<<?php echo esc_attr($tag); ?> <?php echo Util::attributes_array_to_string($attrs); // phpcs:ignore ?>>
			<?php
			if ($this->image)
			{
				?>
				<div class="card-integration__image-container">
					<?php Images::safe_image_output($this->image, ['class' => 'card-integration__image','data-ib-no-cache' => 1]); ?>
				</div>
				<?php
			}
			?>
			<div class="card-integration__content-container">
				<h5 class="card-integration__title"><?php echo $this->title; ?></h5>
				<?php echo wp_kses_post(wpautop($this->content)); ?>
			</div>
			</<?php echo esc_attr($tag); ?>>
		<?php
	}
}
