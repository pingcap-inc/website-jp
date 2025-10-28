<?php

/**
 * Template Name: session replay
 */

use WPUtil\{Arrays, Vendor};
use WPUtil\Vendor\{ACF, BlueprintBlocks};
use Blueprint\Images;

get_header();

$content_bg = ACF::get_field_string('content_bg') ?: 'https://static.pingcap.co.jp/files/2024/07/17160821/hexagon.png';

?>
<main class="tmpl-session-replay__content" style="background-image: url('<?php echo $content_bg; ?>')">
    <div class="contain">
        <h1 class="tmpl-session-replay__content-title">Session Replays</h1>
        <?php
        $button_color = ACF::get_field_string('button_color');
        $replay_sections = ACF::get_field_array('session_replay_content');
        foreach ($replay_sections as $index => $replay_section) {
            $videos = Arrays::get_value_as_array($replay_section, 'video');
            $title = Arrays::get_value_as_string($replay_section, 'title');
        ?>
            <div class="tmpl-session-replay__card <?php echo $button_color; ?>">
                <h5 class="tmpl-session-replay__card-title"><?php echo $title; ?></h5>
                <div class="tmpl-session-replay__card-items">
                    <?php
                    foreach ($videos as $video) {
                        $video_image = Arrays::get_value_as_array($video, 'image');
                        $video_url = Arrays::get_value_as_string($video, 'url');
                        $video_pdf = BlueprintBlocks::get_button_field_values('video_pdf', $video);
                        $has_another_link = Arrays::get_value_as_bool($video, 'has_another_link');
                        $another_link = BlueprintBlocks::get_button_field_values('another_link', $video);
                    ?>
                        <div class="block-columns__column wysiwyg">
                            <?php if ($video_url) { ?>
                                <a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="<?php echo esc_url($video_url); ?>">
                                    <?php
                                    Images::safe_image_output($video_image, ['class' => 'block-columns__video-image']);

                                    do_action('grav_blocks_get_video_link_button', '');
                                    ?>
                                </a>
                            <?php } else { ?>
                                <div class="block-columns__video-container">
                                    <?php
                                    Images::safe_image_output($video_image, ['class' => 'block-columns__video-image']);
                                    ?>
                                </div>
                            <?php } ?>
                            <?php if ($video_pdf->link) { ?>
                                <div class="button-group">
                                    <a class="button" href="<?php echo $video_pdf->link; ?>"><?php echo $video_pdf->text; ?></a>
                                    <?php if ($has_another_link) { ?>
                                        <a class="button-link" href="<?php echo $another_link->link; ?>"><?php echo $another_link->text; ?></a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
    </div>
</main>


<?php

Vendor\BlueprintBlocks::safe_display();

get_footer();
