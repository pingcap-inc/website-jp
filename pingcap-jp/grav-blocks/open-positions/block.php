<?php

use WPUtil\Vendor\ACF;

$block_title = isset($block_title) && is_string($block_title) ? $block_title : ACF::get_sub_field_string('block_title');

?>
<div class="block-inner contain">
	<?php
	if ($block_title) {
	?>
		<h2 class="block-open-positions__title"><?php echo esc_html($block_title); ?></h2>
	<?php
	}
	?>
	<div class="block-open-positions__filter">
		<select class="block-open-positions__filter-control" name="filter_location" data-role="location">
			<option>Filter by Location</option>
		</select>
		<select class="block-open-positions__filter-control" name="filter_department" data-role="department">
			<option>Filter by Department</option>
		</select>
	</div>
	<div class="block-open-positions__groups loading">
		<span class="ui__spin-loader"></span>
		<div class="block-open-positions__groups-wrapper"></div>
		<div class="block-open-positions__no-results-container hide" data-no-results-container>
			<h4>No job were found for the selected filters.</h4>
		</div>
	</div>
	<template class="block-open-positions__template-filter">
		<select class="block-open-positions__filter-control"></select>
	</template>
	<template class="block-open-positions__template-group">
		<div class="block-open-positions__group">
			<h4 class="block-open-positions__group-title"></h4>
			<div class="block-open-positions__group-cards"></div>
		</div>
	</template>
	<template class="block-open-positions__template-card">
		<a class="block-open-positions__card" href="#" target="_blank" rel="noopener noreferrer">
			<h5 class="block-open-positions__card-title"></h5>
			<p class="block-open-positions__card-desc"></p>
		</a>
	</template>
</div>