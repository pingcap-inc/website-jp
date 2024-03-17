<?php
namespace PingCAP;

abstract class Stats
{
	public static function getACFfields($prefix = '', $include_animate_fields = true): array
	{
		$fields = [];

		$fields[] = array (
			'key' => 'field_' . $prefix . '_stat_color',
			'label' => 'Color',
			'name' => 'color',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'' => 'Blue',
				'dark' => 'Dark Blue',
				'xdark' => 'Extra Dark Blue'
			),
			'default_value' => '',
			'allow_null' => 0,
			'multiple' => 0,         // allows for multi-select
			'ui' => 0,               // creates a more stylized UI
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		);

		if ($include_animate_fields) {
			$fields[] = array (
				'key' => 'field_' . $prefix . '_stat_number_start',
				'label' => 'Start at number',
				'name' => 'number_start',
				'type' => 'number',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 0,
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			);
		}

		$fields[] = array (
			'key' => 'field_' . $prefix . '_stat_number_end',
			'label' => $include_animate_fields ? 'End at number' : 'Number',
			'name' => 'number_end',
			'type' => 'number',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => $include_animate_fields ? '50' : '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 1,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		);

		if ($include_animate_fields) {
			$fields[] = array (
				'key' => 'field_' . $prefix . '_stat_number_interval',
				'label' => 'Interval',
				'name' => 'number_interval',
				'type' => 'number',
				'instructions' => 'Control how much the value is increased on each update',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => 1,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			);

			$fields[] = array (
				'key' => 'field_' . $prefix . '_stat_delay',
				'label' => 'Delay (in ms)',
				'name' => 'delay',
				'type' => 'number',
				'instructions' => 'Control the speed at which the value is updated',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => 50,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => '',
				'readonly' => 0,
				'disabled' => 0,
			);
		}

		$fields[] = array (
			'key' => 'field_' . $prefix . '_stat_number_prepend',
			'label' => 'Prepend number content',
			'name' => 'number_prepend',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'formatting' => 'none',       // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		);

		$fields[] = array (
			'key' => 'field_' . $prefix . '_stat_number_append',
			'label' => 'Append number content',
			'name' => 'number_append',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'formatting' => 'none',       // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		);

		$fields[] = array (
			'key' => 'field_' . $prefix . '_stat_text',
			'label' => 'Text',
			'name' => 'text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'formatting' => 'none', // none | html
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		);

		return $fields;
	}
}
