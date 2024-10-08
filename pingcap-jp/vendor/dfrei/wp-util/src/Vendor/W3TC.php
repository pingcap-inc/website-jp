<?php
/**
 * NOTE: While this class appears to be working correctly, all potential use-cases
 * have not been tested and you may encounter issues.
 *
 * Additionaly, this class has very specific usage requirements in order to work
 * correctly:
 *
 * 1. It must be called in 'wp-config.php' after the 'ABSPATH' constant is set
 *    and before 'wp-settings.php' is required.
 * 2. The keys for the values you set in the 'set_values' method must be labeled
 *    as they are in the 'wp-content/w3tc-config/master.php' file.
 *
 * Here's an example of usage within 'wp-config.php' that ensures the Composer
 * autoload has been included, enables the page cache, adds support for WooCommerce
 * caching, and enables the db cache based on a pre-defined constant:
 *
 * if (file_exists(dirname(ABSPATH).'/vendor/autoload.php')) {
 *     require_once(dirname(ABSPATH).'/vendor/autoload.php');
 *
 *     Grav\Vendor\W3TC::set_values(array(
 *         'pgcache.enabled' => true,
 *         'dbcache.reject.sql' => array(
 *             'gdsr_',
 *             'wp_rg_',
 *             '_wp_session_',
 *             '_wc_session_'
 *         ),
 *         'dbcache.enabled' => (defined('LOCAL_CONFIG_MEMCACHED_SERVER') && LOCAL_CONFIG_MEMCACHED_SERVER && class_exists('Memcached') ? true : false)
 *     ));
 * }
 */

namespace WPUtil\Vendor;

abstract class W3TC
{
	protected static $w3tc_config = null;

	/**
	 * Get the W3TC config class
	 * Returns a W3TC\Config class on success and null on failure
	 *
	 * @return mixed
	 */
	protected static function get_config()
	{
		// check to see if Config object already exists
		if (self::$w3tc_config) {
			return self::$w3tc_config;
		}

		if (defined('WP_INSTALLING') && WP_INSTALLING) {
			self::$w3tc_config = null;
			return null;
		}

		$api_file = ABSPATH . 'wp-content/plugins/w3-total-cache/w3-total-cache-api.php';

		if (!file_exists($api_file)) {
			self::$w3tc_config = null;
			return null;
		}

		require_once($api_file);

		self::$w3tc_config = \W3TC\Dispatcher::config();

		return self::$w3tc_config;
	}

	/**
	 * Set W3TC configuration values using a key/value pair array
	 *
	 * @param array $values
	 * @return boolean
	 */
	public static function set_values(array $values): bool
	{
		// do we have a valid config object?
		$w3tc_config = self::get_config();

		if ($w3tc_config === null) {
			return false;
		}

		foreach ($values as $key => $val) {
			self::$w3tc_config->set($key, $val);
		}

		return true;
	}

	/**
	 * Restrict access to the W3TC settings page with an optional message
	 *
	 * @param string $message
	 * @return void
	 */
	public static function lock_settings_page($message = ''): void
	{
		return; // to disable this function

		if (!$message) {
			$message = 'The settings for W3 Total Cache have been locked.';
		}

		add_action('admin_init', function() use (&$message) {
			if (isset($_GET['page']) && strpos($_GET['page'], 'w3tc_') !== false && $_GET['page'] != 'w3tc_dashboard') {
				echo $message.' <br><br><a href="javascript:history.go(-1);">< Back</a>';
				exit;
			}
		});
	}
}
