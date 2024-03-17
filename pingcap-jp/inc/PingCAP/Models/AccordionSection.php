<?php
namespace PingCAP\Models;

class AccordionSection
{
	/**
	 * The accordion section title
	 *
	 * @var string
	 */
	public $title = '';

	/**
	 * The accordion section content
	 *
	 * @var string
	 */
	public $content = '';

	/**
	 * AccordionSection constructor
	 *
	 * @param string $title
	 * @param string $content
	 */
	public function __construct(string $title = '', string $content = '')
	{
		$this->title = $title;
		$this->content = $content;
	}
}
