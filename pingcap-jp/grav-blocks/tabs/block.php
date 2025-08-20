<?php

use WPUtil\{Arrays, Component, SVG};
use WPUtil\Vendor\ACF;
use PingCAP\Components;
use PingCAP\Models\AccordionSection;
use PingCAP\Blocks\Tabs;
use Blueprint\Images;

$sections = isset($sections) && is_array($sections) ? $sections : ACF::get_sub_field_array('sections');
$format = isset($format) && is_string($format) ? $format : ACF::get_sub_field_string('format');

if ($sections) {
	$nav_title = isset($nav_title) && is_string($nav_title) ? $nav_title : ACF::get_sub_field_string('nav_title');
	$nav_title_desc = isset($nav_title_desc) && is_string($nav_title_desc) ? $nav_title_desc : ACF::get_sub_field_string('nav_title_desc');
	$nav_block_title = isset($nav_block_title) && is_string($nav_block_title) ? $nav_block_title : ACF::get_sub_field_string('nav_block_title');
	$nav_content = isset($nav_content) && is_string($nav_content) ? $nav_content : ACF::get_sub_field_string('nav_content');
	$tabs_desktop_classes = ['block-tabs__container-desktop'];
	if ($format === 'column') {
		$tabs_desktop_classes[] = 'block-tabs__container-desktop-column';
	}
	$format_title = ACF::get_sub_field_string('format_title');
	$column_num = ACF::get_sub_field_string('column_num');

?>
	<div class="block-inner contain">
		<?php if ($nav_title || $nav_title_desc) { ?>
			<div class="block-section__title-container">
				<?php
				if ($nav_title) {
				?>
					<h2 class="block-section__title"><?php echo esc_html($nav_title); ?></h2>
				<?php } ?>
				<?php if ($nav_title_desc) { ?>
					<div class="block-section__title-desc"><?php echo esc_html($nav_title_desc); ?></div>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if (!$format) { ?>
			<section class="block-tabs__container-mobile">
				<?php
				Component::render(Components\UI\Accordion::class, [
					'allow_multiple_open' => false,
					'open_first_section' => true,
					'title_text_tag' => 'span',
					'sections' => array_map(function ($section) {
						return new AccordionSection(
							Arrays::get_value_as_string($section, 'title'),
							Tabs::renderSectionToString($section, false)
						);
					}, $sections)
				]);

				if ($nav_content) {
				?>
					<div class="block-tabs__nav-content">
						<?php echo wp_kses_post(wpautop($nav_content)); ?>
					</div>
				<?php
				}
				?>
			</section>
		<?php } ?>
		<section class="<?php echo esc_attr(implode(' ', $tabs_desktop_classes)); ?>">
			<aside class="block-tabs__desktop-nav">
				<?php
				if ($nav_block_title) {
					echo wp_kses_post(wpautop($nav_block_title));
				}
				?>

				<?php if (!$format) {
					foreach ($sections as $index => $section) {
						$section_key = Tabs::getSectionId($index);
						$title = Arrays::get_value_as_string($section, 'title');

						$btn_classes = [
							'button',
							'button--secondary',
							'block-tabs__nav-button'
						];

						if ($index === 0) {
							$btn_classes[] = 'active';
						}
				?>
						<button class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>" data-section-id="<?php echo esc_attr($section_key); ?>">
							<?php echo $title; ?>
						</button>
				<?php
					}
				}
				?>

				<?php if ($format === 'column') { ?>
					<div class="block-tabs__nav-row-selector-container">
						<div class="block-tabs__nav-row-selector <?php echo $format_title === 'image' ? 'block-tabs__nav-row-selector-image' : 'block-tabs__nav-row-selector-text'; ?>">
							<?php
							foreach ($sections as $index => $section) {
								$tab = $format_title === 'image' ? Arrays::get_value_as_array($section, 'title_image') : Arrays::get_value_as_string($section, 'title_text');

								$section_key = Tabs::getSectionId($index);

								$btn_classes = ['block-tabs__nav-button'];

								if ($index === 0) {
									$btn_classes[] = 'active';
								}

							?>
								<button class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>" data-section-id="<?php echo esc_attr($section_key); ?>">
									<?php if ($format_title === 'image') {
										Images::safe_image_output($tab, [
											// 'class' => 'block-tabs__nav-row-selector-image',
											'data-ib-no-cache' => 1
										]);
									} else {
										echo $tab;
									}
									?>

								</button>
						<?php
							}
						} ?>

						<?php
						if ($nav_content) {
						?>
							<div class="block-tabs__nav-content">
								<?php echo wp_kses_post(wpautop($nav_content)); ?>
							</div>
						<?php
						}
						?>
			</aside>
			<?php
			$desktop_main_classes = ['block-tabs__desktop-main bg-white'];
			if ($format === 'column') {
				$desktop_main_classes[] = 'block-tabs__desktop-main-column';
				$desktop_main_classes[] = 'block-tabs__desktop-main-column-' . $format_title;
			}
			?>
			<div class="<?php echo esc_attr(implode(' ', $desktop_main_classes)); ?>">
				<?php
				foreach ($sections as $index => $values) {
					$section_key = Tabs::getSectionId($index);
					Tabs::renderSection($values, $section_key, true, $format === 'column', $column_num, $index === 0);
				} ?>
			</div>
		</section>
	</div>
<?php

}
