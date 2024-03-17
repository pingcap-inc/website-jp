<?php
add_action('init', function () {
	// include all CPTs from the 'post-types' path (exclude files that begin with '_')
	WPUtil\Util::include_all_files(get_template_directory() . '/post-types/*.php', function ($file) {
		return substr(basename($file), 0, 1) !== '_';
	});

	// add the "author" edit field to the case study CPT
	add_post_type_support(PingCAP\Constants\CPT::CASE_STUDY, 'author');
}, 11);
