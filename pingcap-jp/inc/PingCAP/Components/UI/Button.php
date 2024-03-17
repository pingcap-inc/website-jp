<?php
namespace PingCAP\Components\UI;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, SVG };

class Button implements IComponent
{
	/**
	 * The button link URL
	 *
	 * @var string
	 */
	public string $link = '';

	/**
	 * The button text
	 *
	 * @var string
	 */
	public string $text = '';

	/**
	 * The button style
	 *
	 * @var string
	 */
	public string $style = '';

	/**
	 * The button gtag
	 *
	 * @var string
	 */
	public string $gtag = '';

	/**
	 * An array of classes for the button
	 *
	 * @var array<string>
	 */
	public array $classes = [];

	/**
	 * An array of additional attributes that will be added to the button tag
	 *
	 * @var array<string, mixed>
	 */
	public array $additional_attrs = [];


	public function __construct(array $params)
	{
		$this->link = Arrays::get_value_as_string($params, 'link');
		$this->text = Arrays::get_value_as_string($params, 'text');
		$this->style = Arrays::get_value_as_string($params, 'style');
		$this->gtag = Arrays::get_value_as_string($params, 'gtag');

		$trigger_video_modal = Arrays::get_value_as_bool($params, 'trigger_video_modal');
		$additional_classes = Arrays::get_value_as_array($params, 'additional_classes');
		$attributes = Arrays::get_value_as_array($params, 'attributes');

		$this->classes = ['button'];

		if ($this->style) {
			$this->classes[] = esc_attr($this->style);
		}

		if ($trigger_video_modal) {
			$this->classes[] = 'js__trigger-video-modal';
		}

		if ($additional_classes) {
			$this->classes = array_merge($this->classes, $additional_classes);
		}

		if ($attributes) {
			foreach ($attributes as $attr_name => $attr_value) {
				$this->additional_attrs[] = sprintf('%s=%s', esc_attr($attr_name), esc_attr($attr_value));
			}
		}
	}

	public function render(): void
	{
		if (!$this->link || !$this->text) {
			return;
		}

		?>
		<a class="<?php echo esc_attr(implode(' ', $this->classes)); ?>" href="<?php echo esc_url($this->link); ?>" <?php echo esc_attr(implode(' ', $this->additional_attrs)); ?> <?php echo $this->gtag; ?>>
			<?php echo esc_html($this->text); ?>
		</a>
		<?php
	}
}
