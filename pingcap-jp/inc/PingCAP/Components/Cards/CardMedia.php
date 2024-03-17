<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Util, SVG};
use Blueprint\Images;

class CardMedia implements IComponent
{
    /**
     * The media icon image
     *
     * @var null|string|integer|array<string, mixed>
     */
    public $icon_image = null;

    /**
     * The media title
     *
     * @var string
     */
    public string $title = '';

    /**
     * The media content
     *
     * @var string
     */
    public string $content = '';

    /**
     * The media permalink
     *
     * @var string
     */
    public string $permalink = '';

    /**
     * The media permalink text
     *
     * @var string
     */
    public string $permalinkText = '';


    public function __construct(array $params)
    {
        $this->icon_type = Arrays::get_value_as_string($params, 'icon_type');
        $this->icon_image = Arrays::get_value_as_array($params, 'icon_image');
        $this->icon_font = Arrays::get_value_as_string($params, 'icon_font');
        $this->title = Arrays::get_value_as_string($params, 'title');
        $this->content = Arrays::get_value_as_string($params, 'content');
        $this->permalink = Arrays::get_value_as_string($params, 'permalink');
        $this->permalink_text = Arrays::get_value_as_string($params, 'permalink_text');
    }

    public function render(): void
    {
        $container_tag = $this->permalink ? 'a' : 'div';
        $container_attrs = [
            'class' => 'card-media bg-white'
        ];

        if ($this->permalink) {
            $container_attrs['href'] = esc_url($this->permalink);
        }

?>
        <<?php echo esc_attr($container_tag); ?> <?php echo Util::attributes_array_to_string($container_attrs); // phpcs:ignore 
                                                    ?>>
            <?php
            if ($this->icon_type === 'image' && $this->icon_image) {
                Images::safe_image_output($this->icon_image, ['class' => 'card-media__icon-image']);
            }
            ?>

            <?php if ($this->icon_type === 'font' && $this->icon_font) { ?>
                <i class="card-media__icon-font <?php echo $this->icon_font; ?>"></i>
            <?php } ?>

            <div class="card-media__content">
                <h5><?php echo $this->title; ?></h5>
                <p>
                    <?php echo $this->content; ?>
                </p>
                <?php if ($this->permalink_text && $this->permalink) { ?>
                    <object>
                        <a class="button button--secondary" href="<?php echo esc_url($this->permalink); ?>"><?php echo esc_html($this->permalink_text); ?></a>
                    </object>
                <?php } ?>
            </div>
        </<?php echo esc_attr($container_tag); ?>>
<?php
    }
}
