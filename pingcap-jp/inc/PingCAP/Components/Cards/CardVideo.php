<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays};
use WPUtil\Vendor\ACF;
use Blueprint\Images;

class CardVideo implements IComponent
{
    public int $post_id = 0;
    public bool $is_featured = false;
    public $video_image = null;
    public string $title = '';
    public string $video_title = '';
    public string $video_url = '';
    public string $video_content = '';

    public function __construct(array $params)
    {
        $this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
        $this->is_featured = Arrays::get_value_as_bool($params, 'is_featured', false);
        $this->video_image = Arrays::get_value_as_array($params, 'video_image', fn () => ACF::get_field_array('video_image', $this->post_id));
        $this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
        $this->video_title = Arrays::get_value_as_string($params, 'video_title', fn () => ACF::get_field_string('video_title', $this->post_id));
        $this->video_url = Arrays::get_value_as_string($params, 'video_url', fn () => ACF::get_field_string('video_url', $this->post_id));
        $this->video_content = Arrays::get_value_as_string($params, 'video_content', fn () => ACF::get_field_string('video_content', $this->post_id));
    }

    public function render(): void
    {
?>
        <div class="block-columns__column wysiwyg">
            <?php if ($this->video_image && $this->video_url) {
            ?>
                <a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="<?php echo esc_url($this->video_url); ?>">
                    <?php
                    Images::safe_image_output($this->video_image, ['class' => 'block-columns__video-image']);

                    do_action('grav_blocks_get_video_link_button');
                    ?>
                </a>
            <?php
            }
            ?>
            <p class="block-columns__video-title"><?php echo $this->video_title? $this->video_title : $this->title; ?></p>
            <?php if($this->is_featured){ echo $this->video_content; }; ?>
        </div>
<?php
    }
}
