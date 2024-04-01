<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use PingCAP\Components;
use WPUtil\{Arrays, Component};
use Blueprint\Images;

class CaseStudyTestimonial implements IComponent
{
    /**
     * The testimonial image
     *
     * @var null|string|integer|array<string, mixed>
     */
    public $image = null;

    /**
     * The testimonial content
     *
     * @var string
     */
    public string $content = '';

    /**
     * The testimonial attribution
     *
     * @var string
     */
    public string $attribution = '';


    public function __construct(array $params)
    {
        $this->image = Arrays::get_value_as_array($params, 'image');
        $this->content = Arrays::get_value_as_string($params, 'content');
        $this->attribution = Arrays::get_value_as_string($params, 'attribution');
        $this->permalink = Arrays::get_value_as_string($params, 'permalink');
        $this->button_text = Arrays::get_value_as_string($params, 'button_text', '詳細を見る');
    }

    public function render(): void
    {
?>
        <div class="case-study-testimonial">
            <div class="case-study-testimonial__image-container">
                <?php Images::safe_image_output($this->image); ?>
            </div>
            <div class="case-study-testimonial__blockquote-container">
                <blockquote>
                    <?php echo wp_kses_post(wpautop($this->content)); ?>
                    <?php
                    if ($this->attribution) {
                    ?>
                        <cite><?php echo esc_html($this->attribution); ?></cite>
                    <?php
                    }
                    ?>
                </blockquote>
                <div class="text-right">
                    <?php
                    Component::render(Components\UI\Button::class, [
                        'link' => $this->permalink,
                        'text' => $this->button_text,
                    ]);
                    ?>
                </div>
            </div>

        </div>
<?php
    }
}
