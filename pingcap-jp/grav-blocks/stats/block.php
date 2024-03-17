<?php
use WPUtil\Vendor\ACF;
use WPUtil\{ Arrays, Component };
use PingCAP\Components;

$stats = ACF::get_sub_field_array('stats');

if ($stats)
{
	$display_mode = ACF::get_sub_field_string('display_mode');

	?>
	<div class="block-inner block-inner--<?php echo esc_attr($display_mode); ?> contain">
		<?php
		if ($display_mode === 'carousel')
		{
			$content = ACF::get_sub_field_string('content');

			?>
			<div class="block-stats__content">
				<?php echo wp_kses_post(wpautop($content)); ?>
			</div>
			<?php

			Component::render(Components\StatsCarousel::class, [
				'stats' => $stats
			]);
		}
		else
		{
			foreach ($stats as $stat)
			{
				Component::render(Components\StatsCircle::class, [
					'number_start' => Arrays::get_value_as_int($stat, 'number_start'),
					'number_end' => Arrays::get_value_as_int($stat, 'number_end'),
					'number_interval' => Arrays::get_value_as_int($stat, 'number_interval', 1),
					'delay' => Arrays::get_value_as_int($stat, 'delay', 50),
					'number_prepend' => Arrays::get_value_as_string($stat, 'number_prepend'),
					'number_append' => Arrays::get_value_as_string($stat, 'number_append'),
					'text' => Arrays::get_value_as_string($stat, 'text'),
					'animate' => true,
					'color' => Arrays::get_value_as_string($stat, 'color')
				]);
			}
		}
		?>
	</div>
	<?php
}
