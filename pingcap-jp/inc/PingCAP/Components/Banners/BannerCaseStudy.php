<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, SVG};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants, CPT, Taxonomies};
use PingCAP\Models\BreadcrumbLink;
use Blueprint\Images;

class BannerCaseStudy implements IComponent
{
	/**
	 * The post id used to source banner settings from
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * The banner title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * Flag indicating that the video link in the left column should be enabled
	 *
	 * @var boolean
	 */
	public bool $enable_video_link = false;

	/**
	 * The left column video link button text
	 *
	 * @var string
	 */
	public string $video_link_text = '';

	/**
	 * The left column video link button URL
	 *
	 * @var string
	 */
	public string $video_link_url = '';

	/**
	 * Additional content displayed below the title
	 *
	 * @var string
	 */
	public string $additional_content = '';

	/**
	 * The right side content type
	 *
	 * @var string
	 */
	public string $side_content_type = 'testimonial';

	/**
	 * The testimonial ID
	 *
	 * @var integer
	 */
	public int $testimonial_id = 0;

	/**
	 * The banner side image
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $side_image = null;

	/**
	 * The banner side image horizontal position
	 *
	 * @var integer
	 */
	public int $side_image_pos_horz = 50;

	/**
	 * The banner side image vertical position
	 *
	 * @var integer
	 */
	public int $side_image_pos_vert = 50;

	/**
	 * The banner side image video URL
	 *
	 * @var string
	 */
	public string $side_image_video_url = '';


	public function __construct(array $params)
	{
		$banner_prefix = 'banner_case_study';

		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());

		$customer_term = CPT\CaseStudy::getCustomerTerm($this->post_id);

		$this->customer_logo = Taxonomies\Customer::getLogoDarkImageACFObject($customer_term->term_id);
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));

		$this->text_align_mode = Arrays::get_value_as_string(
			$params,
			'text_align_mode',
			fn () => ACF::get_field_string(
				$banner_prefix . '_text_align_mode',
				$this->post_id
			)
		);

		$this->enable_video_link = Arrays::get_value_as_bool(
			$params,
			'enable_video_link',
			fn () => ACF::get_field_bool($banner_prefix . '_enable_video_link', $this->post_id)
		);

		if ($this->enable_video_link) {
			$this->video_link_text = Arrays::get_value_as_string(
				$params,
				'video_link_text',
				fn () => ACF::get_field_string($banner_prefix . '_video_link_text', $this->post_id)
			);

			$this->video_link_url = Arrays::get_value_as_string(
				$params,
				'video_link_url',
				fn () => ACF::get_field_string($banner_prefix . '_video_link_url', $this->post_id)
			);
		}

		$this->additional_content = Arrays::get_value_as_string(
			$params,
			'additional_content',
			fn () => ACF::get_field_string($banner_prefix . '_additional_content', $this->post_id)
		);

		$this->side_content_type = Arrays::get_value_as_string(
			$params,
			'side_content_type',
			fn () => ACF::get_field_string($banner_prefix . '_side_content_type', $this->post_id, ['default' => 'testimonial'])
		);

		switch ($this->side_content_type) {
			case 'testimonial':
				$this->testimonial_id = Arrays::get_value_as_int(
					$params,
					'testimonial_id',
					fn () => ACF::get_field_int($banner_prefix . '_testimonial_id', $this->post_id)
				);

				break;

			case 'image':
				$this->side_image = $params['side_image'] ?? ACF::get_field_array($banner_prefix . '_side_image', $this->post_id);

				$this->side_image_pos_horz = Arrays::get_value_as_int(
					$params,
					'side_image_pos_horz',
					fn () => ACF::get_field_int($banner_prefix . '_side_image_pos_horz', $this->post_id, ['default' => 50])
				);

				$this->side_image_pos_vert = Arrays::get_value_as_int(
					$params,
					'side_image_pos_vert',
					fn () => ACF::get_field_int($banner_prefix . '_side_image_pos_vert', $this->post_id, ['default' => 50])
				);

				$this->side_image_video_url = Arrays::get_value_as_string(
					$params,
					'side_image_video_url',
					fn () => ACF::get_field_string($banner_prefix . '_side_image_video_url', $this->post_id)
				);

				$this->side_image_max_height_desktop = Arrays::get_value_as_int(
					$params,
					'side_image_max_height_desktop',
					fn () => ACF::get_field_int(
						$this->$banner_prefix . '_side_image_max_height_desktop',
						$this->post_id,
						[
							'default' => 188,
							'allow_bool' => false
						]
					)
				);

				break;

			default:
				break;
		}
	}

	protected function getBreadcrumbLinks(): array
	{
		$links = [];

		$archive_link = get_post_type_archive_link(Constants\CPT::CASE_STUDY);
		$archive_title = CPT\CaseStudy::getArchiveTitle();

		if ($archive_link && $archive_title) {
			$links[] = new BreadcrumbLink($archive_title, $archive_link);
		}

		return $links;
	}

	protected function displayTestimonial()
	{
		if (!$this->testimonial_id) {
			return;
		}

		$testimonial_image = CPT\Testimonial::getImage($this->testimonial_id);
		$testimonial_content = CPT\Testimonial::getTestimonial($this->testimonial_id);
		$testimonial_attribution = CPT\Testimonial::getAttribution($this->testimonial_id);

		$testimonial_classes = [
			'banner-case-study__testimonial',
			'bg-white',
			'banner-animate'
		];

		if ($testimonial_image) {
			$testimonial_classes[] = 'banner-case-study__testimonial--has-image';
		}

?>
		<div class="<?php echo esc_attr(implode(' ', $testimonial_classes)); ?>">
			<?php
			Images::safe_image_output($testimonial_image, [
				'class' => 'banner-case-study__testimonial-image',
				'data-ib-no-cache' => 1
			]);

			Component::render(Components\Testimonial::class, [
				'content' => $testimonial_content,
				'attribution' => $testimonial_attribution
			]);
			?>
		</div>
	<?php
	}

	protected function displayImage()
	{
		if (!$this->side_image) {
			return;
		}

	?>
		<div class="banner-case-study__image-container banner-animate">
			<?php
			if ($this->side_image_video_url) {
				Component::render(Components\UI\PlayVideoOverlay::class, [
					'video_url' => $this->side_image_video_url
				]);
			}

			Images::safe_image_output($this->side_image, [
				'class' => 'banner-case-study__image',
				'style' => '--pos-x: ' . $this->side_image_pos_horz . '%; --pos-y: ' . $this->side_image_pos_vert . '%; max-height: ' . $this->side_image_max_height_desktop . 'px;'
			]);
			?>
		</div>
	<?php
	}

	public function render(): void
	{
		$banner_classes = [
			'banner',
			'banner-case-study',
			'banner-case-study--' . esc_attr($this->side_content_type),
			'banner--bottom-arc',
			'banner--bottom-arc-white',
			'bg-black'
		];

		$banner_text_content_classes = ['banner-default__text-content'];

		if ($this->text_align_mode) {
			$banner_text_content_classes[] = 'banner-default__text-content--center';
		}

		if ($this->side_image || $this->testimonial_id) {
			$banner_text_content_classes[] = 'has-image';
		}

	?>
		<div class="<?php echo esc_attr(implode(' ', $banner_classes)); ?>">
			<div class="banner-case-study__inner contain">
				<div class="<?php echo esc_attr(implode(' ', $banner_text_content_classes)); ?>">
					<div>
						<?php
						if ($this->customer_logo) {
							Images::safe_image_output($this->customer_logo, ['class' => 'banner-case-study__image']);
						}
						?>
						<h1 class="banner-case-study__title"><?php echo esc_html($this->title); ?></h1>
						<?php
						if ($this->additional_content) {
						?>
							<div class="banner-case-study__additional-content">
								<?php echo wp_kses_post(wpautop($this->additional_content)); ?>
							</div>
						<?php
						}

						if ($this->enable_video_link && $this->video_link_text && $this->video_link_url) {
						?>
							<a class="banner-case-study__video-link js--trigger-video-modal" href="<?php echo esc_url($this->video_link_url); ?>">
								<?php SVG::the_svg('general/play', ['class' => 'banner-case-study__video-link-icon']); ?>
								<span><?php echo esc_html($this->video_link_text); ?></span>
							</a>
						<?php
						}
						?>
					</div>
				</div>
				<?php
				if ($this->side_content_type === 'testimonial' && $this->testimonial_id) {
					$this->displayTestimonial();
				} elseif ($this->side_content_type === 'image' && $this->side_image) {
					$this->displayImage();
				}
				?>
			</div>
		</div>
<?php
	}
}
