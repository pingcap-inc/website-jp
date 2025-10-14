<?php

/**
 * Template Name: TiDB Product
 */

use PingCAP\Components;
use WPUtil\{Component, Vendor, Arrays};
use WPUtil\Vendor\{ACF, BlueprintBlocks};
use Blueprint\Images;

get_header();

Component::render(Components\Banners\BannerDefault::class);
?>

<main class="tmpl-product">
    <?php Vendor\BlueprintBlocks::safe_display(); ?>

    <?php if(ACF::get_field_string('features_block_title')) { ?>
    <section class="features block-container bg-black-dark">
        <div class="block-inner contain">
            <div class="features__title-container">
                <?php echo ACF::get_field_string('features_block_title'); ?>
            </div>
            <div class="features__card-container">
                <?php
                $features = ACF::get_field_array('features');
                foreach ($features as $feature) {
                    $image = Arrays::get_value_as_array($feature, 'image');
                    $title = Arrays::get_value_as_string($feature, 'title');
                    $desc = Arrays::get_value_as_string($feature, 'desc');
                ?>
                    <div class="features__card">
                        <div class="features__card-image-container">
                            <?php Images::safe_image_output($image); ?>
                        </div>
                        <div class="features__card-title"><?php echo $title; ?></div>
                        <p><?php echo $desc; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if(ACF::get_field_string('product_advantages_title')) { ?>
    <section class="why block-container <?php echo ACF::get_field_string('product_advantages_bg'); ?>">
        <div class="block-inner contain">
            <div class="why__title-container">
                <h3><?php echo ACF::get_field_string('product_advantages_title'); ?></h3>
                <p class="subtitle"><?php echo ACF::get_field_string('product_advantages_desc'); ?></p>
            </div>
            <div class="why__card-container">
                <?php
                $advantages = ACF::get_field_array('product_advantages');
                foreach ($advantages as $advantage) {
                    $title = Arrays::get_value_as_string($advantage, 'title');
                    $desc = Arrays::get_value_as_string($advantage, 'desc');
                ?>
                    <div class="why__card">
                        <div class="why__card-line"></div>
                        <div class="why__card-title"><?php echo $title; ?></div>
                        <p><?php echo $desc; ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="why__product-container">
                <?php
                $products = ACF::get_field_array('product_advantages_products');
                foreach ($products as $product) {
                    $image = Arrays::get_value_as_array($product, 'image');
                    $title = Arrays::get_value_as_string($product, 'title');
                    $desc = Arrays::get_value_as_string($product, 'desc');
                    $link = BlueprintBlocks::get_button_field_values('link', $product);
                ?>
                    <div class="why__product">
                        <div class="why__product-image">
                            <?php Images::safe_image_output($image); ?>
                        </div>
                        <div class="why__product-content">
                            <div class="why__product-title"><?php echo $title; ?></div>
                            <p><?php echo $desc; ?></p>
                            <a href="<?php echo $link->link; ?>" class="button-link"><?php echo $link->text; ?><i class="button__arrow"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

    <?php if(ACF::get_field_string('product_resources_title')) { ?>
    <section class="resource block-container bg-black-dark">
        <div class="block-inner contain">
            <div class="resource__title"><?php echo ACF::get_field_string('product_resources_title'); ?></div>
            <div class="resource__card-container">
                <?php
                $resources = ACF::get_field_array('product_resources');
                foreach ($resources as $resource) {
                    $image = Arrays::get_value_as_array($resource, 'image');
                    $title = Arrays::get_value_as_string($resource, 'title');
                    $desc = Arrays::get_value_as_string($resource, 'desc');
                    $link = BlueprintBlocks::get_button_field_values('link', $resource);
                ?>
                    <div class="resource__card">
                        <div class="resource__card-content">
                            <?php Images::safe_image_output($image); ?>
                            <div class="resource__card-title"><?php echo $title; ?></div>
                            <p><?php echo $desc; ?></p>
                        </div>
                        <div class="text-right">
                            <a href="<?php echo $link->link; ?>" class="button-link"><?php echo $link->text; ?><i class="button__arrow"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>

</main>

<?php

get_footer();
