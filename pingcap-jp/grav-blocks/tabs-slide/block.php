<?php

use WPUtil\{Arrays};
use WPUtil\Vendor\ACF;

$format = isset($format) && is_array($format) ? $format : ACF::get_sub_field_string('format');
$format_title = isset($format_title) && is_array($format_title) ? $format_title : ACF::get_sub_field_string('format_title');
$sections = isset($sections) && is_array($sections) ? $sections : ACF::get_sub_field_array('sections');
$has_block_title =  ACF::get_sub_field_bool('has_block_title');

if ($sections) {

?>
	<div class="block-inner contain">
		<?php
		if ($has_block_title) {
			echo ACF::get_sub_field_string('block_title');
		}
		?>

		<?php if ($format === 'default') { ?>
			<div class="block-tabs-slide__mobile">
				<?php foreach ($sections as $section) {
					$title = Arrays::get_value_as_string($section, 'title');
					$content = Arrays::get_value_as_string($section, 'content');
				?>
					<div class="block-tabs-slide__content">
						<div class="block-tabs-slide__content-title"><?php echo $title; ?></div>
						<?php echo wp_kses_post(wpautop($content)); ?>
					</div>
				<?php
				}
				?>
			</div>
		<?php } ?>
		<div class="block-tabs-slide__desktop <?php echo $format === 'side' ? 'row' : ''; ?>">
			<div class="block-tabs-slide__menu">
				<?php foreach ($sections as $section) {
					$title = Arrays::get_value_as_string($section, 'title');
					$title_content = Arrays::get_value_as_string($section, 'title_content');
					echo '<div class="block-tabs-slide__tab">';
					if ($format_title === 'title') {
						echo '<div class="block-tabs-slide__tab-title">' . $title . '</div>';
					} else {
						echo $title_content;
					}
					echo '</div>';
				}
				?>
			</div>
			<div class="block-tabs-slide__panel">
				<?php foreach ($sections as $section) {
					$content = Arrays::get_value_as_string($section, 'content');
				?>
					<div class="block-tabs-slide__content">
						<?php echo wp_kses_post(wpautop($content)); ?>
					</div>
				<?php }
				?>
			</div>
		</div>
	</div>
	</div>
<?php

}
