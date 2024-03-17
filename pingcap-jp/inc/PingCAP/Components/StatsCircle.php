<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;

class StatsCircle implements IComponent
{
	public int $number_start = 0;
	public int $number_end = 0;
	public int $number_interval = 0;
	public int $delay = 0;
	public string $number_prepend = '';
	public string $number_append = '';
	public string $text = '';
	public bool $animate = false;
	public string $color = '';
	public bool $is_small = false;

	public function __construct(array $params)
	{
		$this->number_start = Arrays::get_value_as_int($params, 'number_start');
		$this->number_end = Arrays::get_value_as_int($params, 'number_end');
		$this->number_interval = Arrays::get_value_as_int($params, 'number_interval');
		$this->delay = Arrays::get_value_as_int($params, 'delay');
		$this->number_prepend = Arrays::get_value_as_string($params, 'number_prepend');
		$this->number_append = Arrays::get_value_as_string($params, 'number_append');
		$this->text = Arrays::get_value_as_string($params, 'text');
		$this->animate = Arrays::get_value_as_bool($params, 'animate', false);
		$this->color = Arrays::get_value_as_string($params, 'color');
		$this->is_small = Arrays::get_value_as_bool($params, 'is_small', false);
	}

	public function render(): void
	{
		$container_classes = ['stats-circle'];

		if ($this->animate) {
			$container_classes[] = 'stats-circle--animate';
		}

		if ($this->color) {
			$container_classes[] = 'stats-circle--' . esc_attr($this->color);
		}

		if ($this->is_small) {
			$container_classes[] = 'stats-circle--small';
		}

		?>
		<div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
			<div class="stats-circle__circle">
				<?php
				if ($this->number_prepend)
				{
					?>
					<span class="stats-circle__counter-prepend">
						<?php echo esc_html($this->number_prepend); ?>
					</span>
					<?php
				}
				?>
				<span
					class="stats-circle__counter-value"
					data-number-start="<?php echo esc_attr($this->number_start); ?>"
					data-number-end="<?php echo esc_attr($this->number_end); ?>"
					data-number-current="<?php echo esc_attr($this->animate ? $this->number_start : $this->number_end); ?>"
					data-interval="<?php echo esc_attr($this->number_interval); ?>"
					data-delay="<?php echo esc_attr($this->delay); ?>"
				>
					<?php echo esc_html(number_format($this->animate ? $this->number_start : $this->number_end)); ?>
				</span>
				<?php
				if ($this->number_append)
				{
					?>
					<span class="stats-circle__counter-append">
						<?php echo esc_html($this->number_append); ?>
					</span>
					<?php
				}
				?>
			</div>
			<?php
			if ($this->text)
			{
				?>
				<h4 class="stats-circle__title"><?php echo esc_html($this->text); ?></h4>
				<?php
			}
			?>
		</div>
		<?php
	}
}
