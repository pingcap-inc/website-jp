<?php

use PingCAP\Components;
use WPUtil\{Component, Vendor};

get_header();

Component::render(Components\Banners\BannerHome::class);

?>
<main class="tmpl-front-page">
	<?php Vendor\BlueprintBlocks::safe_display(); ?>
</main>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<?php

get_footer();
