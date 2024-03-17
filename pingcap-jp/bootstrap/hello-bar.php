<?php
add_filter('hello_bar_fields_settings', function ($fields) {
	$unused_settings = [
		'hello_bar_position',
		'hello_bar_icon'
	];

	$fields = array_filter($fields, fn ($field) => !in_array($field['key'], $unused_settings, true));

	return $fields;
});

add_filter('hello_bar_colors', function ($colors) {
	return [
		'hellobar--blue' => 'Blue'
	];
});

add_filter('hello_bar_position', function ($position) {
	return 'bottom';
});
