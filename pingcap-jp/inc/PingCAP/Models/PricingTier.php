<?php
namespace PingCAP\Models;

use PingCAP\Models\PricingTierRow;
use WPUtil\Arrays;

class PricingTier
{
	/**
	 * The tier name
	 *
	 * @var string
	 */
	public string $name = '';

	/**
	 * The tier rows
	 *
	 * @var array<\PingCAP\Models\PricingTierRow>
	 */
	public array $rows = [];

	/**
	 * PricingTier constructor
	 *
	 * @param string $name
	 * @param array<array<string, string>> $rows
	 */
	public function __construct(string $name = '', array $rows = [])
	{
		$this->name = trim($name);
		$this->rows = array_map(
			fn ($row) => new PricingTierRow(
				Arrays::get_value_as_string($row, 'node'),
				Arrays::get_value_as_string($row, 'storage'),
				Arrays::get_value_as_string($row, 'hcpn'),
				Arrays::get_value_as_string($row, 'mcpn'),
				Arrays::get_value_as_string($row, 'pphcpn'),
				Arrays::get_value_as_string($row, 'ppmcpn'),
				Arrays::get_value_as_string($row, 'cpu'),
				Arrays::get_value_as_string($row, 'sbph'),
				Arrays::get_value_as_string($row, 'scgbh')
			),
			$rows
		);
	}

	/**
	 * Convert this PricingTier to an array
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(): array
	{
		return [
			'name' => $this->name,
			'rows' => array_map(fn ($row) => $row->toArray(), $this->rows)
		];
	}
}
