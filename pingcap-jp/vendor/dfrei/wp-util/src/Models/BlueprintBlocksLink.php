<?php

namespace WPUtil\Models;

class BlueprintBlocksLink
{
	/**
	 * The link type
	 *
	 * @var string
	 */
	public $type = '';

	/**
	 * The link text
	 *
	 * @var string
	 */
	public $text = '';

	/**
	 * The link URL
	 *
	 * @var string
	 */
	public $link = '';

	/**
	 * The link style
	 *
	 * @var string
	 */
	public $style = '';

	/**
	 * The link gtag
	 *
	 * @var string
	 */
	public $gtag = '';

	/**
	 * BlueprintBlocksLink constructor
	 *
	 * @param string $type
	 * @param string $text
	 * @param string $link
	 * @param string $style
	 * @param string $gtag
	 */
	public function __construct(string $type = '', string $text = '', string $link = '', string $style = '', string $gtag = '')
	{
		$this->type = $type;
		$this->text = $text;
		$this->link = $link;
		$this->style = $style;
		$this->gtag = $gtag;
	}
}
