<?php

use WPUtil\Vendor\ACF;
use WPUtil\{Arrays, SVG, Component};
use Blueprint\Images;
use PingCAP\{Components};

$cards = ACF::get_sub_field_array('feature_cards');
$first_col_title = ACF::get_sub_field_array('first_col_title');
$columns = ACF::get_sub_field_array('columns');

?>
<!-- <div class="block-feature"> -->
    <div class="block-inner contain">
        <div class="block-feature__card">
            <?php foreach ($cards as $card) {
                $title = Arrays::get_value_as_string($card, 'title');
                $icon_image = $card['icon_image'] ?? null;
                $content = Arrays::get_value_as_string($card, 'content');
                $button = Arrays::get_value_as_array($card, 'button');
            ?>
                <div class="block-feature__card-column">
                    <?php echo Images::safe_image_output($icon_image, ['class' => 'block-feature__card-logo','data-ib-no-cache' => 1]); ?>
                    <div class="block-feature__card-container">
                        <div>
                            <h4 class="block-feature__card-title"><?php echo esc_html($title); ?></h4>
                            <?php
                            echo wp_kses_post(wpautop($content));
                            ?>
                        </div>
                        <div class="block-feature__card-button">
                            <?php
                            Component::render(Components\UI\Button::class, [
                                'link' => $button['url'],
                                'text' => $button['title'],
                                'attributes' => ['target' => $button['target'] ? $button['target'] : '_self']
                            ]);
                            ?>
                        </div>
                    </div>


                </div>
            <?php } ?>
        </div>
        <table class="block-feature__table" data-num-cols="<?php echo esc_attr(count($columns)); ?>">
            <thead>
                <th></th>
                <?php
                foreach ($columns as $col) {
                    $col_title = Arrays::get_value_as_string($col, 'title');
                ?>
                    <th><?php echo esc_html($col_title); ?></th>
                <?php
                }
                ?>
            </thead>
            <tbody>
                <?php
                foreach ($first_col_title as $row_index => $row_title) {
                    $is_section_title = Arrays::get_value_as_bool($row_title, 'section_title');
                    $row_title_value = Arrays::get_value_as_string($row_title, 'title');
                    $row_title_desc = Arrays::get_value_as_string($row_title, 'description');
                    $row_section_classes = [];
                    $row_first_td_classes = [];
                    if ($is_section_title) {
                        $row_section_classes[] = 'block-feature__row-section';
                    }
                    if ($row_title_desc) {
                        $row_first_td_classes[] = 'block-feature__first-col-cell';
                    }
                ?>
                    <tr class="<?php echo esc_attr(implode(' ', $row_section_classes)); ?>">
                        <td>
                            <div class="<?php echo esc_attr(implode(' ', $row_first_td_classes)); ?>">
                                <?php echo esc_html($row_title_value); ?>
                                <?php if ($row_title_desc) { ?>
                                    <div class="block-feature__first-col-desc"><?php echo esc_html($row_title_desc); ?></div>
                                <?php } ?>
                            </div>
                        </td>

                        <?php
                        foreach ($columns as $col) {
                            $col_row_values = Arrays::get_value_as_array($col, 'row_values');
                            $col_row_index_values = $col_row_values[$row_index] ?? null;
                            $col_value = '';

                            if ($col_row_index_values) {
                                $col_row_type = Arrays::get_value_as_string($col_row_index_values, 'type');

                                switch ($col_row_type) {
                                    case 'text':
                                        $col_value = Arrays::get_value_as_string($col_row_index_values, 'text');
                                        break;

                                    case 'checkmark':
                                        $color = Arrays::get_value_as_string($col_row_index_values, 'checkmark_color');

                                        $svg_name = 'table-block/table_check';
                                        $svg_classes = ['block-table__icon', 'block-table__icon--' . $color];

                                        $col_value = '<div class="block-table__icon-container">' . SVG::get_svg($svg_name, ['class' => implode(' ', $svg_classes)]) . '</div>';
                                        break;

                                    default:
                                        break;
                                }
                            }

                        ?>
                            <td>
                                <?php echo $col_value; // phpcs:ignore 
                                ?>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<!-- </div> -->
<?php
