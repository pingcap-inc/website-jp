<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, SVG };

class Video implements IComponent
{
    public string $url = '';
    public string $image = '';

    public function __construct(array $params)
    {
        $this->url = Arrays::get_value_as_string($params, 'url');
        $this->image = Arrays::get_value_as_string($params, 'image');
    }

    public function render(): void
    {
?>
        <div>
            <a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="<?php echo esc_url($this->url); ?>">
                <img class="block-columns__video-image" src="<?php echo $this->image; ?>">
                <span class="play-video-overlay">
                    <?php SVG::the_svg('general/icon-play', ['class' => 'play-video-overlay__play-icon']); ?>
                </span>
            </a>
        </div>
<?php
    }
}
