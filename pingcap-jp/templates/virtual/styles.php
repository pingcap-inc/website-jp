<?php
use PingCAP\Components;
use WPUtil\Component;

get_header();

Component::render(Components\Banners\BannerDefault::class, [
	'title' => 'Styles'
]);

$backgrounds = apply_filters('grav_block_background_colors', [], '');
$backgrounds = $backgrounds ? array_filter($backgrounds, function ($key) {
	return $key !== 'block-bg-image';
}, ARRAY_FILTER_USE_KEY) : [];

?>
<script>
	document.addEventListener('DOMContentLoaded', function (e) {
		var colorSelect = document.querySelector('.style-testing__select--color');

		colorSelect.addEventListener('change', function (e) {
			var colorClass = e.currentTarget.selectedOptions[0].value;

			document.querySelector('#style-testing__content').setAttribute('class', colorClass);
		});
	});
</script>
<div id="style-testing__content" class="wysiwyg">
	<?php Component::render(Components\Testing\StyleTesting::class); ?>
</div>
<div class="style-testing__color-selector">
	<div class="contain">
		<label for="bg-color">Background Color:</label>
		<select id="bg-color" class="style-testing__select--color">
			<?php
			foreach ($backgrounds as $class => $label) {
				?>
				<option value="<?php echo esc_attr($class); ?>"
					<?php if ($class === '') { ?>selected<?php } ?>
				>
					<?php echo esc_html($label); ?>
				</option>
				<?php
			}
			?>
		</select>
	</div>
</div>
<?php

get_footer();
