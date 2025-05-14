<?php

use PingCAP\{Components, Constants, CPT, Taxonomies};
use WPUtil\{Component, Vendor};
use PingCAP\Integrations\Gartner;

get_header();

Component::render(Components\Banners\BannerCaseStudyArchive::class);

$tmpl_classes = [
	'tmpl-archive',
	'tmpl-archive-case-study',
	'bg-black-dark'
];

$orphaned_customer_terms = [];

if (
	CPT\CaseStudy::getIndustryQueryParamValue() ||
	CPT\CaseStudy::getTagQueryParamValue() ||
	CPT\CaseStudy::getSearchQueryParamValue()
) {
	// $tmpl_classes[] = 'tmpl-archive-case-study--filtered';
} else {
	$orphaned_customer_terms = Taxonomies\Customer::getOrphanedCustomerTerms();
}

?>
<main class="<?php echo esc_attr(implode(' ', $tmpl_classes)); ?>">
	<?php
	global $wp_query;

	Component::render(Components\PostsList\PostsListCaseStudy::class, [
		'wp_query_obj' => $wp_query,
		'orphaned_customer_terms' => $orphaned_customer_terms
	]);
	?>
</main>
<?php

add_filter('PingCAP/blocks/bypass_first_block_arc_check', '__return_true');

Vendor\BlueprintBlocks::safe_display([
	'section' => Constants\ACF::CASE_STUDY_SETTINGS_BASE . '_case_study_archive_blocks_grav_blocks',
	'object' => 'option'
]);

remove_filter('PingCAP/blocks/bypass_first_block_arc_check', '__return_true');

Gartner::enqueueGartner();

get_footer();
