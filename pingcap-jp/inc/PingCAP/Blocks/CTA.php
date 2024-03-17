<?php
namespace PingCAP\Blocks;

use WPUtil\Vendor\ACF;
use WPUtil\Arrays;

abstract class CTA
{
	public static function block_container_attributes_filter($attrs, $block_name)
	{
		if ($block_name !== 'cta') {
			return $attrs;
		}

		$display_type = ACF::get_sub_field_string('display_type', ['default' => 'slim']);

		// add 'data-display-type' attribute
		$attrs['data-display-type'] = $display_type;

		if ($display_type === 'normal') {
			$normal_fields = ACF::get_sub_field_array('normal_fields');
			$columns = Arrays::get_value_as_array($normal_fields, 'columns');

			// add 'data-num-cols' attribute
			$attrs['data-num-cols'] = count($columns);

			// replace the 'block-bg-none' class with 'bg-black'
			if (is_array($attrs['class'])) {
				$attrs['class'] = array_map(
					fn ($class_name) => $class_name === 'block-bg-none' ? 'bg-black' : $class_name,
					$attrs['class']
				);

				$attrs['class'] = str_replace('block-bg-none', 'bg-black', $attrs['class']);
			}
		}

		return $attrs;
	}
}
