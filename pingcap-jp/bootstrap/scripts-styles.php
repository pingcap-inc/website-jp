<?php

/**
 * JavaScript enqueue
 */
WPUtil\Scripts::enqueue_scripts([
	'master_js' => [
		'url' => load_assets_from_manifest('master.js'),
		'deps' => [],
		'defer' => true,
		'preload_hook' => 'global_head_top_content',
		'localize' => [
			'name' => 'siteConfig',
			'data' => [
				'apiSettings' => [
					'base' => esc_url_raw(rest_url()),
					'nonce' => is_user_logged_in() ? wp_create_nonce('wp_rest') : ''
				],
				'prism' => [
					'assetBase' => get_template_directory_uri() . '/prism-js',
					'availableLanguages' => array_map(
						fn($filename) => str_ireplace('prism-', '', basename($filename, '.min.js')),
						glob(get_template_directory() . '/prism-js/languages/*.min.js')
					),
					'availableThemes' => array_map(
						fn($filename) => basename($filename, '.min.css'),
						glob(get_template_directory() . '/prism-js/themes/*.min.css')
					),
					'availablePlugins' => array_map(
						fn($filename) => str_ireplace('prism-', '', basename($filename, '.min.js')),
						glob(get_template_directory() . '/prism-js/plugins/*.min.js')
					),
				]
			]
		]
	]
]);


/**
 * CSS enqueue
 */
WPUtil\Styles::enqueue_styles([
	'master_css' => [
		'url' => load_assets_from_manifest('css/master.scss'),
		'preload_hook' => 'global_head_top_content'
	],
	'icon_css' => [
		'url' => get_template_directory_uri() . '/dist/css/phosphor-icons.min.css',
		'preload_hook' => 'global_head_top_content'
	]
]);

/**
 * Dequeue the "wp-block-library" styles on all page requests other than singular
 * post types that need it
 */
add_action('wp_enqueue_scripts', function () {
	if (is_singular([
		PingCAP\Constants\CPT::BLOG,
		PingCAP\Constants\CPT::EBOOK_WHITEPAPER,
		PingCAP\Constants\CPT::TRAINING,
		PingCAP\Constants\CPT::EVENT,
		PingCAP\Constants\CPT::CASE_STUDY,
		PingCAP\Constants\CPT::COMMUNITY_ACTIVITY,
		PingCAP\Constants\CPT::PRESS_RELEASE,
		PingCAP\Constants\CPT::VIDEO
	]) || is_page_template('templates/page-tidb-user-day-2025.php')) {

		wp_enqueue_style('viewer-css', 'https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.7/viewer.css');

		return;
	}

	wp_dequeue_style('wp-block-library');
}, 20);

add_action('wp_enqueue_scripts', function () {
	wp_register_style('cost-estimation-css', get_template_directory_uri() . '/cost-estimation/widget-DeVV1i0I.css', [], null);
	wp_register_script(
		'cost-estimation-js',
		get_template_directory_uri() . '/cost-estimation/widget-Cl2gQPj5.js',
		[],
		null,
		true
	);
	// wp_register_style('cost-estimation-css', 'https://static.pingcap.com/cost-estimation/widget-C3rzkZzz.css', [], null);
	// wp_register_script(
	// 	'cost-estimation-js',
	// 	'https://static.pingcap.com/cost-estimation/widget-DOKu5ylC.js',
	// 	[],
	// 	null,
	// 	true
	// );
});
