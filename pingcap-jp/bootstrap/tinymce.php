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
			'style' => true,
			'checked' => true,
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
			'id' => true,
			'd' => true,
			'fill' => true,
			'opacity' => true,
			'clip-path' => true,
			'stroke' => true,
			'stroke-width' => true,
			'stroke-dasharray' => true,
			'stroke-dashoffset' => true,
			'stroke-linecap' => true,
			'stroke-linejoin' => true,
			'class' => true,
		),
		'line' => array(
			'x1' => true,
			'x2' => true,
			'y1' => true,
			'y2' => true,
			'fill' => true,
			'opacity' => true,
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
		'text' => array(
			'x' => true,
			'y' => true,
			'dx' => true,
			'dy' => true,
			'fill' => true,
			'opacity' => true,
			'font-size' => true,
			'font-weight' => true,
			'font-family' => true,
			'text-anchor' => true,
			'class' => true,
			'style' => true,
		),
		'tspan' => array(
			'x' => true,
			'y' => true,
			'dx' => true,
			'dy' => true,
			'fill' => true,
			'class' => true,
		),
		'circle' => array(
			'cx' => true,
			'cy' => true,
			'r' => true,
			'fill' => true,
			'opacity' => true,
			'stroke' => true,
			'stroke-width' => true,
			'class' => true,
		),
		'ellipse' => array(
			'cx' => true,
			'cy' => true,
			'rx' => true,
			'ry' => true,
			'fill' => true,
			'opacity' => true,
			'stroke' => true,
			'stroke-width' => true,
			'class' => true,
		),
		'polyline' => array(
			'points' => true,
			'fill' => true,
			'opacity' => true,
			'stroke' => true,
			'stroke-width' => true,
			'class' => true,
		),
		'polygon' => array(
			'points' => true,
			'fill' => true,
			'opacity' => true,
			'stroke' => true,
			'stroke-width' => true,
			'class' => true,
		),
		'animate' => array(
			'attributename' => true,
			'values' => true,
			'keytimes' => true,
			'dur' => true,
			'repeatcount' => true,
			'begin' => true,
			'fill' => true,
			'from' => true,
			'to' => true,
		),
		'animatetransform' => array(
			'attributename' => true,
			'type' => true,
			'values' => true,
			'dur' => true,
			'repeatcount' => true,
			'begin' => true,
			'fill' => true,
			'from' => true,
			'to' => true,
		),
		'rect' => array(
			'x' => true,
			'y' => true,
			'rx' => true,
			'ry' => true,
			'fill' => true,
			'fill-opacity' => true,
			'opacity' => true,
			'width' => true,
			'height' => true,
			'stroke' => true,
			'stroke-width' => true,
			'stroke-opacity' => true,
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
			'id' => true,
			'class' => true,
			'style' => true,
			'fill' => true,
			'stroke' => true,
			'stroke-width' => true,
			'opacity' => true,
			'transform' => true,
			'clip-path' => true,
			'filter' => true,
			'mask' => true,
		),
		'clippath' => array(
			'id' => true,
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
		),
		'dotlottie-player' => array(
			'src' => true,
			'background' => true,
			'speed' => true,
			'direction' => true,
			'playMode' => true,
			'loop' => true,
			'autoplay' => true
		)
	)
);

WPUtil\TinyMCE::set_allowed_protocols(array(
	'data'
));
