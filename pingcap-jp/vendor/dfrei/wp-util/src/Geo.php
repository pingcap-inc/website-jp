<?php
namespace WPUtil;

use WPUtil\Exceptions\GoogleMapsAPIException;

abstract class Geo
{
	/**
	 * Calculates the distance between two set of coordinate points.
	 * See http://stackoverflow.com/questions/10053358/measuring-the-distance-between-two-coordinates-in-php for more information.
	 *
	 * @param  float  $fromLat           source latitude value
	 * @param  float  $fromLng           source longitude valude
	 * @param  float  $toLat             destination latitude value
	 * @param  float  $toLng             destination longitude value
	 * @param  string  $format           return format - can be 'mi' (default) for miles or 'm' for meters
	 * @param  boolean $vincenty_formula optionally use the vincenty formula for calculation (default is the haversine formula)
	 * @return float                     distance between the two points in the specified format
	 */
	public static function distance_between_points(
		float $fromLat,
		float $fromLng,
		float $toLat,
		float $toLng,
		string $format = 'mi',
		bool $vincenty_formula = false
	): float
	{
		// convert from degrees to radians
		$fromLat = deg2rad($fromLat);
		$fromLng = deg2rad($fromLng);
		$toLat = deg2rad($toLat);
		$toLng = deg2rad($toLng);

		$angle = 0;
		$earthRadius = ($format == 'mi') ? 3959 : 6371000;

		if ($vincenty_formula) {
			$lngDelta = $toLng - $fromLng;
			$a = pow(cos($toLat) * sin($lngDelta), 2) + pow(cos($fromLat) * sin($toLat) - sin($fromLat) * cos($toLat) * cos($lngDelta), 2);
			$b = sin($fromLat) * sin($toLat) + cos($fromLat) * cos($toLat) * cos($lngDelta);

			$angle = atan2(sqrt($a), $b);
		} else {
			$latDelta = $toLat - $fromLat;
			$lngDelta = $toLng - $fromLng;

			$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($fromLat) * cos($toLat) * pow(sin($lngDelta / 2), 2)));
		}

		return $angle * $earthRadius;
	}

	/**
	 * Get the latitude/longitude values for an address
	 * Uses the Google Maps API and is intended for single requests to avoid rate limiting
	 *
	 * @param string $address
	 * @param string $gmaps_api_key
	 * @param array<int, mixed> $add_curl_opts
	 * @return object
	 * @throws GoogleMapsAPIException If the Geocoding API returns an error.
	 */
	public static function address_to_location(string $address, string $gmaps_api_key = '', array $add_curl_opts = []): object
	{
		$ret_obj = (object)[
			'latitude' => 0,
			'longitude' => 0,
			'location_type' => '',
		];

		$query_parts = array(
			'address=' . str_replace(' ', '+', urlencode($address)),
			'sensor=false'
		);

		if ($gmaps_api_key) {
			$query_parts[] = 'key=' . $gmaps_api_key;
		}

		$details_url = 'https://maps.googleapis.com/maps/api/geocode/json?' . implode('&', $query_parts);

		$ch = curl_init();

		$curl_opts = [
			CURLOPT_URL => $details_url,
			CURLOPT_RETURNTRANSFER => 1
		];

		$curl_opts = array_reduce(array_keys($add_curl_opts), function ($acum, $key) use ($add_curl_opts) {
			if (!isset($acum[$key])) {
				$acum[$key] = $add_curl_opts[$key];
			}

			return $acum;
		}, $curl_opts);

		curl_setopt_array($ch, $curl_opts);

		$response = json_decode(curl_exec($ch), true);

		// If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
		if ($response['status'] !== 'OK') {
			throw new GoogleMapsAPIException($response['status'], $response['error_message'] ?? '', $response);
		}

		$geometry = $response['results'][0]['geometry'];

		$ret_obj->latitude = $geometry['location']['lat'];
		$ret_obj->longitude = $geometry['location']['lng'];
		$ret_obj->location_type = $geometry['location_type'];

		return $ret_obj;
	}

	/**
	 * Get posts that match specific location parameters
	 * Argument keys:
	 *     'from_location' - can be an array with 'latitude' and 'longitude' keys or a string (default is '98668)
	 *     'post_type' - specify the post type (default is 'post')
	 *     'latitude' - name of the DB table latitude key (default is 'latitude')
	 *     'longitude' - name of the DB table longitude key (default is 'longitude')
	 *     'measurement' - can be 'miles' or 'kilometers' (defaults to 'miles')
	 *     'within' - the range of results included in miles/kilometers (defaults to 25)
	 *     'from' - minimum distance in miles/kilometers from the source (defaults to 0)
	 *     'limit' - limit the amount of results returned (default is 999999)
	 *     'meta_query' - include array of items having key/value/compare keys as meta query clauses
	 *
	 * @param array $args
	 * @return array
	 */
	public static function get_posts_by_location($args = []): array
	{
		global $wpdb;

		// Set Defaults
		$from_location = (!empty($args['from_location']) ? esc_sql($args['from_location']) : '98668');
		$post_type = (!empty($args['post_type']) ? esc_sql($args['post_type']) : 'post');
		$latitude = (!empty($args['latitude']) ? esc_sql($args['latitude']) : 'latitude');
		$longitude = (!empty($args['longitude']) ? esc_sql($args['longitude']) : 'longitude');
		$measurement = (!empty($args['measurement']) && $args['measurement'] == 'kilometers' ? 6371 : 3959);
		$within = (!empty($args['within']) ? esc_sql($args['within']) : 25);
		$from = (!empty($args['from']) ? esc_sql($args['from']) : 0);
		$limit = (!empty($args['limit']) ? esc_sql($args['limit']) : 999999);
		$meta_query = (!empty($args['meta_query'])) ? $args['meta_query'] : [];
		$post_not_in = isset($args['post__not_in']) && is_array($args['post__not_in']) ? array_filter($args['post__not_in'], function ($post_id) {
			return is_int($post_id) && $post_id > 0;
		}) : [];

		if (is_array($from_location)) {
			if (isset($args['from_location']['latitude'])) {
				$from_latitude = $args['from_location']['latitude'];
				$from_longitude = $args['from_location']['longitude'];
			} else if (isset($args['from_location'][0])) {
				$from_latitude = $args['from_location'][0];
				$from_longitude = $args['from_location'][1];
			}
		} else {
			$location = self::address_to_location($from_location);
			$from_latitude = $location->latitude;
			$from_longitude = $location->longitude;
		}

		// build select clauses
		$select_clauses = array(
			"{$wpdb->posts}.*",
			"( {$measurement} * acos( cos( radians({$from_latitude}) ) * cos( radians( pm1.meta_value ) )
		  * cos( radians( pm2.meta_value ) - radians({$from_longitude}) ) + sin( radians({$from_latitude}) )
		  * sin( radians( pm1.meta_value ) ) ) ) AS distance",
	  	);

		// build join clauses
		$join_clauses = array(
			"INNER JOIN {$wpdb->postmeta} AS pm1 ON ({$wpdb->posts}.ID = pm1.post_id AND pm1.meta_key = '{$latitude}')",
			"INNER JOIN {$wpdb->postmeta} AS pm2 ON ({$wpdb->posts}.ID = pm2.post_id AND pm2.meta_key = '{$longitude}')"
		);

		// build where clauses
		$where_having_clauses = array(
			"distance < {$within}",
			"distance >= {$from}",
		);

		$where_and_clauses = array(
			"post_type = '{$post_type}'",
			"post_status = 'publish'"
		);

		if ($post_not_in) {
			$where_and_clauses[] = "{$wpdb->posts}.ID NOT IN (" . implode(',', $post_not_in) . ')';
		}

		// add meta query clauses
		for ($i = 0; $i < count($meta_query); $i++) {
			if (!is_array($meta_query[$i]) || !isset($meta_query[$i]['key']) || !isset($meta_query[$i]['value'])) {
				continue;
			}

			$key = esc_sql($meta_query[$i]['key']);
			$value = esc_sql($meta_query[$i]['value']);
			$compare = isset($meta_query[$i]['compare']) ? esc_sql($meta_query[$i]['compare']) : '=';
			$name = "mq{$i}";
			$select_clauses[] = "{$name}.meta_value AS {$key}";
			$join_clauses[] = "INNER JOIN {$wpdb->postmeta} AS {$name} ON ({$wpdb->posts}.ID = {$name}.post_id AND {$name}.meta_key = '{$key}')";
			$where_having_clauses[] = "{$key} {$compare} {$value}";
		}

		$sql = "SELECT ".implode(', ', $select_clauses)." FROM {$wpdb->posts} ".implode(' ', $join_clauses)." WHERE " . implode(' AND ', $where_and_clauses) . " HAVING ".implode(' AND ', $where_having_clauses)." ORDER BY distance LIMIT {$limit}";

		return $wpdb->get_results($sql);
	}

	/**
	 * Attempt to get the IP address of the current visitor
	 *
	 * @return string
	 */
	public static function get_user_ip(): string
	{
		if (isset($_SERVER['HTTP_CLIENT_IP'])) {
			$client_ip = $_SERVER['HTTP_CLIENT_IP'];
		} else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$client_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (isset($_SERVER['HTTP_X_REAL_IP'])) {
			$client_ip = $_SERVER['HTTP_X_REAL_IP'];
		} else {
			$client_ip = $_SERVER['REMOTE_ADDR'];
		}

		return $client_ip;
	}
}
