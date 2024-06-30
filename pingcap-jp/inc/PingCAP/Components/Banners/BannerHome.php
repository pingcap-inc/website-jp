<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Vendor};
use WPUtil\Vendor\ACF;
use WPUtil\Models\BlueprintBlocksLink;

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
	 * The link button used in the banner
	 *
	 * @var \WPUtil\Models\BlueprintBlocksLink
	 */
	public BlueprintBlocksLink $button;


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
		$this->acf_prefix = Arrays::get_value_as_string($params, 'acf_prefix', 'banner_home');
		$this->newsTag = ACF::get_field_string('banner_home_news_tag', $this->post_id);
		$this->newsTitle = ACF::get_field_string('banner_home_news_title', $this->post_id);
		$this->newsButton = ACF::get_field_array('banner_home_news_button', $this->post_id);

		$this->title = Arrays::get_value_as_string($params, 'title', function () {
			$title_override = ACF::get_field_string('banner_home_title_override', $this->post_id);

			return trim($title_override) ? trim($title_override) : get_the_title($this->post_id);
		});

		$this->content = Arrays::get_value_as_string(
			$params,
			'content',
			fn () => ACF::get_field_string(
				'banner_home_content',
				$this->post_id
			)
		);

		$this->button = isset($params['button']) && is_a($params['button'], 'WPUtil\Models\BlueprintBlocksLink') ?
			$params['button'] :
			Vendor\BlueprintBlocks::get_button_field_values('banner_home_button', $this->post_id);
	}

	public function render(): void
	{
?>
		<div class="banner banner-home bg-black">
			<div class="banner-home__inner contain">
				<div class="banner-home__text-content">
					<h1 class="banner-home__title"><?php echo $this->title; ?></h1>
					<?php
					if ($this->content) {
					?>
						<div class="banner-home__content">
							<?php echo wp_kses_post(wpautop($this->content)); ?>
						</div>
					<?php
					}

					if ($this->button->link && $this->button->text) {
					?>
						<a href="<?php echo esc_url($this->button->link); ?>" class="button banner-home__button"><?php echo esc_html($this->button->text); ?></a>
					<?php
					}
					?>
				</div>
				<div class="banner-home__video">
					<div class="banner-home__video-content">
						<div class="banner-home__video-wrapper">
							<a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="https://static.pingcap.co.jp/files/2023/06/12233132/20230613-143048.mp4">
								<img class="block-columns__video-image" src="https://static.pingcap.co.jp/files/2023/05/17231954/20230518-141922.png">
								<?php
								do_action('grav_blocks_get_video_link_button');
								?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
	}
}
