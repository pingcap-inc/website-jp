<?php

use WPUtil\Vendor\{ACF, BlueprintBlocks};
use WPUtil\{Arrays, Component, SVG};
use PingCAP\Components;

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$features = ACF::get_sub_field_array('features');

?>
<div class="block-inner contain is-10">

    <?php if ($block_title) { ?>
        <div class="block-section__title-container contain">

            <h2 class="block-section__title"><?php echo esc_html($block_title); ?></h2>
        </div>
    <?php } ?>

    <div class="block-compare-features__container">
        <div class="block-compare-features__content">
            <div class="block-compare-features__head-container">
                <div class="block-compare-features__head">
                    <div class="block-compare-features__head-cloud">
                        <div class="block-compare-features__head-title">Cloud DBaaS</div>
                        <div class="block-compare-features__head-cloud-wrapper">
                            <div>
                                <h5>TiDB Serverless</h5>
                                <?php
                                $tidb_serverless_link = BlueprintBlocks::get_button_field_values('link', ACF::get_sub_field_array('tidb_serverless_link'));

                                Component::render(Components\UI\Button::class, [
                                    'link' => $tidb_serverless_link->link,
                                    'text' => $tidb_serverless_link->text,
                                    'style' => 'button--secondary',
                                ]);
                                ?>
                            </div>
                            <div>
                                <h5>TiDB Dedicated</h5>
                                <?php
                                $tidb_dedicated_link = BlueprintBlocks::get_button_field_values('link', ACF::get_sub_field_array('tidb_dedicated_link'));

                                Component::render(Components\UI\Button::class, [
                                    'link' => $tidb_dedicated_link->link,
                                    'text' => $tidb_dedicated_link->text,
                                    'style' => 'button--secondary',
                                ]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5>TiDB Self-Hosted</h5>
                        <?php
                        $tidb_hosted_link = BlueprintBlocks::get_button_field_values('link', ACF::get_sub_field_array('tidb_hosted_link'));

                        Component::render(Components\UI\Button::class, [
                            'link' => $tidb_hosted_link->link,
                            'text' => $tidb_hosted_link->text,
                            'style' => 'button--secondary',
                        ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="block-compare-features__table">
                <?php
                foreach ($features as $feature) {
                    $feature_title = Arrays::get_value_as_string($feature, 'feature_title');
                    $feature_items = Arrays::get_value_as_array($feature, 'feature_items');

                    echo '<div>';
                    echo '<div class="block-compare-features__table-head">' . $feature_title . '</div>';

                    foreach ($feature_items as $feature_item) {
                        $feature_item_title = Arrays::get_value_as_string($feature_item, 'feature_item_title');
                        $feature_item_enable_text = Arrays::get_value_as_bool($feature_item, 'feature_item_enable_text');
                        $feature_item_serverless = Arrays::get_value_as_bool($feature_item, 'feature_item_serverless');
                        $feature_item_serverless_text = Arrays::get_value_as_string($feature_item, 'feature_item_serverless_text');
                        $feature_item_dedicated = Arrays::get_value_as_bool($feature_item, 'feature_item_dedicated');
                        $feature_item_dedicated_text = Arrays::get_value_as_string($feature_item, 'feature_item_dedicated_text');
                        $feature_item_hosted = Arrays::get_value_as_bool($feature_item, 'feature_item_hosted');
                        $feature_item_hosted_text = Arrays::get_value_as_string($feature_item, 'feature_item_hosted_text');
                ?>
                        <div class="block-compare-features__table-tr">
                            <div class="block-compare-features__table-title">
                                <?php echo $feature_item_title; ?>
                            </div>
                            <div class="block-compare-features__table-th-container">
                                <div class="block-compare-features__table-th">
                                    <?php
                                    if (!$feature_item_enable_text && $feature_item_serverless) {
                                        SVG::the_svg('table-block/check-mark', ['class' => 'is-h-40']);
                                    }
                                    ?>
                                    <?php
                                    if ($feature_item_enable_text) {
                                        echo $feature_item_serverless_text;
                                    }
                                    ?>
                                </div>
                                <div class="block-compare-features__table-th">
                                    <?php
                                    if (!$feature_item_enable_text && $feature_item_dedicated) {
                                        SVG::the_svg('table-block/check-mark', ['class' => 'is-h-40']);
                                    }
                                    ?>
                                    <?php
                                    if ($feature_item_enable_text) {
                                        echo $feature_item_dedicated_text;
                                    }
                                    ?>
                                </div>
                                <div class="block-compare-features__table-th">
                                    <?php
                                    if (!$feature_item_enable_text && $feature_item_hosted) {
                                        SVG::the_svg('table-block/check-mark', ['class' => 'is-h-40']);
                                    }
                                    ?>
                                    <?php
                                    if ($feature_item_hosted_text) {
                                        echo $feature_item_hosted_text;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    echo '</div>';
                }
                ?>

            </div>
        </div>
    </div>
</div>

</div>