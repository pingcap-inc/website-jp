<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Util};
use Blueprint\Images;
use PingCAP\{CPT};

class CardBlog implements IComponent
{
    /**
     * The post id
     *
     * @var integer
     */
    public int $post_id = 0;

    /**
     * The post category
     *
     * @var string
     */
    public string $category = '';

    /**
     * The post title
     *
     * @var string
     */
    public string $title = '';

    /**
     * The post permalink
     *
     * @var string
     */
    public string $permalink = '';

    /**
     * The post featured image
     *
     * @var null|string|integer|array<string, mixed>
     */
    public $image = null;

    /**
     * Flag indicating that this is a featured resource post card
     *
     * @var boolean
     */
    public bool $is_featured = false;

    /**
     * Additional container classnames
     *
     * @var array<string>
     */
    public array $add_container_classes = [];

    /**
     * Additional container tag attributes
     *
     * @var array<string, string>
     */
    public array $add_container_attrs = [];


    public function __construct(array $params)
    {
        $this->post_id = Arrays::get_value_as_int($params, 'post_id', fn() => get_the_ID());
        $this->author_id = get_post_field('post_author', $this->post_id);
        $this->date = Arrays::get_value_as_string($params, 'date', fn() => get_the_time('F j, Y', $this->post_id));
        $this->category = Arrays::get_value_as_string($params, 'category');
        $this->title = Arrays::get_value_as_string($params, 'title', fn() => get_the_title($this->post_id));
        $this->permalink = Arrays::get_value_as_string($params, 'permalink', fn() => get_the_permalink($this->post_id));
        $this->image = $params['image'] ?? get_post_thumbnail_id($this->post_id);
        $this->is_featured = Arrays::get_value_as_bool($params, 'is_featured', false);
        $this->add_container_classes = Arrays::get_value_as_array($params, 'add_container_classes');
        $this->add_container_attrs = Arrays::get_value_as_array($params, 'add_container_attrs');

        if (!$this->category) {
            $this->category = CPT\Blog::getPostCategoryText($this->post_id);
        }

        if (!$this->image) {
            if (isset($params['default_image'])) {
                $this->image = $params['default_image'];
            } else {
                $this->image = CPT\Blog::getDefaultCardImage();
            }
        }

        if ($this->is_featured) {
            $this->image = ['url' => $this->get_yoast_social_image($this->post_id)];
        }
    }

    protected function get_yoast_social_image($post_id = null)
    {
        if (empty($post_id)) {
            $post_id = get_the_ID();
        }

        if (!$post_id) {
            return '';
        }

        // First try to get the specific Facebook image
        $fb_image = get_post_meta($post_id, '_yoast_wpseo_opengraph-image', true);
        if (!empty($fb_image)) {
            return $fb_image;
        }

        // If no Facebook image, try Twitter image
        $twitter_image = get_post_meta($post_id, '_yoast_wpseo_twitter-image', true);
        if (!empty($twitter_image)) {
            return $twitter_image;
        }

        // If no specific social images, get the default Yoast SEO image
        $default_image = get_post_meta($post_id, '_yoast_wpseo_metadesc', true);

        // If still no image, try to get the featured image
        if (empty($default_image) && has_post_thumbnail($post_id)) {
            $featured_img_url = get_the_post_thumbnail_url($post_id, 'full');
            return $featured_img_url;
        }

        return '';
    }

    public function render(): void
    {
        $container_classes = array_merge(
            ['card-blog'],
            $this->add_container_classes
        );

        if ($this->is_featured) {
            $container_classes[] = 'card-blog--featured';
        }

        $container_attrs = array_merge([
            'class' => esc_attr(implode(' ', $container_classes)),
            'href' => esc_url($this->permalink)
        ], $this->add_container_attrs);

?>
        <a <?php echo Util::attributes_array_to_string($container_attrs); ?>>
            <?php
            $image_params = [
                'class' => 'card-blog__image',
                'data-lazy-ignore' => $this->is_featured
            ];
            if ($this->image) {
            ?>
                <div class="card-blog__image-container">
                    <?php Images::safe_image_output($this->image, $image_params); ?>
                </div>
            <?php
            }
            ?>
            <div class="card-blog__content-container">
                <div>
                    <div class="card-blog__content-head">
                        <?php
                        if ($this->category) {
                        ?>
                            <div class="card-blog__category"><?php echo esc_html($this->category); ?></div>
                        <?php
                        }
                        ?>
                        <?php
                        if (!$this->is_featured) {
                        ?>
                            <div class="card-blog__date"><?php echo esc_html($this->date); ?></div>
                        <?php
                        }
                        ?>
                    </div>

                    <h5 class="card-blog__title"><?php echo esc_html($this->title); ?></h5>
                </div>

                <div class="card-blog__footer">
                    <div class="card-blog__author">
                        <img src="<?php echo get_avatar_url($this->author_id); ?>" />
                        <div><?php echo get_the_author_meta('display_name', $this->author_id); ?></div>
                    </div>
                    <?php if ($this->is_featured) { ?>
                        <div class="card-blog__date"><?php echo esc_html($this->date); ?></div>
                    <?php } ?>
                </div>
            </div>
        </a>
<?php
    }
}
