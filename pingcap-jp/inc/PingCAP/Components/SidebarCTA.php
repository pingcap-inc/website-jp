<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Vendor\{ACF, BlueprintBlocks};
use PingCAP\{Components};
use WPUtil\{Component, Arrays};

class SidebarCTA implements IComponent
{
    public int $sidebar_cta_id = 0;
    public bool $is_sticky = false;


    public function __construct(array $params)
    {
        $this->sidebar_cta_id = Arrays::get_value_as_int($params, 'sidebar_cta_id');
        $this->is_sticky = Arrays::get_value_as_bool($params, 'is_sticky');
    }

    public function render(): void
    {
        $background = ACF::get_field_string('bg', $this->sidebar_cta_id);
        $title = ACF::get_field_string('title', $this->sidebar_cta_id);
        $content = ACF::get_field_string('content', $this->sidebar_cta_id);
        $button = BlueprintBlocks::get_button_field_values('button', $this->sidebar_cta_id);

?>
        <div class="tmpl-single-post__cta <?php echo $this->is_sticky ? 'sticky' : ''; ?>">
            <div class="tmpl-single-post__cta-container" style="background-image:url('<?php echo $background ?>')">
                <h3 class="tmpl-single-post__cta-title"><?php echo $title; ?></h3>
                <div class="tmpl-single-post__cta-content"><?php echo $content; ?></div>
                <div class="tmpl-single-post__cta-button">
                    <?php
                    Component::render(Components\UI\Button::class, [
                        'link' => $button->link,
                        'text' => $button->text,
                        'gtag' => $button->gtag,
                        'style' => 'button button-white'
                    ]);
                    ?>
                </div>
            </div>
        </div>
<?php
    }
}
