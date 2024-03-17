<?php
namespace PingCAP\Blocks;

use WPUtil\Vendor\ACF;
use PingCAP\{ Constants, PageLinks };

abstract class RelatedResources
{
	public static function getViewAllLink(string $link_type = '', int $post_id = 0): string
	{
		if (!$post_id) {
			$post_id = get_the_ID();
		}

		$view_all_link = '';

		switch ($link_type)
		{
			case 'blog':
				$view_all_link = get_post_type_archive_link(Constants\CPT::BLOG);
				break;

			case 'training':
				$view_all_link = get_post_type_archive_link(Constants\CPT::TRAINING);
				break;

			case 'event':
				$view_all_link = get_post_type_archive_link(Constants\CPT::EVENT);
				break;

			case 'resources':
				$view_all_link = get_the_permalink(PageLinks::getResourcesPageId());
				break;
			
			case 'press-releases':
				$view_all_link = get_post_type_archive_link(Constants\CPT::PRESS_RELEASE);
				break;
			
			case 'ebooks-whitepapers':
				$view_all_link = get_post_type_archive_link(Constants\CPT::EBOOK_WHITEPAPER);
				break;

			default:
				$view_all_link = get_post_type_archive_link(get_post_type($post_id));
				break;
		}

		return $view_all_link;
	}

	public static function block_container_attributes_filter($attrs, $block_name)
	{
		if ($block_name !== 'resources') {
			return $attrs;
		}

		$block_title = ACF::get_sub_field_string('block_title');
		$view_all_enabled = ACF::get_sub_field_bool('view_all_enabled');

		if ($block_title || $view_all_enabled) {
			if (!isset($attrs['class']) || !is_array($attrs['class'])) {
				$attrs['class'] = [];
			}

			$attrs['class'][] = 'block-resources--has-title';
		}

		return $attrs;
	}
}
