<?php
namespace PingCAP;

abstract class Logo
{
	/**
	 * Return an ACF image object for the image file specified under
	 * "Appearance / Customize / Site Identity / Logo"
	 *
	 * @return array<string, mixed>
	 */
	public static function getLogoACFimage(): array
	{
		$attachment_id = intval(get_theme_mod('custom_logo'));

		if (!$attachment_id || !function_exists('acf_get_attachment')) {
			return [];
		}

		$attachment = acf_get_attachment($attachment_id);

		return is_array($attachment) ? $attachment : [];
	}
}
