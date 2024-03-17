<?php

namespace PingCAP\API\v1;

use PingCAP\Integrations\Lever;
use PingCAP\Models\LeverCareerPosting;
use Blueprint\WPHooks;
use WP_Error;
use WP_REST_Response;
use Exception;

class Careers
{
	public function __construct(string $namespace, string $url)
	{
		register_rest_route($namespace, $url, [
			[
				'methods' => 'GET',
				'callback' => [&$this, 'getCareers'],
				'permission_callback' => '__return_true',
				'args' => [],
			]
		]);
	}

	public function getCareers($req)
	{
		try {
			$args = http_build_query($req->get_params());
			$results = Lever::getResults($args);
		} catch (Exception $e) {
			return new WP_Error('error', $e->getMessage());
		}

		// organize results into groups
		$grouped_results = array_reduce($results, function (array $acum, LeverCareerPosting $result) {
			$existing_group_index = -1;

			foreach ($acum as $cur_group_index => $group) {
				if ($group['group'] === $result->group) {
					$existing_group_index = $cur_group_index;
				}
			}

			if ($existing_group_index === -1) {
				$acum[] = [
					'group' => $result->group,
					'records' => []
				];

				$existing_group_index = count($acum) - 1;
			}

			$acum[$existing_group_index]['records'][] = [
				'title' => $result->title,
				'location' => $result->location,
				'commitment' => $result->commitment,
				'url' => $result->url
			];

			return $acum;
		}, []);

		// sort by title within groups
		$grouped_results = array_map(function ($group) {
			usort($group['records'], fn ($a, $b) => strcmp($a['title'], $b['title']));

			return $group;
		}, $grouped_results);

		// sort by group name
		usort($grouped_results, fn ($a, $b) => strcmp($a['group'], $b['group']));

		$res = new WP_REST_Response($grouped_results);

		// phpcs:ignore
		$res->header('Access-Control-Allow-Origin', apply_filters(WPHooks::FILTER_REST_API_ACCESS_CONTROL_ALLOW_ORIGIN, '*', $req->get_route()));

		return $res;
	}
}
