<?php

use WPUtil\Vendor\ACF;
use PingCAP\{Constants, Posts};

add_filter('algolia_post_shared_attributes', 'my_post_attributes', 10, 2);
add_filter('algolia_searchable_post_shared_attributes', 'my_post_attributes', 10, 2);

/**
 * @param array   $attributes
 * @param WP_Post $post
 *
 * @return array
 */
function my_post_attributes(array $attributes, WP_Post $post)
{
    if ($post->post_type === Constants\CPT::BLOG) {
        $attributes['display_region'] = ACF::get_field_array('display_region',  $post->ID, ['default' => ['apac', 'emea', 'na']]);
        $attributes['post_tag'] = Posts::getPostTagsData($post->ID);
        $attributes['post_category'] = Posts::getPostCategoryData($post->ID);
        $author_id = get_post_field('post_author', $post->ID);
        $attributes['author_avatar_url'] = get_avatar_url($author_id);
        return $attributes;
    }

    return $attributes;
}

add_filter('algolia_should_index_post', function ($should_index, WP_Post $post) {
    if (false === $should_index) {
        return false;
    }
    $exclude_ids = get_option("unlist_posts", array());
    return !in_array($post->ID, $exclude_ids);
}, 10, 2);
