<?php
/**
 * Placeholder file for adding custom fields to the WordPress admin tables
 */

if (is_admin()) {
	WPUtil\Admin::add_table_columns(PingCAP\Constants\CPT::COMMUNITY_ACTIVITY, [
		'Event Date(s)' => function($post_id) {
			$date_start = WPUtil\Vendor\ACF::get_field_string('date_start', $post_id);
			$date_end = WPUtil\Vendor\ACF::get_field_string('date_end', $post_id);

			return PingCAP\CPT\CommunityActivity::formatDateLabel($date_start, $date_end);
		}
	]);
}
