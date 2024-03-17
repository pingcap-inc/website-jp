<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use Blueprint\Images;

class Illustration implements IComponent
{
	/**
	 * The illustration file info object returned from ACF
	 *
	 * @var array<string, mixed>
	 */
	public array $illustration_file_info = [];

	/**
	 * Classnames to use when rendering an image illustration
	 *
	 * @var array<string>
	 */
	public array $image_classes = [];

	/**
	 * Classnames to use when rendering a video illustration
	 *
	 * @var array<string>
	 */
	public array $video_classes = [];


	public function __construct(array $params)
	{
		$this->illustration_file_info = Arrays::get_value_as_array($params, 'illustration_file_info');
		$this->image_classes = Arrays::get_value_as_array($params, 'image_classes');
		$this->video_classes = Arrays::get_value_as_array($params, 'video_classes');
	}

	public function render(): void
	{
		switch ($this->illustration_file_info['type'] ?? '')
		{
			case 'image':
				$image_obj = function_exists('acf_get_attachment') ? acf_get_attachment($this->illustration_file_info['ID'] ?? 0) : null;

				Images::safe_image_output($image_obj, ['class' => implode(' ', $this->image_classes)]);

				break;

			case 'video':
				$video_url = $illustration_file['url'] ?? '';

				if ($video_url)
				{
					?>
					<video
						class="<?php echo esc_attr(implode(' ', $this->video_classes)); ?>"
						src="<?php echo esc_url($video_url); ?>"
						autoplay="true"
						playsinline="true"
						loop="true"
						muted="true"
					></video>
					<?php
				}

				break;

			default:
				break;
		}
	}
}
