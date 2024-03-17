<?php
use WPUtil\Vendor\ACF;
use WPUtil\{ Arrays, SVG };

$first_col_title = ACF::get_sub_field_string('first_col_title');
$row_titles = ACF::get_sub_field_array('row_titles');
$columns = ACF::get_sub_field_array('columns');

?>
<div class="block-inner">
	<table class="block-table__table" data-num-cols="<?php echo esc_attr(count($columns)); ?>">
		<thead>
			<tr>
				<th class="block-table__first-col-cell"><?php echo esc_html($first_col_title); ?></th>
				<?php
				foreach ($columns as $col)
				{
					$col_title = Arrays::get_value_as_string($col, 'title');

					?>
					<th><?php echo esc_html($col_title); ?></th>
					<?php
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($row_titles as $row_index => $row_title)
			{
				$row_title_value = Arrays::get_value_as_string($row_title, 'title');

				?>
				<tr>
					<td class="block-table__first-col-cell"><?php echo esc_html($row_title_value); ?></td>
					<?php
					foreach ($columns as $col)
					{
						$col_row_values = Arrays::get_value_as_array($col, 'row_values');
						$col_row_index_values = $col_row_values[$row_index] ?? null;
						$col_value = '';

						if ($col_row_index_values)
						{
							$col_row_type = Arrays::get_value_as_string($col_row_index_values, 'type');

							switch ($col_row_type)
							{
								case 'text':
									$col_value = esc_html(Arrays::get_value_as_string($col_row_index_values, 'text'));
									break;

								case 'checkmark':
									$is_checked = Arrays::get_value_as_bool($col_row_index_values, 'checkmark');

									$svg_name = 'table-block/table_' . ($is_checked ? 'check' : 'x');
									$svg_classes = ['block-table__icon'];

									if (!$is_checked) {
										$svg_classes[] = 'block-table__icon--x';
									}

									$col_value = '<div class="block-table__icon-container">' . SVG::get_svg($svg_name, ['class' => implode(' ', $svg_classes)]) . '</div>';
									break;

								default:
									break;
							}
						}

						?>
						<td><?php echo $col_value; // phpcs:ignore ?></td>
						<?php
					}
					?>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>
