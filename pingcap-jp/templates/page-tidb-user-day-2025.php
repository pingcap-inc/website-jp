<?php

/**
 * Template Name: TiDB User Day 2025
 */

use WPUtil\{Arrays, Vendor};
use WPUtil\Vendor\ACF;

get_header();

?>
<div class="tmpl-tidb-user-day-2025">
    <div class="banner">
        <div class="inner">
            <?php echo ACF::get_field_string('banner_content'); ?>
        </div>
    </div>
    <section class="block-options-padding-remove-top block-options-padding-remove-bottom bg-black-dark block-container block-columns" aria-label="Columns">
        <div class="block-inner contain grid is-12" data-num-col="1" data-format="">
            <div class="block-columns__column wysiwyg">
                <?php echo ACF::get_field_string('carousel_content'); ?>
            </div>
        </div>
    </section>

    <section class="carousel block-options-padding-remove-top bg-black-dark">
        <div class="carousel-list-container">
            <div class="carousel-list">
                <?php
                $image_list = ACF::get_field_array('carousel_list');
                foreach ($image_list as $image) {
                    echo '<div class="carousel-item">';
                    echo '<img src="' . Arrays::get_value_as_string($image, 'carousel_image') . '" class="carousel-item-image">';
                    echo '</div>';
                }
                ?>
            </div>
            <div class="carousel-list">
                <?php
                $image_list = ACF::get_field_array('carousel_list');
                foreach ($image_list as $image) {
                    echo '<div class="carousel-item">';
                    echo '<img src="' . Arrays::get_value_as_string($image, 'carousel_image') . '" class="carousel-item-image">';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>

    <section id="about" class="about bg-black-gradient block-container">
        <div class="block-inner contain">
           <?php echo ACF::get_field_string('about_content'); ?>
        </div>
    </section>
    <?php echo Vendor\BlueprintBlocks::safe_display(); ?>
</div>

<?php

get_footer();
