<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays};
use WPUtil\Vendor\ACF;

class BannerHome implements IComponent
{
	/**
	 * The post id used to source banner settings from
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * ACF field prefix
	 *
	 * @var string
	 */
	public string $acf_prefix = 'banner';

	/**
	 * The banner subtitle
	 *
	 * @var string
	 */
	public string $subtitle = '';

	/**
	 * The banner title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The banner content
	 *
	 * @var string
	 */
	public string $content = '';

	/**
	 * The banner video url
	 *
	 * @var string
	 */
	public string $video_url = '';


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn() => get_the_ID());
		$this->acf_prefix = Arrays::get_value_as_string($params, 'acf_prefix', 'banner_home');

		$this->video_url = ACF::get_field_string('banner_home_video_url', $this->post_id);
		$this->title = Arrays::get_value_as_string($params, 'title', function () {
			$title_override = ACF::get_field_string('banner_home_title_override', $this->post_id);

			return trim($title_override) ? trim($title_override) : get_the_title($this->post_id);
		});
		$this->content = Arrays::get_value_as_string(
			$params,
			'content',
			fn() => ACF::get_field_string(
				'banner_home_content',
				$this->post_id
			)
		);
		$this->subtitle = ACF::get_field_string('banner_home_subtitle', $this->post_id);
	}

	public function render(): void
	{
?>
		<div class="banner banner-home bg-black-dark">
			<div class="contain">
				<div class="banner-home__inner">
					<div class="banner-home__text-container">
						<div>
							<p class="title-mono"><?php echo $this->subtitle; ?></p>
							<h1><?php echo $this->title; ?></h1>
						</div>
						<div class="banner-home__desc-container">
							<?php echo $this->content; ?>
						</div>
					</div>
					<div class="banner-home__video-container">
						<dotlottie-player src="<?php echo $this->video_url; ?>" background="transparent" speed="1" direction="1" playMode="normal" loop autoplay></dotlottie-player>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}
