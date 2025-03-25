<?php

use WPUtil\Vendor\ACF;
use PingCAP\Components;
use WPUtil\{Arrays, Component};

$pricing = ACF::get_sub_field_array('table_pricing');
$contact_link = ACF::get_sub_field_array('contact_link');

if ($pricing) {
    $selector_content = array_map(fn($pricing) => Arrays::get_value_as_string($pricing, 'selector_content'), $pricing);
    $providers_data = [];
    foreach ($pricing as $item) {
        $provider = Arrays::get_value_as_string($item, 'provider_selector_title');
        $providers_data[$provider][] = Arrays::get_value_as_string($item, 'region_selector_title');
    }
    $regions_data = $providers_data[Arrays::get_value_as_string($pricing[0], 'provider_selector_title')];
    $is_accordion = ACF::get_sub_field_bool('accordion_table');
    $accordion_title = ACF::get_sub_field_string('accordion_title');
?>
    <div class="block-table-pricing__container contain">
        <div class="block-table-pricing__content">
            <?php if ($is_accordion) { 
                $field_id = uniqid('accordion_table_');
                $section_id = $field_id . '_0';
            ?>
                <div class="accordion">
                    <div class="accordion__section">
                        <input style="display: none;" type="checkbox" name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($section_id); ?>" class="accordion__section-title-input">
                        <label class="accordion__section-title" for="<?php echo esc_attr($section_id); ?>">
                            <span class="accordion__plus-icon"></span>
                            <span class="accordion__section-title-text"><?php echo $accordion_title; ?></span>
                        </label>
                        <div class="accordion__section-content">
                        <?php } ?>
                        <div class="block-table-pricing__selector-container">
                            <div class="block-table-pricing__provider-selector">
                                <p>Provider</p>
                                <select data-providers-data="<?php echo htmlspecialchars(json_encode($providers_data)); ?>">
                                    <?php
                                    foreach ($providers_data as $provider_id => $provider_name) {
                                    ?>
                                        <option value="<?php echo esc_attr($provider_id); ?>"><?php echo esc_html($provider_id); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="block-table-pricing__region-selector">
                                <p>Region</p>
                                <select>
                                    <?php
                                    foreach ($regions_data as $region_id => $region_name) {
                                    ?>
                                        <option value="<?php echo esc_attr(str_replace(' ', '-', $region_name)); ?>"><?php echo esc_html($region_name); ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <p>
                                Want to try TiDB Cloud in another region?
                                <br />
                                <?php
                                Component::render(Components\UI\Button::class, [
                                    'link' => $contact_link['url'],
                                    'text' => $contact_link['title'],
                                    'attributes' => ['target' => $contact_link['target'] ? $contact_link['target'] : '_self'],
                                    'style' => 'button--secondary',
                                ]); ?>
                            </p>
                        </div>
                        <div class="block-table-pricing__selector-content wysiwyg">
                            <?php foreach ($selector_content as $content_id => $content) {
                                $provider_id =  Arrays::get_value_as_string($pricing[$content_id], 'provider_selector_title');
                                $region_id =  str_replace(' ', '-', Arrays::get_value_as_string($pricing[$content_id], 'region_selector_title'));
                                $table_id = 'selector-table-content-' . $provider_id . '-' . $region_id;
                                $table_classes = ['block-table-pricing__selector-content-table'];
                                if ($content_id === 0) {
                                    $table_classes[] = 'active';
                                }
                            ?>
                                <div class="<?php echo esc_attr(implode(' ', $table_classes)) ?>" data-table-id="<?php echo $table_id; ?>">
                                    <?php echo wp_kses_post(wpautop($content)); ?>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if ($is_accordion) { ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
}
