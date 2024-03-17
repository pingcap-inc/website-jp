<?php


use PingCAP\{Components, Posts};
use WPUtil\{Component, Vendor};
use WPUtil\Vendor\ACF;
use Blueprint\Images;

get_header();

Component::render(Components\Banners\BannerDefault::class, [
    'bottom_arc_color' => 'white',
    'breadcrumbs_mode' => 'auto',
    'no_gutters' => true,
    'bottom_arc_enabled' => true,
    'banner_page_template' => 'gated-resource'
]);

$gated_resource_image = ACF::get_field_array('gated_resource_image');
$gated_resource_content = ACF::get_field_string('gated_resource_content');
$gated_resource_sidebar_content = ACF::get_field_string('gated_resource_sidebar_content');

?>
<main class="tmpl-gated-resource">
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();

    ?>
            <div class="tmpl-gated-resource__container">
                <div class="tmpl-gated-resource__container-inner contain">
                    <div class="tmpl-gated-resource__box bg-white">
                        <?php
                        $featured_image = Posts::getFeaturedImageACFObject(get_the_ID());
                        if ($featured_image) {
                        ?>
                            <div class="tmpl-gated-resource__featured-image-container">
                                <?php
                                echo Images::safe_image_output($featured_image, ['class' => 'tmpl-gated-resource__featured-image']); // phpcs:ignore 
                                ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div id="gated-form" class="tmpl-gated-resource__sidebar">
                        <div class="tmpl-gated-resource__sidebar-content-wrapper">
                            <?php
                            if (!empty($gated_resource_sidebar_content)) {
                            ?>
                                <div class="content">
                                    <?php echo $gated_resource_sidebar_content; ?>
                                </div>
                            <?php } ?>
                            <?php
                            Component::render(Components\HubSpotForm::class, [
                                'portal_id' => ACF::get_field_string('hubspot_portal_id'),
                                'form_id' => ACF::get_field_string('hubspot_form_id'),
                                'salesforce_id' => ACF::get_field_string('hubspot_salesforce_id'),
                                'border' => 'none',
                            ]);
                            ?>
                        </div>
                    </div>

                </div>

                <div class="tmpl-gated-resource__container-inner contain">
                    <div class="tmpl-gated-resource__box bg-white">
                        <div class="tmpl-gated-resource__content bg-white">

                            <?php
                            if (!empty($gated_resource_content)) {
                                echo ($gated_resource_content);
                            }
                            ?>

                        </div>
                    </div>
                    <div></div>
                </div>
            </div>
    <?php
            Vendor\BlueprintBlocks::safe_display();
        }
    }
    ?>

</main>
<?php

get_footer();
