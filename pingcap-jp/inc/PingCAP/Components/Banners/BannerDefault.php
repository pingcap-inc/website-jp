<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Vendor};
use WPUtil\Vendor\ACF;
use WPUtil\Models\BlueprintBlocksLink;
use Blueprint\Images;
use PingCAP\{Components, Constants};
use PingCAP\Models\BreadcrumbLink;

class BannerDefault implements IComponent
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
	 * The banner display mode
	 *
	 * @var string
	 */
	public string $banner_display_type = '';

	/**
	 * The banner page template
	 *
	 * @var string
	 */
	public string $banner_page = '';

	/**
	 * The breadcrumbs mode -- can be "" (disabled), "auto", or "custom"
	 *
	 * @var string
	 */
	public string $breadcrumbs_mode = '';

	/**
	 * An array of link objects representing the custom breadcrumbs
	 *
	 * @var array<string, mixed>
	 */
	public array $custom_breadcrumbs = [];

	/**
	 * The product icon image (used by "product" display mode)
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $product_icon_image = null;

	/**
	 * Array of information about the use case illustration returned from ACF
	 *
	 * @var array<string, mixed>
	 */
	public array $use_case_illustration = [];

	/**
	 * The banner sub title
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
	 * The link button used in the banner
	 *
	 * @var \WPUtil\Models\BlueprintBlocksLink
	 */
	public BlueprintBlocksLink $button;

	/**
	 * The banner side image
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $side_image = null;

	/**
	 * The banner side image WebM video URL for use on desktop displays
	 *
	 * @var string
	 */
	public $side_image_webm = '';

	/**
	 * The banner side image HEVC video URL for use on desktop displays
	 *
	 * @var string
	 */
	public $side_image_hevc = '';

	/**
	 * Flag indicating that the side image should be styled with a border radius
	 * and box shadow
	 *
	 * @var boolean
	 */
	public bool $side_image_is_styled = true;

	/**
	 * Flag indicating that the side image should be "pulled up" a small amount
	 * on large displays
	 *
	 * @var boolean
	 */
	public bool $side_image_pull_up = false;

	/**
	 * Flag indicating that the side image should cover the entire image container
	 *
	 * @var boolean
	 */
	public bool $side_image_cover = true;

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

	/**
	 * The banner side image maximum width (percentage) on desktop viewports
	 *
	 * @var integer
	 */
	public int $side_image_max_width_desktop = 100;

	/**
	 * The banner side image maximum height (percentage) on desktop viewports
	 *
	 * @var integer
	 */
	public int $side_image_max_height_desktop = 100;

	/**
	 * The form id
	 *
	 * @var string
	 */
	public string $side_form_id = '';

	/**
	 * The form portal id
	 *
	 * @var string
	 */
	public string $side_form_portal_id = '';

	/**
	 * The form calendly id
	 *
	 * @var string
	 */
	public string $side_form_calendly_id = '';
	/**
	 * The form calendly url
	 *
	 * @var string
	 */
	public string $side_form_calendly_url = '';

	/**
	 * Flag indicating that the bottom arc shape is enabled
	 *
	 * @var boolean
	 */
	public bool $bottom_arc_enabled = true;

	/**
	 * The bottom arc shape color
	 *
	 * @var string
	 */
	public string $bottom_arc_color = 'white';

	/**
	 * Flag indicating that the first block in the content following this
	 * banner is pulled up
	 *
	 * @var boolean
	 */
	public bool $first_block_pull_up = false;

	/**
	 * Flag indicating that the first block in the content following this
	 * banner is pulled up
	 *
	 * @var boolean
	 */
	public bool $padding_bottom_enabled = false;

	/**
	 * Flag indicating that there should be no gutter columns on the sides of
	 * the banner text content
	 *
	 * @var boolean
	 */
	public bool $no_gutters = false;

	/**
	 * 404
	 *
	 * @var boolean
	 */
	public bool $is_404 = false;


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn() => get_the_ID());
		$this->post_type = get_post_type($this->post_id);
		$this->acf_prefix = Arrays::get_value_as_string($params, 'acf_prefix', 'banner');

		$this->breadcrumbs_mode = Arrays::get_value_as_string(
			$params,
			'breadcrumbs_mode',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_breadcrumbs_mode',
				$this->post_id
			)
		);

		$this->custom_breadcrumbs = Arrays::get_value_as_array(
			$params,
			'custom_breadcrumbs',
			fn() => ACF::get_field_array(
				$this->acf_prefix . '_custom_breadcrumbs',
				$this->post_id
			)
		);

		$this->text_align_mode = Arrays::get_value_as_string(
			$params,
			'text_align_mode',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_text_align_mode',
				$this->post_id
			)
		);

		$this->banner_bg_color = Arrays::get_value_as_string(
			$params,
			'banner_bg_color',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_banner_bg_color',
				$this->post_id
			)
		);

		$this->banner_display_type = Arrays::get_value_as_string(
			$params,
			'banner_display_type',
			fn() => ACF::get_field_string($this->acf_prefix . '_banner_display_type', $this->post_id)
		);

		$this->banner_page_template = Arrays::get_value_as_string(
			$params,
			'banner_page_template',
			fn() => ACF::get_field_string($this->acf_prefix . '_banner_page_template', $this->post_id)
		);

		$this->banner_bg = $params['banner_bg'] ?? ACF::get_field_array($this->acf_prefix . '_banner_bg', $this->post_id);

		$this->subtitle = ACF::get_field_string($this->acf_prefix . '_subtitle', $this->post_id);

		$this->title_container_size = Arrays::get_value_as_string(
			$params,
			'title_container_size',
			fn() => ACF::get_field_string(
				'banner_title_container_size',
				$this->post_id
			)
		);

		$this->use_case_illustration = Arrays::get_value_as_array(
			$params,
			'use_case_illustration',
			fn() => ACF::get_field_array($this->acf_prefix . '_use_case_illustration', $this->post_id)
		);

		$this->title = Arrays::get_value_as_string($params, 'title', function () {
			$title_override = ACF::get_field_string($this->acf_prefix . '_title_override', $this->post_id);

			return trim($title_override) ? trim($title_override) : get_the_title($this->post_id);
		});

		$this->content = Arrays::get_value_as_string(
			$params,
			'content',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_content',
				$this->post_id
			)
		);

		$this->button = isset($params['button']) && is_a($params['button'], 'WPUtil\Models\BlueprintBlocksLink') ?
			$params['button'] :
			Vendor\BlueprintBlocks::get_button_field_values($this->acf_prefix . '_button', $this->post_id);

		$this->side_image = $params['side_image'] ?? ACF::get_field_array($this->acf_prefix . '_side_image', $this->post_id);

		$this->side_image_webm = Arrays::get_value_as_string(
			$params,
			'side_image_webm',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_side_image_webm',
				$this->post_id
			)
		);

		$this->side_image_hevc = Arrays::get_value_as_string(
			$params,
			'side_image_hevc',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_side_image_hevc',
				$this->post_id
			)
		);

		if ($this->side_image || ($this->side_image_webm && $this->side_image_hevc)) {
			$this->side_image_is_styled = Arrays::get_value_as_bool(
				$params,
				'side_image_is_styled',
				fn() => ACF::get_field_bool(
					$this->acf_prefix . '_side_image_is_styled',
					$this->post_id,
					['default' => true]
				)
			);

			$this->side_image_pull_up = Arrays::get_value_as_bool(
				$params,
				'side_image_pull_up',
				fn() => ACF::get_field_bool(
					$this->acf_prefix . '_side_image_pull_up',
					$this->post_id,
					['default' => false]
				)
			);

			$this->side_image_cover = Arrays::get_value_as_bool(
				$params,
				'side_image_cover',
				fn() => ACF::get_field_bool(
					$this->acf_prefix . '_side_image_cover',
					$this->post_id,
					['default' => true]
				)
			);

			$this->side_image_pos_horz = Arrays::get_value_as_int(
				$params,
				'side_image_pos_horz',
				fn() => ACF::get_field_int(
					$this->acf_prefix . '_side_image_pos_horz',
					$this->post_id,
					['default' => 50]
				)
			);

			$this->side_image_pos_vert = Arrays::get_value_as_int(
				$params,
				'side_image_pos_vert',
				fn() => ACF::get_field_int(
					$this->acf_prefix . '_side_image_pos_vert',
					$this->post_id,
					['default' => 50]
				)
			);

			$this->side_image_video_url = Arrays::get_value_as_string(
				$params,
				'side_image_video_url',
				fn() => ACF::get_field_string(
					$this->acf_prefix . '_side_image_video_url',
					$this->post_id
				)
			);

			$this->side_image_max_width_desktop = Arrays::get_value_as_int(
				$params,
				'side_image_max_width_desktop',
				fn() => ACF::get_field_int(
					$this->acf_prefix . '_side_image_max_width_desktop',
					$this->post_id,
					[
						'default' => 100,
						'allow_bool' => false
					]
				)
			);

			$this->side_image_max_height_desktop = Arrays::get_value_as_int(
				$params,
				'side_image_max_height_desktop',
				fn() => ACF::get_field_int(
					$this->acf_prefix . '_side_image_max_height_desktop',
					$this->post_id,
					[
						'default' => 100,
						'allow_bool' => false
					]
				)
			);
		}

		$this->side_video_bg = Arrays::get_value_as_bool(
			$params,
			'side_video_bg',
			fn() => ACF::get_field_bool(
				$this->acf_prefix . '_side_video_bg',
				$this->post_id,
				['default' => false]
			)
		);

		$this->bottom_arc_enabled = Arrays::get_value_as_bool(
			$params,
			'bottom_arc_enabled',
			fn() => ACF::get_field_bool(
				$this->acf_prefix . '_bottom_arc_enabled',
				$this->post_id,
				['default' => true]
			)
		);

		$this->bottom_arc_color = Arrays::get_value_as_string(
			$params,
			'bottom_arc_color',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_bottom_arc_color',
				$this->post_id,
				['default' => 'white']
			)
		);

		$this->first_block_pull_up = Arrays::get_value_as_bool(
			$params,
			'first_block_pull_up',
			fn() => ACF::get_field_bool(
				$this->acf_prefix . '_first_block_pull_up',
				$this->post_id,
				['default' => false]
			)
		);

		$this->padding_bottom_enabled = Arrays::get_value_as_bool(
			$params,
			'padding_bottom_enabled',
			fn() => ACF::get_field_bool(
				$this->acf_prefix . '_padding_bottom_enabled',
				$this->post_id,
				['default' => false]
			)
		);

		$this->side_form_id = Arrays::get_value_as_string(
			$params,
			'side_form_id',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_side_form_id',
				$this->post_id,
			)
		);
		$this->side_form_portal_id = Arrays::get_value_as_string(
			$params,
			'side_form_portal_id',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_side_form_portal_id',
				$this->post_id,
			)
		);
		$this->side_form_calendly_id = Arrays::get_value_as_string(
			$params,
			'side_form_calendly_id',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_side_form_calendly_id',
				$this->post_id,
			)
		);
		$this->side_form_calendly_url = Arrays::get_value_as_string(
			$params,
			'side_form_calendly_url',
			fn() => ACF::get_field_string(
				$this->acf_prefix . '_side_form_calendly_url',
				$this->post_id,
			)
		);

		$this->no_gutters = Arrays::get_value_as_bool($params, 'no_gutters', false);
		$this->is_404 = Arrays::get_value_as_bool($params, 'is_404', false);
		$this->customer_classes = Arrays::get_value_as_string($params, 'customer_classes', fn() => ACF::get_field_string(
			$this->acf_prefix . '_customer_classes',
			$this->post_id,
			['default' => '']
		));
		$this->no_category_post_types = [
			Constants\CPT::EVENT,
		];
	}

	protected function getBreadcrumbLinks(): array
	{
		$links = [];

		switch ($this->breadcrumbs_mode) {
			case 'auto':
				$parent_ids = get_post_ancestors($this->post_id);

				if ($parent_ids) {
					$rev_parent_ids = array_reverse($parent_ids);

					foreach ($rev_parent_ids as $parent_id) {
						$links[] = new BreadcrumbLink(get_the_title($parent_id), get_the_permalink($parent_id));
					}
				}

				break;

			case 'custom':
				foreach ($this->custom_breadcrumbs as $custom_breadcrumb) {
					$link_values = Vendor\BlueprintBlocks::get_button_field_values('breadcrumb', $custom_breadcrumb);

					if ($link_values->link && $link_values->text) {
						$links[] = new BreadcrumbLink($link_values->text, $link_values->link);
					}
				}

				break;

			default:
				break;
		}

		return $links;
	}

	public function outputSideImageMarkup()
	{
		if (!$this->side_image) {
			return;
		}

		$image_classes = ['banner-default__image'];

		if ($this->side_image_is_styled) {
			$image_classes[] = 'banner-default__image--styled';
		}

		if ($this->side_image_cover) {
			$image_classes[] = 'banner-default__image--cover';
		}

		Images::safe_image_output($this->side_image, [
			'class' => implode(' ', $image_classes),
			'style' => '--pos-x: ' . $this->side_image_pos_horz . '%; --pos-y: ' . $this->side_image_pos_vert . '%; --image-max-width: ' . $this->side_image_max_width_desktop . '%; max-height: ' . $this->side_image_max_height_desktop . 'px;'
		]);
	}

	public function outputSideImageVideoMarkup()
	{
		if (!$this->side_image_webm || !$this->side_image_hevc) {
			return;
		}

		$image_classes = ['banner-default__image-video'];

		if ($this->side_image_is_styled) {
			$image_classes[] = 'banner-default__image-video--styled';
		}

		if ($this->side_image_cover) {
			$image_classes[] = 'banner-default__image-video--cover';
		}

?>
		<video class="<?php echo esc_attr(implode(' ', $image_classes)); ?>" style="--image-max-width: <?php echo esc_attr($this->side_image_max_width_desktop); ?>%; max-height: <?php echo esc_attr($this->side_image_max_height_desktop); ?>px;" autoplay muted loop playsinline>
			<?php
			if ($this->side_image_hevc) {
			?>
				<source src="<?php echo esc_url($this->side_image_hevc); ?>" type='video/mp4; codes="hvc1"'>
			<?php
			}

			if ($this->side_image_webm) {
			?>
				<source src="<?php echo esc_url($this->side_image_webm); ?>" type="video/webm">
			<?php
			}
			?>
		</video>
	<?php
	}

	public function render(): void
	{
		if (!$this->banner_bg_color) {
			$this->banner_bg_color = 'bg-black';
		}

		$banner_classes = [
			'banner',
			'banner-default',
			$this->banner_bg ? 'block-bg-image' : $this->banner_bg_color,
			$this->customer_classes
		];

		if ($this->banner_display_type) {
			$banner_classes[] = 'banner-default--display-type-' . esc_attr($this->banner_display_type);
		}

		if ($this->banner_page_template) {
			$banner_classes[] = 'banner-default--page-template-' . esc_attr($this->banner_page_template);
		}

		if (($this->side_image && $this->banner_display_type !== 'use-case') || ($this->side_image_webm && $this->side_image_hevc)) {
			$banner_classes[] = 'banner-default--side-image';
		}

		if ($this->side_form_id && $this->side_form_portal_id) {
			$banner_classes[] = 'banner-default--has-side-form';
		}

		if ($this->bottom_arc_enabled) {
			$banner_classes[] = 'banner--bottom-arc';
			$banner_classes[] = 'banner--bottom-arc-' . esc_attr($this->bottom_arc_color);
		} else {
			$banner_classes[] = 'banner--no-bottom-arc';
		}

		if ($this->first_block_pull_up) {
			$banner_classes[] = 'banner-default--first-block-pull-up';
		}

		if ($this->padding_bottom_enabled) {
			$banner_classes[] = 'banner--padding-bottom';
		}

		if ($this->no_gutters) {
			$banner_classes[] = 'banner-default--no-gutters';
		}

		if ($this->side_image_webm || $this->side_image_hevc) {
			$banner_classes[] = 'banner-default--has-video';
		}

		$banner_text_content_classes = ['banner-default__text-content'];

		if ($this->title_container_size) {
			$banner_text_content_classes[] = $this->title_container_size;
		}

		if ($this->text_align_mode) {
			$banner_text_content_classes[] = 'banner-default__text-content--center';
		}

	?>
		<div class="<?php echo esc_attr(implode(' ', $banner_classes)); ?>" <?php if (isset($this->banner_bg['url']) && $this->banner_bg['url']) {
																				echo 'style="background-image: url(' . $this->banner_bg['url'] . ')"';
																			}; ?>>
			<div class="banner-default__inner contain">
				<?php
				if ($this->banner_display_type === 'use-case' && $this->use_case_illustration) {
					Component::render(Components\Illustration::class, [
						'illustration_file_info' => $this->use_case_illustration,
						'image_classes' => [
							'banner-default__use-case-illustration',
							'banner-default__use-case-image',
							'banner-animate'
						],
						'video_classes' => [
							'banner-default__use-case-illustration',
							'banner-default__use-case-video',
							'banner-animate'
						]
					]);
				}
				?>
				<div class="<?php echo esc_attr(implode(' ', $banner_text_content_classes)); ?>">
					<div>
						<div>

							<?php if ($this->banner_display_type === 'product' && $this->subtitle) { ?>
								<div class="title-mono"><?php echo $this->subtitle; ?></div>
							<?php } ?>

							<h1 class="banner-default__title">
								<?php echo $this->title; ?>
							</h1>
						</div>
						<?php

						$cat_terms = get_the_category($this->post_id);

						if (!$this->is_404 && $cat_terms && !in_array($this->post_type, $this->no_category_post_types, true)) {
						?>
							<div class="banner-default__meta">
								<?php
								foreach ($cat_terms as $term) {
									$term_url = get_term_link($term, Constants\Taxonomies::BLOG_CATEGORY);

									if (!is_string($term_url)) {
										continue;
									}

								?>
									<a class="banner-default__meta-cat" href="<?php echo esc_url($term_url); ?>"><?php echo esc_html($term->name); ?></a>
								<?php
								}
								?>
							</div>
						<?php } ?>

						<?php
						if ($this->content) {
						?>
							<div class="wysiwyg">
								<?php echo wp_kses_post(wpautop($this->content)); ?>
							</div>
						<?php
						}

						if ($this->button->link && $this->button->text) {
						?>
							<a href="<?php echo esc_url($this->button->link); ?>" class="button banner-default__button"><?php echo esc_html($this->button->text); ?></a>
						<?php
						}
						?>
					</div>
				</div>
				<?php
				if (($this->side_image || ($this->side_image_webm && $this->side_image_hevc)) && $this->banner_display_type !== 'use-case' && !$this->side_image_video_url) {
					$image_container_classes = ['banner-default__image-container'];

					if ($this->side_image_pull_up) {
						$image_container_classes[] = 'banner-default__image-container--pull-up';
					}

					if ($this->side_image_max_height_desktop) {
						$image_style = 'style="max-height:' . $this->side_image_max_height_desktop . 'px"';
					}

				?>
					<div class="<?php echo esc_attr(implode(' ', $image_container_classes)); ?>" <?php echo $image_style; ?>>
						<?php
						if ($this->side_image_video_url) {
							Component::render(Components\UI\PlayVideoOverlay::class, [
								'video_url' => $this->side_image_video_url
							]);
						}

						if ($this->side_image && !$this->side_image_webm) {
							$this->outputSideImageMarkup();
						}
						?>
					</div>
				<?php
				}
				?>

				<?php if ($this->side_form_id && $this->side_form_portal_id) {
				?>
					<div class="banner-default__form-content">
						<?php
						Component::render(Components\HubSpotForm::class, [
							'portal_id' => $this->side_form_portal_id,
							'form_id' => $this->side_form_id,
							'calendly_id' => $this->side_form_calendly_id,
							'calendly_url' => $this->side_form_calendly_url
						]);
						?>
					</div>
				<?php } ?>

				<?php if ($this->side_image_video_url) { ?>
					<div class="banner-default__video">
						<div class="banner-default__video-content">
							<?php
							Component::render(Components\UI\PlayVideoOverlay::class, [
								'video_url' => $this->side_image_video_url
							]);

							if ($this->side_image) {
								$this->outputSideImageMarkup();
							}
							?>
						</div>
					</div>
				<?php } ?>

			</div>


			<?php
			if ($this->side_image) {
			?>
				<template class="banner-default__tmpl-side-image">
					<?php $this->outputSideImageMarkup(); ?>
				</template>
			<?php
			}

			if ($this->side_image_webm || $this->side_image_hevc) {
			?>
				<template class="banner-default__tmpl-side-image-video">
					<?php $this->outputSideImageVideoMarkup(); ?>
				</template>
			<?php
			}
			?>
		</div>
<?php
	}
}
