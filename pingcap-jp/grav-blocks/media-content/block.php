<?php

use WPUtil\Vendor\ACF;
use WPUtil\{Util, Vendor};
use Blueprint\Images;

$block_bg = isset($block_bg) && is_array($block_bg) ? $block_bg : ACF::get_sub_field_array('block_bg');
$block_bg_mobile = isset($block_bg_mobile) && is_array($block_bg_mobile) ? $block_bg_mobile : ACF::get_sub_field_array('block_bg_mobile');
$image ??= ACF::get_sub_field_array('image');

if ($image) {
	$image_size = isset($image_size) && is_string($image_size) ? $image_size : ACF::get_sub_field_string('image_size', ['default' => 'medium']);
	$image_alignment = isset($image_alignment) && is_string($image_alignment) ? $image_alignment : ACF::get_sub_field_string('image_alignment', ['default' => 'right']);

	$image_link_type = isset($image_link_type) && is_string($image_link_type) ? $image_link_type : ACF::get_sub_field_string('image_link_type', ['default' => 'none']);
	$image_link_url = isset($image_link_url) && is_string($image_link_url) ? $image_link_url : ACF::get_sub_field_string('image_link_' . $image_link_type, ['default' => '']);

	$image_link = Vendor\BlueprintBlocks::get_button_field_values('image_link', [
		'image_link_type' => isset($image_link_type) && is_string($image_link_type) ? $image_link_type : ACF::get_sub_field_string('image_link_type', ['default' => 'none']),
		'image_link_' . $image_link_type => $image_link_url
	]);

	$image_shadow = $image_shadow ?? ACF::get_sub_field_int('image_shadow');
	$constrain_image = $constrain_image ?? ACF::get_sub_field_int('constrain_image');

	$image_container_classes = [
		'block-media-content__image-container'
	];

	if ($constrain_image) {
		$image_container_classes[] = 'block-media-content__image-container--constrain';
	}

	$image_container_tag = 'div';
	$image_container_attrs = [
		'class' => esc_attr(implode(' ', $image_container_classes))
	];

	if ($image_link->link) {
		$image_container_tag = 'a';
		$image_container_attrs['href'] = $image_link->link;

		if ($image_link->type === 'video') {
			$image_container_attrs['class'] .= ' js--trigger-video-modal';
		}
	}

	$center_content = isset($center_content) ? $center_content : ACF::get_sub_field_int('center_content');

	$content_classes = ['block-media-content__content-container', 'wysiwyg'];

	if ($center_content) {
		$content_classes[] = 'block-media-content__content-container--vertical-center';
	}

?>
	<div class="block-inner contain">
		<div class="block-media-content__container" data-image-size="<?php echo esc_attr($image_size); ?>" data-image-alignment="<?php echo esc_attr($image_alignment); ?>">
			<<?php echo esc_attr($image_container_tag); ?> <?php echo Util::attributes_array_to_string($image_container_attrs); // phpcs:ignore 
															?>>

				<?php
				$image_classes = ['block-media-content__image'];

				if ($image_shadow) {
					$image_classes[] = 'block-media-content__image--shadow';
				}

				Images::safe_image_output($image, ['class' => implode(' ', $image_classes)]);

				if ($image_link->type === 'video') {
					do_action('grav_blocks_get_video_link_button');
				}
				?>
			</<?php echo esc_attr($image_container_tag); ?>>
			<div class="<?php echo esc_attr(implode(' ', $content_classes)); ?>">
				<?php the_sub_field('content'); ?>
			</div>
		</div>
	</div>
	<?php if ($block_bg) { ?>
		<div class="block-media-content__bg is-mobile-hide" style="background-image: url(<?php echo $block_bg['url']; ?>);" data-image-alignment="<?php echo esc_attr($image_alignment); ?>"></div>
	<?php } ?>
	<?php if ($block_bg_mobile) { ?>
		<div class="block-media-content__bg is-desktop-hide" style="background-image: url(<?php echo $block_bg_mobile['url']; ?>);" data-image-alignment="<?php echo esc_attr($image_alignment); ?>"></div>
	<?php } ?>
<?php
}
