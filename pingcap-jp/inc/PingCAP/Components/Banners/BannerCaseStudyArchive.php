<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Taxonomy};
use PingCAP\{Components, Constants, CPT};
use PingCAP\Models\BreadcrumbLink;

class BannerCaseStudyArchive implements IComponent
{
	/**
	 * The banner title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The banner heading text
	 *
	 * @var string
	 */
	public string $heading_text = '';

	/**
	 * The banner has filters
	 *
	 * @var bool
	 */
	public bool $has_filters = false;


	public function __construct(array $params)
	{
		$this->title = Arrays::get_value_as_string($params, 'title', fn() => CPT\CaseStudy::getArchiveTitle());
		$this->heading_text = Arrays::get_value_as_string($params, 'heading_text', fn() => CPT\CaseStudy::getArchiveHeadingText());
	}

	protected function getValidPostIds(): array
	{
		$post_ids = get_posts([
			'fields' => 'ids',
			'post_type' => Constants\CPT::CASE_STUDY,
			'post_status' => 'publish',
			'posts_per_page' => -1
		]);

		return $post_ids;
	}

	protected function getBreadcrumbLinks(): array
	{
		$links = [];

		$archive_link = get_post_type_archive_link(Constants\CPT::CASE_STUDY);

		if ($archive_link) {
			$links[] = new BreadcrumbLink($this->title, $archive_link);
		}

		return $links;
	}

	public function render(): void
	{

?>
		<div class="banner banner-case-study-archive bg-black-dark">
			<div class="banner-case-study-archive__inner contain">
				<h1 class="banner-case-study-archive__title"><?php echo esc_html($this->title); ?></h1>
				<?php
				if ($this->heading_text) {
				?>
					<div class="banner-case-study-archive__heading-text"><?php echo esc_html($this->heading_text); ?></div>
				<?php
				}
				?>
			</div>
		</div>
<?php
	}
}
