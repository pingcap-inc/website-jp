<?php

/**
 * Template Name: session replay
 */

use WPUtil\{Arrays, Vendor};
use WPUtil\Vendor\{ACF, BlueprintBlocks};
use Blueprint\Images;

get_header();

?>
<main class="tmpl-session-replay__content">
    <div class="contain">
        <h1 class="tmpl-session-replay__content-title">Session Replays</h1>
        <?php
        $replay_sections = ACF::get_field_array('session_replay_content');
        foreach ($replay_sections as $index => $replay_section) {
            $videos = Arrays::get_value_as_array($replay_section, 'video');
            $title = Arrays::get_value_as_string($replay_section, 'title');
        ?>
            <div class="tmpl-session-replay__card">
                <h5 class="tmpl-session-replay__card-title"><?php echo $title; ?></h5>
                <div class="tmpl-session-replay__card-items">
                    <?php
                    foreach ($videos as $video) {
                        $video_image = Arrays::get_value_as_array($video, 'image');
                        $video_url = Arrays::get_value_as_string($video, 'url');
                        $video_pdf = BlueprintBlocks::get_button_field_values('video_pdf', $video);
                    ?>
                        <div class="block-columns__column wysiwyg">
                            <a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="<?php echo esc_url($video_url); ?>">
                                <?php
                                Images::safe_image_output($video_image, ['class' => 'block-columns__video-image']);

                                do_action('grav_blocks_get_video_link_button', '');
                                ?>
                            </a>
                            <?php if ($video_pdf) { ?>
                                <div class="text-right">
                                    <a class="button" href="<?php echo $video_pdf->link; ?>"><?php echo $video_pdf->text; ?></a>
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
