<?php
namespace PingCAP\Models;

class FooterLinksGroup
{
	/**
	 * The footer links group title
	 *
	 * @var string
	 */
	public $title = '';

	/**
	 * The footer links group link items
	 *
	 * @var array<\PingCAP\Models\FooterLink>
	 */
	public $items = [];
}
