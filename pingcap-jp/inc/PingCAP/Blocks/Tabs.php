<?php

namespace PingCAP\Blocks;

use WPUtil\Arrays;
use Blueprint\Images;
use GRAV_BLOCKS;

abstract class Tabs
{
	/**
	 * Create the section id string from the given section index
	 *
	 * @param integer $section_index
	 * @return string
	 */
	public static function getSectionId(int $section_index): string
	{
		return 'tabs_section_' . GRAV_BLOCKS::$block_index . '_' . $section_index;
	}

	/**
	 * Render an entire section
	 *
	 * @param array $values
	 * @param bool $show_title
	 * @return void
	 */
	public static function renderSection(array $values, string $section_key = '', bool $show_title = true, bool $column = false, string $column_num)
	{
		$title = Arrays::get_value_as_string($values, 'title');
		$image = Arrays::get_value_as_array($values, 'image');
		$content = Arrays::get_value_as_string($values, 'content');

		$top_classes = ['block-tabs__section-top'];

		if (!$column && $image) {
			$top_classes[] = 'block-tabs__section-top--has-image';
		}

		if ($column && $column_num) {
			$top_classes[] = 'is-' . $column_num;
		}

?>
		<div class="<?php echo esc_attr(implode(' ', $top_classes)); ?>" data-section-id=<?php echo $section_key ?>>
			<div class="block-tabs__section-top-content wysiwyg">
				<?php
				if (!$column && $show_title && $title) {
				?>
					<h2 class="block-tabs__section-title"><?php echo $title; ?></h2>
				<?php
				}
				?>
				<?php echo wp_kses_post(wpautop($content)); ?>
			</div>
			<?php
			if (!$column && $image) {
				Images::safe_image_output($image, [
					'class' => 'block-tabs__image',
					'data-ib-no-cache' => 1
				]);
			}
			?>
		</div>
<?php
	}

	/**
	 * Render an entire section and return a string
	 *
	 * @param array $values
	 * @param bool $show_title
	 * @return string
	 */
	public static function renderSectionToString(array $values, bool $show_title = true): string
	{
		ob_start();

		self::renderSection($values, '', $show_title, false, '');

		return ob_get_clean();
	}
}
