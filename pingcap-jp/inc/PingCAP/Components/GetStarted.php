<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use Blueprint\Images;

class GetStarted implements IComponent
{
	public string $title = '';
	public array $platforms = [];

	public function __construct(array $params)
	{
		$this->title = Arrays::get_value_as_string($params, 'title');
		$this->platforms = Arrays::get_value_as_array($params, 'platforms');

		// ensure each platform has a valid image
		$this->platforms = array_filter($this->platforms, function ($platform) {
			$image = Arrays::get_value_as_array($platform, 'image');

			return !$image ? false : true;
		});
	}

	public function render(): void
	{
		?>
		<div class="get-started">
			<h4><?php echo $this->title; ?></h4>
			<div class="get-started__row-selectors">
				<?php
				foreach ($this->platforms as $index => $platform)
				{
					$image = Arrays::get_value_as_array($platform, 'image');
					$btn_classes = ['get-started__selector'];

					if ($index === 0) {
						$btn_classes[] = 'active';
					}

					?>
					<button class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>" data-platform-index="<?php echo esc_attr($index); ?>">
						<?php Images::safe_image_output($image, ['class' => 'get-started__selector-image']); ?>
					</button>
					<?php
				}
				?>
			</div>
			<div class="get-started__row-content">
				<?php
				foreach ($this->platforms as $index => $platform)
				{
					$title = Arrays::get_value_as_string($platform, 'title');
					$pre_steps_content = Arrays::get_value_as_string($platform, 'pre_steps_content');
					$steps = Arrays::get_value_as_array($platform, 'steps');
					$post_steps_content = Arrays::get_value_as_string($platform, 'post_steps_content');

					$section_classes = ['get-started__platform-section', 'wysiwyg'];

					if ($index === 0) {
						$section_classes[] = 'active';
					}

					?>
					<div class="<?php echo esc_attr(implode(' ', $section_classes)); ?>" data-platform-index="<?php echo esc_attr($index); ?>">
						<?php
						if ($title)
						{
							?>
							<h4><?php echo esc_html($title); ?></h4>
							<?php
						}

						if ($pre_steps_content)
						{
							echo wp_kses_post(wpautop($pre_steps_content));
						}

						foreach ($steps as $step_index => $step)
						{
							$step_title = Arrays::get_value_as_string($step, 'title');
							$commands = Arrays::get_value_as_string($step, 'commands');

							?>
							<div class="get-started__step">
								<?php
								if ($step_title)
								{
									?>
									<h4><?php echo esc_attr($step_index + 1); ?>. <?php echo esc_html($step_title); ?></h4>
									<?php
								}

								if ($commands)
								{
									// NOTE: The "pre" tag and its children below must exist on one
									// line and aligned to the far left to prevent formatting issues
									// with the generated page markup

									?>
<pre><code class="language-bash"><?php echo htmlentities(trim($commands)); // phpcs:ignore ?></code></pre>
									<?php
								}
								?>
							</div>
							<?php
						}

						if ($post_steps_content)
						{
							echo wp_kses_post(wpautop($post_steps_content));
						}
						?>
					</div>
					<?php
				}
				?>
			</div>
			<div class="get-started__footer-content">
				<a class="button" href="https://github.com/pingcap/tidb" data-gtag="event:product_download,tidb_download_version:view_on_github"><i class="icon-github"></i>View on GitHub</a>
			</div>
		</div>
		<?php
	}
}
