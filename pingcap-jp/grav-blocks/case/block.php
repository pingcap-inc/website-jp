<?php

use WPUtil\Vendor\ACF;
use WPUtil\{Arrays};
use Blueprint\Images;

$block_title = ACF::get_sub_field_string('block_title');
$block_title_desc = ACF::get_sub_field_string('block_title_desc');
$cards = ACF::get_sub_field_array('case_cards');

?>
<div class="block-inner contain">
    <div class="case-container" data-num-cols="<?php echo count($cards); ?>">
        <?php if ($block_title) { ?>
            <div class="case-framer case-title">
                <h5><?php echo $block_title; ?></h5>
                <?php if ($block_title_desc) { ?>
                    <p class="desc"><?php echo $block_title_desc; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
        <?php foreach ($cards as $card) {
            $image = Arrays::get_value_as_array($card, 'logo');
            $title = Arrays::get_value_as_string($card, 'title');
            $desc = Arrays::get_value_as_string($card, 'desc');
            $case_study_id = Arrays::get_value_as_int($card, 'case_study_id');
            $link = get_permalink($case_study_id);
        ?>
            <div class="case-framer">
                <a class="case-card" href="<?php echo $link; ?>">
                    <?php Images::safe_image_output($image); ?>
                    <div class="case-card__title"><?php echo  $title; ?></div>
                    <p><?php echo  $desc; ?></p>
                    <span class="button-link">Read More<i class="button__arrow"></i></span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
