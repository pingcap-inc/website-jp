<?php
use PingCAP\Constants;
use PingCAP\Integrations\Lever;

/**
 * Clear the Lever postings cache if the "Theme Options / Integrations" page is
 * being saved and the cache time in minutes value has been set
 */
add_action('acf/save_post', function ($post_id) {
	if ($post_id !== 'options') {
		return;
	}

	// phpcs:ignore
	$acf_values = $_POST['acf'] ?? [];

	if (isset($acf_values['field_' . Constants\ACF::THEME_OPTIONS_INTEGRATIONS_BASE . '_lever_cache_time_minutes'])) {
		Lever::clearCache();
	}
});
