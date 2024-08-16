<?php

namespace PingCAP\Components\PostsList;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Taxonomy};
use PingCAP\{Components, Constants, CPT, PageLinks};

class PostsListFilter implements IComponent
{
    /**
     * The post type to source banner settings from
     *
     * @var string
     */
    public string $post_type = Constants\CPT::BLOG;



    public function __construct(array $params)
    {
        $this->post_type = Arrays::get_value_as_string($params, 'post_type', Constants\CPT::BLOG);
    }

    protected function getValidPostIds(): array
    {
        $post_ids = get_posts([
            'fields' => 'ids',
            'post_type' => $this->post_type,
            'post_status' => 'publish',
            'posts_per_page' => -1
        ]);

        return $post_ids;
    }

    public function render(): void
    {
        $post_ids = $this->getValidPostIds();
        $tax_params = $post_ids ? ['object_ids' => $post_ids] : [];

        // phpcs:ignore
        $cur_category = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::BLOG_ARCHIVE_FILTER_CATEGORY] ?? ''));
        $cat_options = Taxonomy::get_taxonomy_filter_options(
            Constants\Taxonomies::BLOG_CATEGORY,
            $tax_params
        );

        // phpcs:ignore
        $cur_tag = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::BLOG_ARCHIVE_FILTER_TAG] ?? ''));
        $tag_options = Taxonomy::get_taxonomy_filter_options(
            Constants\Taxonomies::BLOG_TAG,
            $tax_params
        );

        // phpcs:ignore
        $cur_search = sanitize_text_field(wp_unslash($_GET[Constants\QueryParams::BLOG_ARCHIVE_FILTER_SEARCH] ?? ''));

?>
        <div class="posts-list__archive-filters">
            <select class="posts-list__archive-filter-control" name="filter_category" id="filter_category" aria-label="<?php esc_attr_e('Category', Constants\TextDomains::DEFAULT); ?>">
                <option value=""><?php esc_html_e('Filter by Category', Constants\TextDomains::DEFAULT); ?></option>
                <?php
                foreach ($cat_options as $option) {
                    echo $option->render($cur_category); // phpcs:ignore
                }
                ?>
            </select>
            <?php if ($this->post_type !== Constants\CPT::VIDEO && $this->post_type !== Constants\CPT::SLIDES) { ?>
                <select class="posts-list__archive-filter-control" name="filter_tag" id="filter_tag" aria-label="<?php esc_attr_e('Tag', Constants\TextDomains::DEFAULT); ?>">
                    <option value=""><?php esc_html_e('Filter by Tag', Constants\TextDomains::DEFAULT); ?></option>
                    <?php
                    foreach ($tag_options as $option) {
                        echo $option->render($cur_tag); // phpcs:ignore
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
                        'placeholder' => __('検索', Constants\TextDomains::DEFAULT),
                        'value' => $cur_search,
                        'aria-label' => __('検索', Constants\TextDomains::DEFAULT)
                    ],
                    'add_icon_container_attrs' => [
                        'aria-label' => __('検索', Constants\TextDomains::DEFAULT)
                    ],
                ]);
            }
            ?>
        </div>
<?php
    }
}
