<?php
namespace PingCAP;

use PingCAP\Constants;
use WPUtil\Vendor\ACF;

abstract class PageLinks
{
	/**
	 * Return the page ID of the page set under "Theme Settings / Page Links / Resources"
	 *
	 * @return int
	 */
	public static function getResourcesPageId(): int
	{
		return ACF::get_field_int(Constants\ACF::THEME_OPTIONS_PAGE_LINKS_BASE . '_resources', 'option');
	}
}
