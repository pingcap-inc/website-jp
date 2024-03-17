<?php
add_action('init', function () {
	// remove default WYSIWYG editor from the 'page' post type
	remove_post_type_support('page', 'editor');

	// remove featured image (thumbnail) support from the 'page' post type
	remove_post_type_support('page', 'thumbnail');
});
