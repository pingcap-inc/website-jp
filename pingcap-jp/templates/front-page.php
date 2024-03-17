<?php

use PingCAP\Components;
use WPUtil\{Arrays, Component, Vendor};
use Blueprint\Images;

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();

?>
		<main class="tmpl-front-page">
			<div class="tmpl-front-page__scroll-container">
				<?php
				Component::render(Components\Banners\BannerHome::class, []);
				?>
			</div>
		</main>
<?php

		Vendor\BlueprintBlocks::safe_display();
	}
}

get_footer();
