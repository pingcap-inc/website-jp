<?php
namespace PingCAP\Components\Cards;

use WPUtil\Vendor\ACF;
use WPUtil\Arrays;
use PingCAP\Components\Cards\CardResource;

class CardNews extends CardResource
{
	public function __construct(array $params)
	{
		parent::__construct($params);

		$this->permalink = Arrays::get_value_as_string($params, 'permalink', fn () => ACF::get_field_string('url', $this->post_id));
		// $this->category = get_the_date('Y-m-d', $this->post_id);
		$this->add_container_classes = [
			'card-resource-news'
		];
		$this->add_container_attrs = [
			'target' => '_blank',
			'rel' => 'noopener noreferrer'
		];
	}
}
