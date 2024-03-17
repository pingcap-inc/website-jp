<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Component, SVG };
use PingCAP\{ Components, Constants };

class StatsCarousel implements IComponent
{
	public array $stats = [];
	public bool $is_small = false;
	public int $transition_speed = 10;
	public bool $enable_autoplay = false;
	public int $autoplay_speed = 3000;

	public function __construct(array $params)
	{
		$this->stats = Arrays::get_value_as_array($params, 'stats');
		$this->is_small = Arrays::get_value_as_bool($params, 'is_small', false);
		$this->transition_speed = Arrays::get_value_as_int($params, 'transition_speed', 10);
		$this->enable_autoplay = Arrays::get_value_as_bool($params, 'enable_autoplay', false);
		$this->autoplay_speed = Arrays::get_value_as_int($params, 'autoplay_speed', 3000);
	}

	public function render(): void
	{
		$container_classes = ['stats-carousel'];

		if ($this->is_small) {
			$container_classes[] = 'stats-carousel--small';
		}

		?>
		<div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
			<div class="stats-carousel__nav-col">
				<button class="embla__nav-button embla__nav-button--prev" type="button" aria-label="<?php esc_attr_e('Previous statistic', Constants\TextDomains::DEFAULT); ?>">
					<?php SVG::the_svg('general/chevron-left', ['class' => 'embla__nav-arrow embla__nav-arrow--left']); ?>
				</button>
			</div>
			<div
				class="stats-carousel__slides embla-instance"
				data-transition-speed="<?php echo esc_attr($this->transition_speed); ?>"
				data-enable-autoplay="<?php echo esc_attr(intval($this->enable_autoplay)); ?>"
				data-autoplay-speed="<?php echo esc_attr($this->autoplay_speed); ?>"
			>
				<div class="embla">
					<div class="embla__container">
						<?php
						foreach ($this->stats as $stat)
						{
							?>
							<div class="embla__slide">
								<?php
								Component::render(Components\StatsCircle::class, array_merge($stat, [
									'animate' => false,
									'is_small' => $this->is_small
								]));
								?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="stats-carousel__nav-col">
				<button class="embla__nav-button embla__nav-button--next" type="button" aria-label="<?php esc_attr_e('Next statistic', Constants\TextDomains::DEFAULT); ?>">
					<?php SVG::the_svg('general/chevron-right', ['class' => 'embla__nav-arrow embla__nav-arrow--right']); ?>
				</button>
			</div>
		</div>
		<?php
	}
}
