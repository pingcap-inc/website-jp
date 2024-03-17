<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Util };
use Blueprint\Images;

class CardProduct implements IComponent
{
	/**
	 * The product icon image
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $icon_image = null;

	/**
	 * The product title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The product description
	 *
	 * @var string
	 */
	public string $description = '';

	/**
	 * The product permalink
	 *
	 * @var string
	 */
	public string $permalink = '';


	public function __construct(array $params)
	{
		$this->icon_image = $params['icon_image'] ?? null;
		$this->title = Arrays::get_value_as_string($params, 'title');
		$this->description = Arrays::get_value_as_string($params, 'description');
		$this->permalink = Arrays::get_value_as_string($params, 'permalink');
	}

	public function render(): void
	{
		$container_tag = $this->permalink ? 'a' : 'div';
		$container_attrs = [
			'class' => 'card-product bg-white'
		];

		if ($this->permalink) {
			$container_attrs['href'] = esc_url($this->permalink);
		}

		?>
		<<?php echo esc_attr($container_tag); ?> <?php echo Util::attributes_array_to_string($container_attrs); // phpcs:ignore ?>>
			<?php
			if ($this->icon_image)
			{
				Images::safe_image_output($this->icon_image, ['class' => 'card-product__icon-image']);
			}
			?>
			<span class="card-product__title"><?php echo esc_html($this->title); ?></span>
			<?php
			if ($this->description)
			{
				?>
				<div class="card-product__description">
					<?php echo wp_kses_post($this->description); ?>
				</div>
				<?php
			}
			?>
		</<?php echo esc_attr($container_tag); ?>>
		<?php
	}
}
