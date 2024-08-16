<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays};
use WPUtil\Vendor\{ACF, BlueprintBlocks};
use Blueprint\Images;
use PingCAP\{CPT};

class CardSlides implements IComponent
{
    public int $post_id = 0;
    public bool $is_featured = false;
    public $slides_image = null;
    public string $category = '';
    public string $title = '';
    public string $slides_title = '';
    public string $slides_url = '';
    public string $slides_content = '';

    public function __construct(array $params)
    {
        $this->post_id = Arrays::get_value_as_int($params, 'post_id', fn() => get_the_ID());
        $this->slides_image = Arrays::get_value_as_array($params, 'slides_image', fn() => ACF::get_field_array('slides_image', $this->post_id));
        $this->category = Arrays::get_value_as_string($params, 'category', fn() => CPT\Slides::getPostCategoryText($this->post_id));
        $this->title = Arrays::get_value_as_string($params, 'title', fn() => get_the_title($this->post_id));
        $this->slides_content = Arrays::get_value_as_string($params, 'slides_content', fn() => ACF::get_field_string('slides_content', $this->post_id));
        $this->slides_url = Arrays::get_value_as_string($params, 'slides_url', fn() => BlueprintBlocks::get_button_field_values('slides_url', $this->post_id)->link);
    }

    public function render(): void
    {
?>
        <div class="card-slides">
            <a class="card-slides__image-container" href="<?php echo esc_url($this->slides_url); ?>">
                <?php
                Images::safe_image_output($this->slides_image, ['class' => 'card-slides__image']);
                ?>
            </a>
            <div class="card-slides__category"><?php echo $this->category; ?></div>
            <h5 class="card-slides__title"><a  href="<?php echo esc_url($this->slides_url); ?>"><?php echo $this->title; ?></a></h5>
            <a class="button button--secondary" href="<?php echo esc_url($this->slides_url); ?>">Read Now</a>
        </div>
<?php
    }
}
