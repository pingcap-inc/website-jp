<?php

namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Taxonomy, Content};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants, CPT};

// phpcs:disable WordPress.Security.NonceVerification.Recommended

class PostsListEvent implements IComponent
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
     * The featured post ID
     *
     * @var integer
     */
    public int $featured_id = 0;

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
     * An array of WP_Term objects representing "orphaned" customer terms
     * that aren't used by any case study posts
     *
     * @var array<\WP_Term>
     */
    public array $orphaned_customer_terms = [];


    public function __construct(array $params)
    {
        $this->wp_query_obj = isset($params['wp_query_obj']) && is_a($params['wp_query_obj'], 'WP_Query') ? $params['wp_query_obj'] : null;
        $this->block_display = Arrays::get_value_as_bool($params, 'block_display');
        $this->featured_id = Arrays::get_value_as_int($params, 'featured_id');
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
    }

    protected function getValidPostIds(): array
    {
        $post_ids = get_posts([
            'fields' => 'ids',
            'post_type' => Constants\CPT::EVENT,
            'post_status' => 'publish',
            'posts_per_page' => -1
        ]);

        return $post_ids;
    }

    public function render(): void
    {
?>
        <div class="posts-list-event__overflow-container">
            <?php
            Component::render(Components\PostsList\PostsList::class, [
                'wp_query_obj' => $this->wp_query_obj,
                'card_component' => Components\Cards\CardEvent::class,
                'block_display' => $this->block_display,
                'featured_id' => $this->featured_id,
                'add_container_classes' => ['posts-list-event'],
                'add_card_container_attrs' => ['data-endpoint' => 'wp/v2/event'],
                'current_page' => $this->current_page,
                'no_results_message' => $this->no_results_message,
                'filter_render_functions' => [function () {
                    $post_ids = $this->getValidPostIds();
                    $tax_params = $post_ids ? ['object_ids' => $post_ids, 'order' => 'DESC'] : [];

                    $cur_location = CPT\Event::getLocationQueryParamValue();

                    $cur_region = CPT\Event::getRegionQueryParamValue();
                    $region_options = Taxonomy::get_taxonomy_filter_options(
                        Constants\Taxonomies::REGION,
                        $tax_params
                    );

                    $cur_search = CPT\Event::getSearchQueryParamValue();
            ?>
                <div class="posts-list__archive-filters">
                    <select class="posts-list__archive-filter-control" name="filter_location" id="filter_location" aria-label="<?php esc_attr_e('Location', Constants\TextDomains::DEFAULT); ?>">
                        <option value=""><?php esc_html_e('Filter by Event Type', Constants\TextDomains::DEFAULT); ?></option>
                        <option value="in-person" <?php echo $cur_location === 'in-person' ? 'selected' : ''; ?>>In-Person</option>
                        <option value="virtual" <?php echo $cur_location === 'virtual' ? 'selected' : ''; ?>>Virtual</option>
                        <option value="hybrid" <?php echo $cur_location === 'hybrid' ? 'selected' : ''; ?>>Hybrid</option>
                    </select>
                    <select class="banner-case-study-archive__filter-control" name="filter_region" id="filter_region" aria-label="<?php esc_attr_e('Region', Constants\TextDomains::DEFAULT); ?>">
                        <option value=""><?php esc_html_e('Filter by Region', Constants\TextDomains::DEFAULT); ?></option>
                        <?php
                        foreach ($region_options as $option) {
                            echo $option->render($cur_region); // phpcs:ignore
                        }
                        ?>
                    </select>
                    <?php
                    Component::render(Components\UI\InputWithIcon::class, [
                        'is_form' => true,
                        'add_container_attrs' => [
                            'id' => 'form_filter_search'
                        ],
                        'add_container_classes' => [
                            'posts-list__archive-filter-control'
                        ],
                        'add_input_attrs' => [
                            'id' => 'filter_search',
                            'name' => 'filter_search',
                            'placeholder' => __('Search', Constants\TextDomains::DEFAULT),
                            'value' => $cur_search,
                            'aria-label' => __('Search text', Constants\TextDomains::DEFAULT)
                        ],
                        'add_icon_container_attrs' => [
                            'aria-label' => __('Search', Constants\TextDomains::DEFAULT)
                        ],
                    ]);
                    ?>
                </div>
            <?php
                }]
            ]);
            ?>
        </div>
<?php
    }
}
