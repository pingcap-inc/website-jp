<?php
/*
Template Name: AI Page
*/

use PingCAP\Components;
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerDefault::class);

?>
<main class="tmpl-ai-page">
	<?php Vendor\BlueprintBlocks::safe_display(); ?>
</main>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<?php

get_footer();
