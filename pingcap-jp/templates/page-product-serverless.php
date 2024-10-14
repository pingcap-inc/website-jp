<?php

/**
 * Template Name: TiDB Serverless
 */

use PingCAP\Components;
use WPUtil\{Component, Vendor, Arrays};
use WPUtil\Vendor\{ACF};
use Blueprint\Images;

get_header();

Component::render(Components\Banners\BannerDefault::class);
?>

<main class="tmpl-product tmpl-product-serverless">

    <?php Vendor\BlueprintBlocks::safe_display(['include_blocks' => array('case')]); ?>

    <section class="database block-container bg-black-gradient">
        <div class="block-inner contain">
            <?php echo ACF::get_field_string('features_block_title'); ?>
            <div class="database__card-container">
                <?php
                $features = ACF::get_field_array('features');
                foreach ($features as $feature) {
                    $image = Arrays::get_value_as_array($feature, 'image');
                    $title = Arrays::get_value_as_string($feature, 'title');
                    $desc = Arrays::get_value_as_string($feature, 'desc');
                ?>
                    <div class="database__card">
                        <div class="database__card-image-container">
                            <?php Images::safe_image_output($image); ?>
                        </div>
                        <div class="database__card-title"><?php echo $title; ?></div>
                        <?php echo $desc; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="community block-container bg-black-dark">
        <div class="block-inner contain">
            <div class="community__title-container">
                <?php echo ACF::get_field_string('product_community_title'); ?>
                <div class="community__card-container">
                    <?php
                    $community_icons = ACF::get_field_array('product_community_icon');
                    foreach ($community_icons as $community_icon) {
                        $image = Arrays::get_value_as_array($community_icon, 'image');
                        $title = Arrays::get_value_as_string($community_icon, 'title');
                        $repo = Arrays::get_value_as_string($community_icon, 'repo');
                        $repo_count = Arrays::get_value_as_string($community_icon, 'repo_count');
                    ?>
                        <div class="community__card">
                            <div class="community__card-image-container">
                                <?php Images::safe_image_output($image); ?>
                            </div>
                            <div class="community__card-title" <?php echo 'id="' . $repo . '"'; ?>><?php echo $repo_count; ?></div>
                            <p><?php echo $title; ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="community-tabs block-tabs-slide">
                <?php $sections = ACF::get_field_array('product_community_sections'); ?>
                <div class="block-tabs-slide__mobile">
                    <?php foreach ($sections as $section) {
                        $title = Arrays::get_value_as_string($section, 'title');
                        $content = Arrays::get_value_as_string($section, 'content');
                    ?>
                        <div class="block-tabs-slide__content">
                            <div class="block-tabs-slide__content-title"><?php echo $title; ?></div>
                            <?php echo wp_kses_post(wpautop($content)); ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="block-tabs-slide__desktop">
                    <div class="block-tabs-slide__menu">
                        <?php
                        foreach ($sections as $section) {
                            $title = Arrays::get_value_as_string($section, 'title');
                            echo '<div class="block-tabs-slide__tab">';
                            echo '<div class="block-tabs-slide__tab-title">' . $title . '</div>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="block-tabs-slide__panel">
                        <?php foreach ($sections as $section) {
                            $content = Arrays::get_value_as_string($section, 'content');
                        ?>
                            <div class="block-tabs-slide__content">
                                <?php echo wp_kses_post(wpautop($content)); ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
    </section>

    <section class="integration block-container bg-black-gradient">
        <div class="block-inner contain">
            <?php echo ACF::get_field_string('product_integration_title'); ?>
            <div class="integration__card-container">
                <?php
                $integrations = ACF::get_field_array('product_integrations');
                foreach ($integrations as $integration) {
                    $logo = Arrays::get_value_as_array($integration, 'image');
                    Images::safe_image_output($logo);
                }
                ?>
            </div>

        </div>
    </section>

    <?php Vendor\BlueprintBlocks::safe_display(['include_blocks' => array('testimonials-slide', 'cta')]); ?>

</main>

<?php

get_footer();
