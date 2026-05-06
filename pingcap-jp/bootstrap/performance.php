<?php
WPUtil\Performance::remove_emojicon_support();
WPUtil\Performance::remove_jquery_migrate();
// WPUtil\Performance::move_jquery_to_footer();

// Preload homepage hero video poster (LCP candidate when banner is in video mode).
// Keep URL in sync with BannerHome.php poster attribute.
add_action('wp_head', function () {
    if (!is_front_page() && !is_page_template('templates/page-home.php')) {
        return;
    }
    if (!\WPUtil\Vendor\ACF::get_field_bool('banner_home_is_video', get_queried_object_id())) {
        return;
    }
    echo '<link rel="preload" as="image" fetchpriority="high" href="https://static.pingcap.co.jp/files/2026/04/27194212/20260424-144302.jpeg">' . "\n";
}, 1);
