<?php

namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants};

// phpcs:disable WordPress.Security.NonceVerification.Recommended

class PostsListEbookWhitepaper implements IComponent
{
    /**
     * The WP_Query object
     *
     * @var WP_Query|null
     */
    public $wp_query_obj = null;

    /**
     * Flag indicating that the posts list will be displayed in a block. Adds the
     * "posts-list--block" class to the container element.
     *
     * @var bool
     */
    public bool $block_display = false;

    /**
     * The current results page number
     *
     * @var int
     */
    public int $current_page = 1;

    /**
     * The message shown when there are no results to display
     *
     * @var string
     */
    public string $no_results_message = '';

    /**
     * The featured post ID
     *
     * @var integer
     */
    public int $featured_id = 0;

    /**
     * The WordPress REST API endpoint to add as the "data-endpoint" attribute
     * on the cards container
     *
     * @var string
     */
    public string $api_endpoint = 'wp/v2/posts';

    /**
     * The card component class name
     *
     * @var string
     */
    public string $card_component = Components\Cards\CardResource::class;


    public function __construct(array $params)
    {
        $this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_obj'], 'WP_Query') ? $params['wp_query_obj'] : null;
        $this->block_display = Arrays::get_value_as_bool($params, 'block_display');
        $this->current_page = Arrays::get_value_as_int($params, 'current_page', 1);
        $this->no_results_message = Arrays::get_value_as_string($params, 'no_results_message', function () {
            return ACF::get_field_string(
                Constants\ACF::BLOG_SETTINGS_BASE . '_no_results_message',
                'option',
                [
                    'default' => Constants\DefaultValues::ARCHIVE_NO_RESULTS_MESSAGE
                ]
            );
        });
        $this->featured_id = Arrays::get_value_as_int($params, 'featured_id');
        $this->api_endpoint = Arrays::get_value_as_string($params, 'api_endpoint', 'wp/v2/ebook-whitepaper');
        $this->card_component = Arrays::get_value_as_string($params, 'card_component', Components\Cards\CardResource::class);
        $this->filter_render_functions = Arrays::get_value_as_array($params, 'filter_render_functions');
    }

    public function render(): void
    {
        if (!$this->wp_query_obj || !$this->card_component) {
            return;
        }

        $container_classes = ['posts-list', 'posts-list-ebook-whitepaper'];

        if ($this->block_display) {
            $container_classes[] = 'posts-list--block';
        }

?>
        <div class="<?php echo esc_attr(implode(' ', $container_classes)); ?>">
            <?php
            if ($this->featured_id) {
                $row_classses = ['posts-list__row-featured', 'contain'];

            ?>
                <div class="<?php echo esc_attr(implode(' ', $row_classses)); ?>">
                    <?php
                    $params = [
                        'post_id' => $this->featured_id,
                        'is_featured' => true,
                        'post_type' => $this->post_type
                    ];

                    if (is_callable($this->featured_render_params_callback)) {
                        $func = $this->featured_render_params_callback;
                        $params = $func($params, $this->featured_id);
                    }

                    Component::render($this->card_component, $params);
                    ?>
                </div>
            <?php
            }

            if ($this->filter_render_functions) {
            ?>
                <div class="posts-list__row-filters contain">
                    <?php
                    foreach ($this->filter_render_functions as $filter_render_func) {
                    ?>
                        <div class="posts-list__filter">
                            <?php
                            if (is_callable($filter_render_func)) {
                                $filter_render_func();
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }

            $total_pages = intval($this->wp_query_obj->max_num_pages ?? 1);
            $posts_per_page = intval($this->wp_query_obj->query_vars['posts_per_page'] ?? get_option('posts_per_page'));

            $no_results_classes = [
                'posts-list__no-results-container',
                'layout__padded-columns',
                'text-center'
            ];

            if ($this->wp_query_obj->posts) {
                $no_results_classes[] = 'hide';
            }

            ?>
            <div class="posts-list__cards-container contain" data-load-more-target data-current-page="<?php echo esc_attr($this->current_page); ?>" data-total-pages="<?php echo esc_attr($total_pages); ?>" data-posts-per-page="<?php echo esc_attr($posts_per_page); ?>" <?php if ($this->add_card_container_attrs) {
                                                                                                                                                                                                                                                                                echo Util::attributes_array_to_string($this->add_card_container_attrs);
                                                                                                                                                                                                                                                                            } // phpcs:ignore 
                                                                                                                                                                                                                                                                            ?>>
            </div>
            <div class="<?php echo esc_attr(implode(' ', $no_results_classes)); ?>" data-no-results-container>
                <h4><?php echo esc_html($this->no_results_message); ?></h4>
            </div>
            <div class="posts-list__loader-container hide">
                <span class="posts-list__loader-spinner"></span>
            </div>
        </div>
<?php
    }
}
