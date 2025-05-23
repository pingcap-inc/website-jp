<?php

/**
 * Template Name: TiDB User Day 2025
 */

use Blueprint\Images;
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
    <section class="block-options-padding-remove-top introduction bg-black-dark block-container block-columns" aria-label="Columns">
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

    <?php
    $agenda_list = ACF::get_field_array('agenda_list');
    if (count($agenda_list)) {
    ?>
        <section id="agenda" class="agenda bg-black-dark block-container">
            <div class="block-inner contain">
                <div class="block-title">
                    <h4><?php echo ACF::get_field_string('agenda_block_title'); ?></h4>
                </div>
                <div class="agenda-list">
                    <?php
                    foreach ($agenda_list as $list) {
                        $agenda_card_color = Arrays::get_value_as_string($list, 'agenda_card_color');
                        $agenda_start_time = Arrays::get_value_as_string($list, 'agenda_start_time');
                        $agenda_end_time = Arrays::get_value_as_string($list, 'agenda_end_time');
                        $agenda_image = Arrays::get_value_as_array($list, 'agenda_image');
                        $agenda_title = Arrays::get_value_as_string($list, 'agenda_title');
                        $agenda_desc = Arrays::get_value_as_string($list, 'agenda_desc');
                        $agenda_summary = Arrays::get_value_as_string($list, 'agenda_summary');
                    ?>
                        <div class="timeline <?php echo $agenda_summary ? 'timeline--has-summary js--trigger-tiud-summary-modal' : ''; ?>">
                            <div class="time"><?php echo $agenda_start_time; ?><span class="line"></span><?php echo $agenda_end_time; ?></div>
                            <div class="card <?php echo $agenda_card_color ?> <?php echo !$agenda_image ? 'bg-' . $agenda_card_color : ''; ?>">
                                <div class="image-container <?php echo $agenda_image ? 'has-image' : ''; ?>">
                                    <?php Images::safe_image_output($agenda_image, ['data-lazy-ignore' => 1]); ?>
                                </div>
                                <div class="content">
                                    <h3><?php echo $agenda_title; ?></h3>
                                    <?php if ($agenda_desc) { ?>
                                        <p><?php echo $agenda_desc; ?></p>
                                    <?php } ?>
                                    <?php if ($agenda_summary) { ?>
                                        <div class="summary"><?php echo $agenda_summary; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php echo Vendor\BlueprintBlocks::safe_display(); ?>
</div>

<script>
    const navbarEl = document.querySelector('.navbar-toggle');
    const navEl = document.querySelector('.tmpl-tidb-user-day-2025__header nav');
    const navMenuEls = document.querySelectorAll('.tmpl-tidb-user-day-2025__header .nav-menu');
    navbarEl.addEventListener('click', () => {
        if (navEl.classList.contains('active')) {
            navEl.classList.remove('active');
        } else {
            navEl.classList.add('active');
        }
    });
    navMenuEls.forEach(el => {
        el.addEventListener('click', () => {
            navEl.classList.remove('active');
        })
    });
</script>

<?php

get_footer();
