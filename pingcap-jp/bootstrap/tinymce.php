<?php
add_editor_style('/dist/css/editor-styles.min.css');

WPUtil\TinyMCE::add_formats(array(
	array(
		'title' => 'Button (Primary)',
		'selector' => 'a',
		'classes' => 'button'
	),
	array(
		'title' => 'Button (Secondary)',
		'selector' => 'a',
		'classes' => 'button button--secondary'
	)
));

WPUtil\TinyMCE::set_options(array(
	'paste_as_text' => true
));

WPUtil\TinyMCE::set_allowed_tags(
	array(
		'svg' => array(
			'viewbox' => true,
			'xmlns' => true,
			'xmlns:xlink' => true,
			'xml:space' => true,
			'version' => true,
			'x' => true,
			'y' => true,
			'class' => true,
			'fill' => true
		),
		'use' => array(
			'xlink:href' => true,
		),
		'select' => array(
			'name' => true
		),
		'option' => array(
			'value' => true
		)
	)
);

WPUtil\TinyMCE::set_allowed_protocols(array(
	'data'
));
