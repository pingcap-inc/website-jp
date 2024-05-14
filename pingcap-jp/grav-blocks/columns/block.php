<?php

use WPUtil\Vendor\ACF;
use WPUtil\{Arrays, Component};
use Blueprint\Images;
use PingCAP\Components;
use PingCAP\Models\AccordionSection;

$format = isset($format) && is_string($format) ? $format : ACF::get_sub_field_string('format');
$columns = isset($columns) && is_array($columns) ? $columns : ACF::get_sub_field_array('columns');
$column_num = isset($column_num) && is_string($column_num) ? $column_num : ACF::get_sub_field_string('column_num');

if ($columns) {
	$block_inner_classes = [
		'block-inner',
		'contain',
		'grid',
		'is-' . $column_num
	];

	$box_container = count($columns) <= 2 ? ACF::get_sub_field_int('enable_box_container', ['default' => 0]) : 0;

	if ($box_container) {
		$block_inner_classes[] = 'block-inner--has-box-container';
	}

	$block_inner_attrs = [
		'class' => implode(' ', $block_inner_classes),
		'data-num-col' => count($columns),
		'data-format' => $format
	];

?>
	<div <?php echo WPUtil\Util::attributes_array_to_string($block_inner_attrs); // phpcs:ignore 
			?>>
		<?php
		foreach ($columns as $column) {
			$col_type = Arrays::get_value_as_string($column, 'type');
			$col_classes = ['block-columns__column', 'wysiwyg'];

			if ($box_container) {
				$col_classes[] = 'bg-white';
			}

		?>
			<div class="<?php echo esc_attr(implode(' ', $col_classes)); ?>">
				<?php
				switch ($col_type) {
					case 'wysiwyg':
						$wysiwyg_content = Arrays::get_value_as_string($column, 'wysiwyg');

						echo wp_kses_post(wpautop($wysiwyg_content));
						break;

					case 'accordion':
						$col_title = Arrays::get_value_as_string($column, 'accordion_column_title');
						$sections = array_map(fn ($section) => new AccordionSection(
							Arrays::get_value_as_string($section, 'section_title'),
							Arrays::get_value_as_string($section, 'section_content')
						), Arrays::get_value_as_array($column, 'accordion_sections'));

						if ($col_title) {
				?>
							<h2><?php echo esc_html($col_title); ?></h2>
						<?php
						}

						Component::render(Components\UI\Accordion::class, [
							'sections' => $sections,
							'open_first_section' => false
						]);

						break;

					case 'video':
						$video_image = Arrays::get_value_as_array($column, 'video_image');
						$video_url = Arrays::get_value_as_string($column, 'video_url');
						$video_content = Arrays::get_value_as_string($column, 'video_content');

						if ($video_image && $video_url) {
						?>
							<a class="block-columns__video-container js--trigger-video-modal ignore-link-styles" href="<?php echo esc_url($video_url); ?>">
								<?php
								Images::safe_image_output($video_image, ['class' => 'block-columns__video-image']);

								do_action('grav_blocks_get_video_link_button');
								?>
							</a>
				<?php
						}

						if ($video_content) {
							echo wp_kses_post($video_content);
						}

						break;

					default:
						break;
				}
				?>
			</div>
		<?php
		}
		?>
	</div>
<?php
}
