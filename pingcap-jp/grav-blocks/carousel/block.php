<?php

use WPUtil\Vendor\{ACF};
use WPUtil\{Arrays, SVG};
use Blueprint\Images;

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$block_title_desc = isset($block_title_desc) && is_string($block_title_desc) ? $block_title_desc : ACF::get_sub_field_string('block_title_desc');
$carousel = ACF::get_sub_field_array('carousel');
$is_video_mode =  ACF::get_sub_field_bool('video_mode');
?>
<div class="block-inner">
    <?php if ($block_title || $block_title_desc) { ?>
        <div class="block-section__title-container contain">
            <?php
            if ($block_title) {
            ?>
                <h2 class="block-section__title text-white"><?php echo esc_html($block_title); ?></h2>

            <?php } ?>
            <?php
            if ($block_title_desc) {
            ?>
                <div class="block-section__title-desc text-white"><?php echo $block_title_desc; ?></div>

            <?php } ?>
        </div>
    <?php } ?>

    <div class="block-carousel__container embla-instance <?php echo $is_video_mode ? '' : 'contain';?>">
        <div class="embla-wrapper">
            <div class="embla <?php echo $is_video_mode ? 'is-video' : '';?>">
                <div class="embla__container">
                    <?php
                    foreach ($carousel as $item) {
                        $title = Arrays::get_value_as_string($item, 'title');
                        $logo = Arrays::get_value_as_array($item, 'logo');
                        $content = Arrays::get_value_as_string($item, 'content');
                        $color = Arrays::get_value_as_string($item, 'color');
                        $slide_color = Arrays::get_value_as_string($item, 'slide_color');
                        $bg = Arrays::get_value_as_array($item, 'bg');
                        $video_image = Arrays::get_value_as_array($item, 'video_image');
                        $video_url = Arrays::get_value_as_string($item, 'video_url');
                    ?>
                        <?php if ($is_video_mode) {
                        ?>
                         <div class="embla__slide">
                             <a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="<?php echo esc_url($video_url); ?>">
                                 <?php
                                 Images::safe_image_output($video_image, ['class' => 'block-columns__video-image']);
 
                                 do_action('grav_blocks_get_video_link_button');
                                 ?>
                             </a>
                         </div>
                        <?php
                        } else {
                        ?>

                            <div class="embla__slide" data-color="<?php echo $color; ?>">
                                <div class="block-carousel__section bg-image" style="background-color: <?php echo $slide_color; ?>;">
                                    <div class="block-carousel__section-top">
                                        <h3><?php echo $title; ?></h3>
                                        <?php Images::safe_image_output($logo); ?>
                                    </div>
                                    <div class="block-carousel__section-content">
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="embla__pagination"></div>
            </div>
            <?php if(!$is_video_mode){ ?>
            <button class="embla__nav-button embla__nav-button--prev" type="button">
                <?php SVG::the_svg('general/chevron-left-light', ['class' => 'embla__nav-arrow embla__nav-arrow--left']); ?>
            </button>
            <button class="embla__nav-button embla__nav-button--next" type="button">
                <?php SVG::the_svg('general/chevron-right-light', ['class' => 'embla__nav-arrow embla__nav-arrow--right']); ?>
            </button>
            <?php } ?>
        </div>
    </div>
</div>