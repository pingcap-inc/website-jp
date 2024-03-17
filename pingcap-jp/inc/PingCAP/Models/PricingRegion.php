<?php
namespace PingCAP\Models;

use PingCAP\Models\PricingTier;
use WPUtil\Arrays;

class PricingRegion
{
	/**
	 * The region name
	 *
	 * @var string
	 */
	public string $name = '';

	/**
	 * The region tiers
	 *
	 * @var array<\PingCAP\Models\PricingTier>
	 */
	public array $tiers = [];

	/**
	 * PricingRegion constructor
	 *
	 * @param string $name
	 * @param array<array<string, mixed>> $tiers
	 */
	public function __construct(string $name = '', array $tiers = [])
	{
		$this->name = trim($name);
		$this->tiers = array_map(
			fn ($tier) => new PricingTier(
				Arrays::get_value_as_string($tier, 'name'),
				Arrays::get_value_as_array($tier, 'rows')
			),
			$tiers
		);
	}

	/**
	 * Convert this PricingRegion to an array
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'tiers' => array_map(fn ($row) => $row->toArray(), $this->tiers)
		];
	}
}
