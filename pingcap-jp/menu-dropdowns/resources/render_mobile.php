<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Vendor };

$featured_resources = Arrays::get_value_as_array($values, 'featured_resources');
$links = array_map(
	fn ($link) => Vendor\BlueprintBlocks::get_button_field_values('link', $link),
	Arrays::get_value_as_array($values, 'links')
);

foreach ($featured_resources as $resource_id)
{
	$title = get_the_title($resource_id);
	$link = get_the_permalink($resource_id);

	?>
	<a class="mobile-menu-default__section-link-large" href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a>
	<?php
}

if ($links)
{
	?>
	<div class="mobile-menu-default__section-links-column">
		<?php
		foreach ($links as $link)
		{
			if (!$link->link || !$link->text) {
				continue;
			}

			?>
			<a href="<?php echo esc_url($link->link); ?>"><?php echo esc_html($link->text); ?></a>
			<?php
		}
		?>
	</div>
	<?php
}
