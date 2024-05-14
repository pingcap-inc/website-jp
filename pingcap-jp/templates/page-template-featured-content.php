<?php
/**
 * Template Name: Featured Content with Sidebar
 */

use PingCAP\Components;
use WPUtil\{ Arrays, Component, Vendor };
use WPUtil\Vendor\ACF;

get_header();

Component::render(Components\Banners\BannerDefault::class, [
	'bottom_arc_color' => 'blue',
	'breadcrumbs_mode' => 'auto',
	'no_gutters' => true
]);

?>
<main class="tmpl-featured-content">
	<?php
	if (have_posts())
	{
		while (have_posts())
		{
			the_post();

			$featured_intro_content = ACF::get_field_string('featured_intro_content');
			$featured_content_type = ACF::get_field_string('featured_content_type');
			$sidebar_sections = ACF::get_field_array('sidebar_sections');

			?>
			<div class="tmpl-featured-content__container bg-blue">
				<div class="tmpl-featured-content__container-inner contain">
					<div class="tmpl-featured-content__box bg-white">
						<?php
						if ($featured_intro_content)
						{
							?>
							<div class="wysiwyg">
								<?php echo wp_kses_post(wpautop($featured_intro_content)); ?>
							</div>
							<?php
						}

						switch ($featured_content_type)
						{
							case 'form':
								Component::render(Components\HubSpotForm::class, [
									'portal_id' => ACF::get_field_string('hubspot_portal_id'),
									'form_id' => ACF::get_field_string('hubspot_form_id'),
									'border' => 'none',
								]);

								break;

							default:
								Component::render(Components\GetStarted::class, [
									'platforms' => ACF::get_field_array('platforms'),
									'title' => ACF::get_field_string('platform_title')
								]);
								// Component::render(Components\PackageDownload::class, [
								// 	'version' => ACF::get_field_array('package_version'),
								// 	'packages' => ACF::get_field_array('package'),
								// 	'title' => ACF::get_field_string('package_download_title'),
								// 	'page_link' => ACF::get_field_array('package_download_page_link')
								// ]);

								break;
						}
						?>
					</div>
					<div class="tmpl-featured-content__sidebar">
						<?php
						foreach ($sidebar_sections as $section)
						{
							$title = Arrays::get_value_as_string($section, 'title');
							$content = Arrays::get_value_as_string($section, 'content');
							$link_values = Vendor\BlueprintBlocks::get_button_field_values('link', $section);

							?>
							<div class="tmpl-featured-content__sidebar-section">
								<?php
								if ($title)
								{
									?>
									<h3><?php echo esc_html($title); ?></h3>
									<?php
								}

								if ($content)
								{
									echo wp_kses_post(wpautop($content));
								}

								if ($link_values->text && $link_values->link)
								{
									Component::render(Components\UI\Button::class, [
										'link' => $link_values->link,
										'text' => $link_values->text,
										'style' => 'button--secondary',
										'additional_classes' => ['tmpl-featured-content__sidebar-link']
									]);
								}
								?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<?php

			Vendor\BlueprintBlocks::safe_display();
		}
	}
	?>
</main>
<?php

get_footer();
