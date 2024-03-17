<?php
namespace PingCAP\Models;

class PricingTierRow
{
	/**
	 * The "Node" value
	 *
	 * @var string
	 */
	public string $node = '';

	/**
	 * The "Storage" value
	 *
	 * @var string
	 */
	public string $storage = '';

	/**
	 * The "Hourly Cost Per Node" value
	 *
	 * @var string
	 */
	public string $hcpn = '';

	/**
	 * The "Monthly Cost Per Node" value
	 *
	 * @var string
	 */
	public string $mcpn = '';

	/**
	 * The "Public Preview: Hourly Cost Per Node" value
	 *
	 * @var string
	 */
	public string $pphcpn = '';

	/**
	 * The "Public Preview: Monthly Cost Per Node" value
	 *
	 * @var string
	 */
	public string $ppmcpn = '';

	/**
	 * The "CPU" value
	 *
	 * @var string
	 */
	public string $cpu = '';
	
	/**
	 * The "Storage Base Price per Hour" value
	 *
	 * @var string
	 */
	public string $sbph = '';
	
	/**
	 * The "Storage Cost per GB/hour" value
	 *
	 * @var string
	 */
	public string $scgbh = '';

	/**
	 * PricingTierRow constructor
	 *
	 * @param string $node
	 * @param string $storage
	 * @param string $hcpn
	 * @param string $mcpn
	 * @param string $pphcpn
	 * @param string $ppmcpn
	 * @param string $cpu
	 */
	public function __construct(
		string $node = '',
		string $storage = '',
		string $hcpn = '',
		string $mcpn = '',
		string $pphcpn = '',
		string $ppmcpn = '',
		string $cpu = '',
		string $sbph = '',
		string $scgbh = ''
	)
	{
		$this->node = trim($node);
		$this->storage = trim($storage);
		$this->hcpn = trim($hcpn);
		$this->mcpn = trim($mcpn);
		$this->pphcpn = trim($pphcpn);
		$this->ppmcpn = trim($ppmcpn);
		$this->cpu = trim($cpu);
		$this->sbph = trim($sbph);
		$this->scgbh = trim($scgbh);
	}

	/**
	 * Convert this PricingTierRow to an array
	 *
	 * @return array<string, string>
	 */
	public function toArray(): array
	{
		return [
			'node' => $this->node,
			'storage' => $this->storage,
			'hcpn' => $this->hcpn,
			'mcpn' => $this->mcpn,
			'pphcpn' => $this->pphcpn,
			'ppmcpn' => $this->ppmcpn,
			'cpu' => $this->cpu,
			'sbph' => $this->sbph,
			'scgbh' => $this->scgbh
		];
	}
}
