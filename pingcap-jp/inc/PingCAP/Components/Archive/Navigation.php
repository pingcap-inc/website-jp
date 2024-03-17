<?php
namespace PingCAP\Components\Archive;

use WPUtil\Interfaces\IComponent;
use PingCAP\Constants;

class Navigation implements IComponent
{
	public function __construct(array $params)
	{
		add_filter('next_posts_link_attributes', function ($atts) {
			return 'class="archive-navigation__link archive-navigation__link--next"';
		});

		add_filter('previous_posts_link_attributes', function ($atts) {
			return 'class="archive-navigation__link archive-navigation__link--prev"';
		});
	}

	/**
	 * Generate an array of nav links from the provided wp_query object
	 *
	 * @param object $wp_query_obj
	 * @return array<string>
	 */
	protected function getNavLinks($wp_query_obj): array
	{
		$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
		$max = intval($wp_query_obj->max_num_pages);

		$link_nums = [];
		$link_items = [];

		// Add current page to the array
		if ($paged >= 1) {
			$link_nums[] = $paged;
		}

		// Add the pages around the current page to the array
		if ($paged >= 2) {
			$link_nums[] = $paged - 1;
		}

		if (($paged + 1) <= $max) {
			$link_nums[] = $paged + 1;
		}

		// Previous Post Link
		if (get_previous_posts_link()) {
			$link_items[] = get_previous_posts_link(__('Previous', Constants\TextDomains::DEFAULT));
		}

		// Link to first page, plus ellipses if necessary
		if (!in_array(1, $link_nums, true)) {
			$classes = [
				'archive-navigation__link',
				'archive-navigation__link--num'
			];

			if ($paged === 1) {
				$classes[] = 'archive-navigation__link--active';
			}

			$link_items[] = sprintf('<a class="%s" href="%s">%s</a>', implode(' ', $classes), esc_url(get_pagenum_link(1)), '1');

			if (!in_array(2, $link_nums, true)) {
				$link_items[] = '<span class="archive-navigation__ellipsis">&hellip;</span>';
			}
		}

		// Link to current page, plus 2 pages in either direction if necessary
		sort($link_nums);

		foreach ($link_nums as $link_num) {
			$classes = [
				'archive-navigation__link',
				'archive-navigation__link--num'
			];

			if ($paged === $link_num) {
				$classes[] = 'archive-navigation__link--active';
			}

			$link_items[] = sprintf('<a class="%s" href="%s">%s</a>', implode(' ', $classes), esc_url(get_pagenum_link($link_num)), $link_num);
		}

		// Link to last page, plus ellipses if necessary
		if (!in_array($max, $link_nums, true)) {
			if (!in_array($max - 1, $link_nums, true)) {
				$link_items[] = '<span class="archive-navigation__ellipsis">&hellip;</span>';
			}

			$classes = [
				'archive-navigation__link',
				'archive-navigation__link--num'
			];

			if ($paged === $max) {
				$classes[] = 'archive-navigation__link--active';
			}

			$link_items[] = sprintf('<a class="%s" href="%s">%s</a>', implode(' ', $classes), esc_url(get_pagenum_link($max)), $max);
		}

		// Next Post Link
		if (get_next_posts_link()) {
			$link_items[] = get_next_posts_link(__('Next', Constants\TextDomains::DEFAULT));
		}

		return $link_items;
	}

	public function render(): void
	{
		global $wp_query;

		if (is_singular() || $wp_query->max_num_pages <= 1) {
			return;
		}

		$links = $this->getNavLinks($wp_query);

		?>
		<div class="archive-navigation contain">
			<?php echo wp_kses_post(implode('', $links)); ?>
		</div>
		<?php
	}
}
