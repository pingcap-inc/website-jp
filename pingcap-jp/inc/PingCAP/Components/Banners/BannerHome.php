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

	/**
	 * The banner video url for mobile
	 *
	 * @var string
	 */
	public string $video_url_mobile = '';

	/**
	 * Whether to show the video or the image/lottie
	 *
	 * @var bool
	 */
	public bool $is_video = true;


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn() => get_the_ID());
		$this->acf_prefix = Arrays::get_value_as_string($params, 'acf_prefix', 'banner_home');

		$this->video_url = ACF::get_field_string('banner_home_video_url', $this->post_id);
		$this->video_url_mobile = ACF::get_field_string('banner_home_video_url_mobile', $this->post_id);
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
		$this->is_video = Arrays::get_value_as_bool($params, 'is_video', fn() => ACF::get_field_bool('banner_home_is_video', $this->post_id));
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
					<div class="banner-home__video-container <?php echo $this->is_video ? 'video' : ''; ?>">
						<?php if ($this->is_video) : ?>
							<?php $mobile_video_url = $this->video_url_mobile ?: $this->video_url; ?>
							<video id="banner-home-video" class="banner-home__video" poster="https://static.pingcap.co.jp/files/2026/04/27194212/20260424-144302.jpeg" autoplay muted loop playsinline webkit-playsinline preload="auto" fetchpriority="high" data-src-desktop="<?php echo $this->video_url; ?>" data-src-mobile="<?php echo $mobile_video_url; ?>"></video>
							<script>
							(function () {
								var v = document.getElementById('banner-home-video');
								v.src = window.matchMedia('(min-width: 700px)').matches ? v.dataset.srcDesktop : v.dataset.srcMobile;
							})();
							</script>
						<?php else : ?>
							<img class="banner-home__hero-poster" src="https://static.pingcap.com/files/2026/03/13004420/webhero-poster.webp" fetchpriority="high" alt="TiDB Distributed SQL Database" width="600" height="718">
							<dotlottie-player src="<?php echo $this->video_url; ?>" background="transparent" speed="1" direction="1" playMode="normal" loop autoplay></dotlottie-player>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}
