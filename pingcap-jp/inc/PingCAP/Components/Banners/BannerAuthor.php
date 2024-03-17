<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays};
use PingCAP\{PageLinks};
use PingCAP\Models\BreadcrumbLink;

class BannerAuthor implements IComponent
{
	/**
	 * The author (user) id used to source banner settings from
	 *
	 * @var integer
	 */
	public int $author_id = 0;

	/**
	 * The author name
	 *
	 * @var string
	 */
	public string $author_name = '';


	public function __construct(array $params)
	{
		$this->author_id = Arrays::get_value_as_int(
			$params,
			'author_id',
			fn () => intval(get_query_var('custom_author_id'))
		);

		$this->image_url = Arrays::get_value_as_string(
			$params,
			'image_url',
			fn () => get_avatar_url($this->author_id, [
				'size' => 120
			])
		);

		$this->author_name = Arrays::get_value_as_string(
			$params,
			'author_name',
			fn () => get_the_author_meta('display_name', $this->author_id)
		);
	}

	protected function getBreadcrumbLinks(): array
	{
		$links = [];

		$resources_page_id = PageLinks::getResourcesPageId();

		if ($resources_page_id) {
			$links[] = new BreadcrumbLink(
				get_the_title($resources_page_id),
				get_the_permalink($resources_page_id)
			);
		}

		return $links;
	}

	public function render(): void
	{
		$author_bio = get_the_author_meta('description', $this->author_id);

		$banner_classes = [
			'banner',
			'banner-author',
			'banner--bottom-arc',
			'banner--bottom-arc-white',
			'bg-black'
		];

		if ($author_bio) {
			$banner_classes[] = 'banner-author--has-bio';
		}

?>
		<div class="<?php echo esc_attr(implode(' ', $banner_classes)); ?>">
			<div class="banner-author__inner contain layout__padded-columns">
				<div class="banner-author__text-content">
					<?php if($this->image_url){ ?>
					<img class="banner-author__image" src="<?php echo esc_url($this->image_url); ?>">
					<?php } ?>
					<h1 class="banner-author__name"><?php echo esc_html($this->author_name); ?></h1>
					<?php
					if ($author_bio) {
					?>
						<div class="wysiwyg">
							<?php echo wp_kses_post(wpautop($author_bio)); ?>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
<?php
	}
}
