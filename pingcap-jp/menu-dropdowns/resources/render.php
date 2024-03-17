<?php
// NOTE: $values is an array of ACF field values

use WPUtil\{ Arrays, Component, Vendor };
use PingCAP\Components;

$featured_resources = Arrays::get_value_as_array($values, 'featured_resources');
$links = array_map(
	fn ($link) => Vendor\BlueprintBlocks::get_button_field_values('link', $link),
	Arrays::get_value_as_array($values, 'links')
);

?>
<div class="menu-dropdown-resources__inner">
	<?php
	foreach ($featured_resources as $resource_id)
	{
		Component::render(Components\Cards\CardResource::class, [
			'post_id' => $resource_id
		]);
	}

	if ($links)
	{
		?>
		<div class="menu-dropdown-resources__links-column">
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
	?>
</div>
