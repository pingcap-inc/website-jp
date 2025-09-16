<?php

/**
 * Template Name: Pillar Page
 */

use PingCAP\Components;
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerDefault::class);
?>

<main class="tmpl-pillar">
    <div class="contain">
        <div class="tmpl-pillar-container">
            <aside id="toc">
            </aside>
            <article class="tmpl-pillar-content">
                <h2 style="position: relative; top: 0px; height: 0px;visibility: hidden;">Introduction</h2>
                <?php Vendor\BlueprintBlocks::safe_display(); ?>
            </article>
        </div>
    </div>

</main>

<?php

get_footer();
