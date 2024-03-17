<?php
namespace PingCAP\Components\UI;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, SVG, Util };

class PlayVideoOverlay implements IComponent
{
	public string $video_url = '';

	public function __construct(array $params)
	{
		$this->video_url = Arrays::get_value_as_string($params, 'video_url');
	}

	public function render(): void
	{
		$container_tag = $this->video_url ? 'a' : 'div';
		$container_attrs = [];
		$container_classes = ['play-video-overlay'];

		if ($this->video_url) {
			$container_attrs['href'] = $this->video_url;
			$container_classes[] = 'js--trigger-video-modal';
		}

		$container_attrs['class'] = implode(' ', $container_classes);

		?>
		<<?php echo esc_attr($container_tag); ?> <?php echo Util::attributes_array_to_string($container_attrs); // phpcs:ignore ?>>
			<?php SVG::the_svg('general/icon-play', ['class' => 'play-video-overlay__play-icon']); ?>
		</<?php echo esc_attr($container_tag); ?>>
		<?php
	}
}
