<?php
namespace PingCAP\Models;

use PingCAP\Models\PricingRegion;
use WPUtil\Arrays;

class PricingProvider
{
	/**
	 * The provider title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The provider logo image
	 * This should be passed as an ACF image object array
	 *
	 * @var null|array<string, mixed>
	 */
	public $logo = null;

	/**
	 * The provider regions
	 *
	 * @var array<\PingCAP\Models\PricingRegion>
	 */
	public array $regions = [];

	/**
	 * PricingProvider constructor
	 *
	 * @param string $title
	 * @param null|array<string, mixed> $logo
	 * @param array $regions
	 */
	public function __construct(string $title = '', $logo = null, array $regions = [])
	{
		$this->title = $title;
		$this->logo = $logo;
		$this->regions = array_map(
			fn ($region) => new PricingRegion(
				Arrays::get_value_as_string($region, 'name'),
				Arrays::get_value_as_array($region, 'tiers')
			),
			$regions
		);
	}

	/**
	 * Convert this PricingProvider to an array
	 *
	 * @param boolean $only_regions
	 * @return array<string, mixed>
	 */
	public function toArray(bool $only_regions = true): array
	{
		$res = [
			'regions' => array_map(fn ($region) => $region->toArray(), $this->regions)
		];

		if (!$only_regions) {
			$res['title'] = $this->title;
			$res['logo'] = $this->logo;
		}

		return $res;
	}
}
