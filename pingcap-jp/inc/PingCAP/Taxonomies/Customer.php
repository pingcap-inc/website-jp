<?php
namespace PingCAP\Taxonomies;

use WPUtil\Vendor\ACF;
use PingCAP\Constants;

abstract class Customer
{
	/**
	 * Returns the ACF object for the customer term logo image
	 *
	 * @param integer $customer_term_id
	 * @return array<string, mixed>
	 */
	public static function getLogoImageACFObject(int $customer_term_id): array
	{
		return ACF::get_field_array('logo', 'term_' . $customer_term_id);
	}

	/**
	 * Returns the ACF object for the customer term logo image in dark bg
	 *
	 * @param integer $customer_term_id
	 * @return array<string, mixed>
	 */
	public static function getLogoDarkImageACFObject(int $customer_term_id): array
	{
		return ACF::get_field_array('logo_dark', 'term_' . $customer_term_id);
	}

	/**
	 * Returns an array of WP_Term objects representing "orphaned" customer terms
	 * that aren't used by any case study posts
	 *
	 * @return array<\WP_Term>
	 */
	public static function getOrphanedCustomerTerms(): array
	{
		$all_customer_terms = get_terms([
			'taxonomy' => Constants\Taxonomies::CUSTOMER,
			'hide_empty' => false,
			'count' => true
		]);

		$orphaned_customer_terms = array_values(
			array_filter(
				$all_customer_terms,
				fn ($term) => $term->count === 0
			)
		);

		return $orphaned_customer_terms;
	}
}
