<?php
use Blueprint\Images;
use WPUtil\Vendor\ACF;
use WPUtil\Arrays;
use PingCAP\Constants;
use PingCAP\Models\PricingProvider;

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');
$provider_selector_title = isset($provider_selector_title) && is_string($provider_selector_title) ? $provider_selector_title : ACF::get_sub_field_string('provider_selector_title');
$region_selector_title = isset($region_selector_title) && is_string($region_selector_title) ? $region_selector_title : ACF::get_sub_field_string('region_selector_title');
$region_selector_content = isset($region_selector_content) && is_string($region_selector_content) ? $region_selector_content : ACF::get_sub_field_string('region_selector_content');
$header_label = get_sub_field('header_label');

$providers = isset($providers) && is_array($providers) ? $providers : ACF::get_sub_field_array('providers');

if ($providers)
{
	$providers_data = array_map(fn ($provider) => new PricingProvider(
		Arrays::get_value_as_string($provider, 'title'),
		Arrays::get_value_as_array($provider, 'logo'),
		Arrays::get_value_as_array($provider, 'regions')
	), $providers);
	

	$providers_data_array = array_map(fn ($provider) => $provider->toArray(), $providers_data);

	$initial_regions = array_map(fn ($region) => $region->name ?? '', $providers_data[0]->regions);

	?>
	<div class="block-inner">
		<?php
		if ($block_title)
		{
			?>
			<div class="block-pricing__title-container contain">
				<h2 class="block-pricing__title"><?php echo esc_html($block_title); ?></h2>
			</div>
			<?php
		}
		?>
		<div class="block-pricing__controls-container contain">
			<div class="block-pricing__control-group bg-white">
				<?php
				if ($provider_selector_title)
				{
					?>
					<h4><?php echo esc_html($provider_selector_title); ?></h4>
					<?php
				}
				?>
				<div class="block-pricing__providers-container">
					<?php
					foreach ($providers as $provider_id => $provider)
					{
						$title = $provider['title'] ?? '';
						$logo = $provider['logo'] ?? null;

						if (!$title || !$logo)
						{
							continue;
						}

						$btn_classes = ['block-pricing__provider-button'];

						if ($provider_id === 0) {
							$btn_classes[] = 'active';
						}

						?>
						<button
							class="<?php echo esc_attr(implode(' ', $btn_classes)); ?>"
							aria-label="<?php echo esc_attr($title); ?>"
							data-provider-id="<?php echo esc_attr($provider_id); ?>"
						>
							<?php echo Images::safe_image_output($logo, ['class' => 'block-pricing__provider-logo']); ?>
						</button>
						<?php
					}
					?>
				</div>
			</div>
			<div class="block-pricing__control-group bg-white">
				<?php
				if ($region_selector_title)
				{
					?>
					<h4><?php echo esc_html($region_selector_title); ?></h4>
					<?php
				}
				?>
				<select class="block-pricing__region-selector">
					<?php
					foreach ($initial_regions as $region_id => $region_name)
					{
						?>
						<option value="<?php echo esc_attr($region_id); ?>"><?php echo esc_html($region_name); ?></option>
						<?php
					}
					?>
				</select>
				<?php
				if ($region_selector_content)
				{
					?>
					<div class="block-pricing__region-selector-content wysiwyg">
						<?php echo wp_kses_post(wpautop($region_selector_content)); ?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<div class="block-pricing__table-container">
			<table
				class="block-pricing__table table--black-header table--header-align-bottom pricing-new"
				data-selected-provider-id="0"
				data-selected-region-id="0"
				data-providers-data="<?php echo htmlspecialchars(json_encode($providers_data_array)); ?>"
			>
				<thead>

					<tr>
						<?php
						foreach ($header_label as $label_header) {

						?>
							<th><?php _e($label_header['header_field'], Constants\TextDomains::DEFAULT); ?></th>

						<?php
						}
						?>
					</tr>

				</thead>
				<tbody>
					<?php
					foreach ($providers_data[0]->regions[0]->tiers as $tier_index => $tier)
					
					{
						foreach ($tier->rows as $row_index => $row)
						{
				
							$tr_classes = [];

							if ($tier_index % 2 === 1) {
								$tr_classes[] = 'table--row-gray-bg';
							}

							if ($row_index === 0 && $tier_index === count($providers_data[0]->regions[0]->tiers) - 1) {
								$tr_classes[] = 'table--last-group-start';
							}

							?>
							<tr class="<?php echo esc_attr(implode(' ', $tr_classes)); ?>">
								<?php
								if ($row_index === 0)
								{
									?>
									<td rowspan="<?php echo esc_attr(count($tier->rows)); ?>"><?php echo esc_html($tier->name); ?></td>
									<?php
								}
								
								?>
								<td><?php echo esc_attr($row->node); ?></td>
								<td><?php echo esc_attr($row->cpu); ?></td>
								<td><?php echo esc_attr($row->storage); ?></td>
								<td><?php echo esc_attr($row->hcpn); ?></td>
								<td><?php echo esc_attr($row->scgbh); ?></td>
							</tr>
							<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
		<div class="block-pricing__table-desc contain">
			<?php the_sub_field('table_desc'); ?>
		</div>
	</div>
	<?php
}
