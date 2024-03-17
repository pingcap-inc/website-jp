<?php
namespace PingCAP\Models;

class BreadcrumbLink
{
	/**
	 * The breadcrumb label
	 *
	 * @var string
	 */
	public string $label = '';

	/**
	 * The breadcrumb link
	 *
	 * @var string
	 */
	public string $link = '';

	/**
	 * BreadcrumbLink constructor
	 *
	 * @param string $label
	 * @param string $link
	 */
	public function __construct(string $label, string $link)
	{
		$this->label = $label;
		$this->link = $link;
	}
}
