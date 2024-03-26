<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;

class Testimonial implements IComponent
{
	/**
	 * The testimonial content
	 *
	 * @var string
	 */
	public string $content = '';

	/**
	 * The testimonial attribution
	 *
	 * @var string
	 */
	public string $attribution = '';


	public function __construct(array $params)
	{
		$this->content = Arrays::get_value_as_string($params, 'content');
		$this->attribution = Arrays::get_value_as_string($params, 'attribution');
	}

	public function render(): void
	{
		?>
		<blockquote class="testimonial">
			<?php echo wp_kses_post(wpautop($this->content)); ?>
			<?php
			if ($this->attribution)
			{
				?>
				<cite><?php echo $this->attribution; ?></cite>
				<?php
			}
			?>
		</blockquote>
		<?php
	}
}
