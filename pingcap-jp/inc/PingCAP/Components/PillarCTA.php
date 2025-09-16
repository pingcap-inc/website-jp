<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use Blueprint\Images;

class PillarCTA implements IComponent
{
    public string $title = '';
    public string $background = '';
    public string $button_text = '';
    public string $button_link = '';
    public string $image = '';
    public string $classes = '';

    public function __construct(array $params)
    {
        $this->title = Arrays::get_value_as_string($params, 'title');
        $this->background = Arrays::get_value_as_string($params, 'background');
        $this->image = Arrays::get_value_as_string($params, 'image');
        $this->button_text = Arrays::get_value_as_string($params, 'button_text');
        $this->button_link = Arrays::get_value_as_string($params, 'button_link');
        $this->classes = Arrays::get_value_as_string($params, 'classes');
    }

    public function render(): void
    {
?>
        <div class="pillar-cta <?php echo $this->classes; ?>" style="background-image: url(<?php echo $this->background; ?>)">
            <div class="pillar-cta-container">
                <?php if($this->image){ ?>
                <div class="image-container">
                    <?php Images::safe_image_output(['url' => $this->image], ['data-lazy-ignore' => true]); ?>
                </div>
                <?php } ?>
                <div class="content-container">
                    <div class="title"><?php echo $this->title; ?></div>
                    <div>
                        <a class="button button-white" href="<?php echo $this->button_link; ?>"><?php echo $this->button_text; ?></a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
