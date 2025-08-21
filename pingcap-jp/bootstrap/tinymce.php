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
		'input' => array(
			'id' => true,
			'type' => true,
			'min' => true,
			'max' => true,
			'step' => true,
			'value' => true,
		),
		'ol' => array(
			'start' => true
		),
		'svg' => array(
			'xmlns' => true,
			'width' => true,
			'height' => true,
			'viewbox' => true,
			'fill' => true,
			'stroke' => true,
			'stroke-width' => true,
			'class' => true,
			'style' => true,
		),
		'path' => array(
			'd' => true,
			'fill' => true,
			'stroke' => true,
			'stroke-width' => true,
			'stroke-dasharray' => true,
			'class' => true,
		),
		'line' => array(
			'x1' => true,
			'x2' => true,
			'y1' => true,
			'y2' => true,
			'fill' => true,
			'stroke' => true,
			'stroke-width' => true,
			'stroke-opacity' => true,
			'stroke-dasharray' => true,
			'class' => true,
		),
		'lineargradient' => array(
			'x1' => true,
			'x2' => true,
			'y1' => true,
			'y2' => true,
			'fill' => true,
			'id' => true,
			'gradientunits' => true,
		),
		'stop' => array(
			'offset' => true,
			'stop-color' => true,
		),
		'rect' => array(
			'x' => true,
			'y' => true,
			'rx' => true,
			'fill' => true,
			'width' => true,
			'height' => true,
			'stroke' => true,
			'class' => true,
		),
		'filter' => array(
			'x' => true,
			'y' => true,
			'id' => true,
			'filterunits' => true,
			'width' => true,
			'height' => true,
			'color-interpolation-filters' => true,
			'class' => true,
		),
		'feflood' => array(
			'flood-opacity' => true,
			'result' => true,
		),
		'fecolormatrix' => array(
			'in' => true,
			'type' => true,
			'values' => true,
			'result' => true,
		),
		'femorphology' => array(
			'in' => true,
			'radius' => true,
			'operator' => true,
			'result' => true,
		),
		'feoffset' => array(
			'id' => true,
		),
		'fegaussianblur' => array(
			'stddeviation' => true,
		),
		'fecomposite' => array(
			'in2' => true,
			'operator' => true,
		),
		'feblend' => array(
			'id' => true,
			'in' => true,
			'in2' => true,
			'mode' => true,
			'result' => true,
		),
		'g' => array(
			'class' => true,
			'filter' => true,
			'mask' => true,
		),
		'defs' => array(
			'class' => true,
			'filter' => true,
		),
		'use' => array(
			'xlink:href' => true,
			'transform' => true,
		),
		'select' => array(
			'name' => true
		),
		'option' => array(
			'value' => true
		),
		'embed' => array(
			'type' => true,
			'src' => true
		),
		'pattern' => array(
			'id' => true,
			'patterncontentunits' => true,
			'width' => true,
			'height' => true,
		),
		'image' => array(
			'id' => true,
			'xlink:href' => true,
			'width' => true,
			'height' => true,
		),
		'mask' => array(
			'id' => true,
			'style' => true,
			'width' => true,
			'height' => true,
			'x' => true,
			'y' => true,
			'maskunits' => true,
		)
	)
);

WPUtil\TinyMCE::set_allowed_protocols(array(
	'data'
));
