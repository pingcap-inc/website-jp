<?php

namespace PingCAP\Components\Banners;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component};
use PingCAP\{Components, Constants};

class BannerResource implements IComponent
{
	/**
	 * The post id used to source banner settings from
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * The banner title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The banner date
	 *
	 * @var string
	 */
	public string $date = '';

	/**
	 * The banner post type is authors type
	 *
	 * @var boolean
	 */
	public bool $is_author_post_type = false;

	/**
	 * The banner authors
	 *
	 * @var array
	 */
	public array $additional_author_ids = [];


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
		$this->post_type = get_post_type($this->post_id);
		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
		$this->date = Arrays::get_value_as_string($params, 'date', fn () => get_the_time('Y-m-d', $this->post_id));
		$this->is_author_post_type = Arrays::get_value_as_bool($params, 'is_author_post_type', false);
		$this->additional_author_ids = Arrays::get_value_as_array($params, 'additional_author_ids', []);
		$this->no_category_post_types = [
			Constants\CPT::EVENT,
		];
	}

	public function render(): void
	{
		$cat_terms = get_the_category($this->post_id);

?>
		<div class="banner banner-resource banner--bottom-arc banner--bottom-arc-white bg-black">
			<div class="banner-resource__inner contain layout__padded-columns layout__padded-columns--double">
				<div class="banner-resource__text-content">
					<h1 class="banner-resource__title"><?php echo esc_html($this->title); ?></h1>
					<?php
					if ($this->date || $cat_terms) {
					?>
						<div class="banner-resource__meta wysiwyg">
							<?php
							if ($this->date) {
							?>
								<span class="banner-resource__meta-date"><?php echo esc_html($this->date); ?></span>
								<?php
							}
							if (!in_array($this->post_type, $this->no_category_post_types, true)) {
								foreach ($cat_terms as $term) {
									$term_url = get_term_link($term, Constants\Taxonomies::BLOG_CATEGORY);

									if (!is_string($term_url)) {
										continue;
									}

								?>
									<a class="banner-resource__meta-cat" href="<?php echo esc_url($term_url); ?>"><?php echo esc_html($term->name); ?></a>
							<?php
								}
							}
							?>
						</div>
					<?php
					}
					?>

					<?php
					if ($this->is_author_post_type) {
					?>
						<div class="banner-resource__authors">
							<?php
							Component::render(Components\AuthorBox::class);

							foreach ($this->additional_author_ids as $additional_author_id) {
								Component::render(Components\AuthorBox::class, [
									'author_id' => $additional_author_id
								]);
							}
							?>
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
