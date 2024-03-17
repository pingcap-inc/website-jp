<?php
namespace PingCAP\Integrations;

use PingCAP\Constants;
use PingCAP\Models\LeverCareerPosting;
use WPUtil\Vendor\ACF;
use Exception;

abstract class Lever
{
	const RESULTS_CACHE_KEY = 'lever_results';

	/**
	 * Returns the JSON postings URL value stored under "Theme Settings / Integrations / Lever"
	 *
	 * @return string
	 */
	public static function getSettingJSONpostingsURL(string $args): string
	{
		$res = ACF::get_field_string(
			Constants\ACF::THEME_OPTIONS_INTEGRATIONS_BASE . '_lever_json_postings_url',
			'option',
			[
				'default' => Constants\DefaultValues::LEVER_POSTINGS_JSON_URL
			]
		);
		if($args) {
			$res .= '&' . $args;
		}
		return $res;
	}

	/**
	 * Returns the cache time in minutes value stored under "Theme Settings / Integrations / Lever"
	 *
	 * @return int
	 */
	public static function getSettingCacheTimeMinutes(): int
	{
		return ACF::get_field_int(
			Constants\ACF::THEME_OPTIONS_INTEGRATIONS_BASE . '_lever_cache_time_minutes',
			'option',
			[
				'default' => Constants\DefaultValues::LEVER_CACHE_TIME_MIN
			]
		);
	}

	/**
	 * Returns an array of LeverCareerPosting objects sourced from either the WP
	 * transient cache or from the Lever JSON postings URL
	 *
	 * @return array<\PingCAP\Models\LeverCareerPosting>
	 * @throws Exception If there is an error sourcing the results from the JSON postings URL.
	 */
	public static function getResults(string $args): array
	{
		$cacheKey = self::RESULTS_CACHE_KEY.$args;
		$cached_results = get_transient($cacheKey);

		if (is_array($cached_results)) {
			return $cached_results;
		}

		$new_results = self::getJSONresults(self::getSettingJSONpostingsURL($args));

		set_transient($cacheKey, $new_results, self::getSettingCacheTimeMinutes());

		return $new_results;
	}

	/**
	 * Returns an array of LeverCareerPosting objects parsed from the JSON postings URL
	 *
	 * @param string $json_url
	 * @return array<\PingCAP\Models\LeverCareerPosting>
	 * @throws Exception If no JSON URL is specified.
	 * @throws Exception If there is an error retrieving the JSON.
	 * @throws Exception If the response body is not valid JSON.
	 */
	public static function getJSONresults(string $json_url = Constants\DefaultValues::LEVER_POSTINGS_JSON_URL): array
	{
		if (!trim($json_url)) {
			throw new Exception('No Lever JSON URL specified');
		}

		$res = wp_safe_remote_get($json_url);

		if (is_wp_error($res)) {
			throw new Exception($res->get_error_message());
		}

		$res_code = wp_remote_retrieve_response_code($res);

		if ($res_code !== 200) {
			throw new Exception('An error occurred while retrieving the JSON posting results from Lever');
		}

		$json_results = json_decode(wp_remote_retrieve_body($res));

		if (!is_array($json_results)) {
			throw new Exception('Unable to parse JSON results from Lever');
		}

		$postings = [];

		foreach ($json_results as $result) {
			$group = trim($result->categories->team ?? '');
			$title = trim($result->text ?? '');
			$location = trim($result->categories->location ?? '');
			$commitment = trim($result->categories->commitment ?? '');
			$url = trim($result->hostedUrl ?? '');

			if (!$group || !$title || !$url) {
				continue;
			}

			$postings[] = new LeverCareerPosting($group, $title, $location, $commitment, $url);
		}

		return $postings;
	}

	/**
	 * Clear the WP transient cache value for the posting results
	 *
	 * @return boolean
	 */
	public static function clearCache(): bool
	{
		return delete_transient(self::RESULTS_CACHE_KEY);
	}
}
