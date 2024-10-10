<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Util};
use Blueprint\Images;

class CardBg implements IComponent
{
    /**
     * The bg card image
     *
     * @var null|string|integer|array<string, mixed>
     */
    public $image = null;

    /**
     * The bg card background color
     *
     * @var string
     */
    public string $card_bg_color = '';

    /**
     * The bg card title
     *
     * @var string
     */
    public string $title = '';

    /**
     * The bg card content
     *
     * @var string
     */
    public string $desc = '';

    /**
     * The bg card permalink
     *
     * @var string
     */
    public string $permalink = '';

    /**
     * The bg card permalink text
     *
     * @var string
     */
    public string $permalink_text = '';


    public function __construct(array $params)
    {
        $this->image = $params['image'] ?? null;
        $this->card_bg_color = Arrays::get_value_as_string($params, 'card_bg_color');
        $this->title = Arrays::get_value_as_string($params, 'title');
        $this->desc = Arrays::get_value_as_string($params, 'desc');
        $this->permalink = Arrays::get_value_as_string($params, 'permalink');
        $this->permalink_text = Arrays::get_value_as_string($params, 'permalink_text');
    }

    public function render(): void
    {
        $tag = $this->permalink ? 'a' : 'div';
        $attrs = [
            'class' => 'card-bg'
        ];

        if ($this->card_bg_color) {
            $attrs['class'] .= ' card-bg-' . $this->card_bg_color;
        }

        if ($this->permalink) {
            $attrs['href'] = esc_url($this->permalink);
        }

?>
        <<?php echo esc_attr($tag); ?> <?php echo Util::attributes_array_to_string($attrs); // phpcs:ignore 
                                        ?>>
            <div class="card-bg__content">
                <?php
                if ($this->image) {
                ?>
                    <?php Images::safe_image_output($this->image, ['class' => 'card-bg__image']); ?>
                <?php
                }
                ?>
                <div class="card-bg__title"><?php echo $this->title; ?></div>
                <?php echo wp_kses_post(wpautop($this->desc)); ?>
            </div>
            <div class="text-right">
                <span class="button-link"><?php echo $this->permalink_text; ?><i class="button__arrow"></i></span>
            </div>
        </<?php echo esc_attr($tag); ?>>
<?php
    }
}
