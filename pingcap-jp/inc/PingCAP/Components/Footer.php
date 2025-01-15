<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Menus, SVG};
use WPUtil\Vendor\ACF;
use PingCAP\{Constants, Logo};
use PingCAP\Models\{FooterLink, FooterLinksGroup};
use Blueprint\Images;

class Footer implements IComponent
{
	public string $copyright_text = '';
	public array $social_links = [];
	public array $column_link_groups = [];
	public array $legal_links = [];

	public function __construct(array $params)
	{
		$this->copyright_text = Arrays::get_value_as_string(
			$params,
			'copyright_text',
			fn() => ACF::get_field_string(Constants\ACF::THEME_OPTIONS_FOOTER_BASE . '_copyright_text', 'option')
		);

		$this->social_links = array_filter(
			ACF::get_field_array(Constants\ACF::THEME_OPTIONS_SOCIAL_BASE . '_site_links', 'option'),
			fn($icon) => $icon['title'] && $icon['url'] && $icon['icon']
		);

		$this->column_link_groups = $this->getColumnIndexedLinkGroups();

		$this->legal_links = Menus::get_for_location(Constants\Menus::FOOTER_LEGAL_MENU, [], 0);
	}

	/**
	 * Return an array of FooterLinksGroup objects
	 *
	 * @return array<\PingCAP\Models\FooterLinksGroup>
	 */
	protected function getColumnIndexedLinkGroups(): array
	{
		$cols = [[], [], [], []];

		$menu_items = Menus::get_for_location(Constants\Menus::FOOTER_LINKS_MENU);

		$menu_parents = array_filter($menu_items, function ($item) {
			return intval($item->menu_item_parent) === 0;
		});

		foreach ($menu_parents as $menu_parent) {
			$menu_parent_id = intval($menu_parent->ID);

			$child_items = array_filter($menu_items, function ($item) use ($menu_parent_id) {
				return intval($item->menu_item_parent) === $menu_parent_id;
			});

			$links_group = new FooterLinksGroup();
			$links_group->title = $menu_parent->title ?? '';

			foreach ($child_items as $child_item) {
				$link = new FooterLink();
				$link->text = $child_item->title ?? '';
				$link->url = $child_item->url ?? '';
				$link->attr_title = $child_item->attr_title ?? '';

				$links_group->items[] = $link;
			}

			$col_index = intval($menu_parent->column_index ?? '0');

			// if ($col_index < 0 || $col_index > count($cols) - 1) {
			// 	$col_index = 0;
			// }

			$cols[$col_index][] = $links_group;
		}

		return $cols;
	}

	public function render(): void
	{
		$credit_url = str_replace('https://', '', get_site_url(null, '', 'https'));

?>
		<footer class="site-footer bg-black-dark">
			<div class="contain site-footer__inner">
				<div class="site-footer__language-links">
					<div class="site-footer__language-select">
						<i class="icon-globe"></i>日本語<?php SVG::the_svg('general/chevron-down-white') ?>
					</div>
					<div class="site-footer__language-options">
						<a href="https://www.pingcap.com/">English</a>
						<a href="https://cn.pingcap.com/">中文</a>
					</div>
				</div>
				<div class="site-footer__row-top">
					<?php
					for ($i = 0; $i < 4; $i++) {
					?>
						<nav class="site-footer__col-links">
							<?php
							$links_groups = isset($this->column_link_groups[$i]) && is_array($this->column_link_groups[$i]) ? $this->column_link_groups[$i] : [];

							foreach ($links_groups as $links_group) {
							?>
								<div class="site-footer__links-group">
									<div class="site-footer__links-group-title"><?php echo esc_html($links_group->title); ?></div>
									<?php
									foreach ($links_group->items as $item) {
									?>
										<a class="site-footer__links-group-link" href="<?php echo esc_url($item->url); ?>" data-gtag="event:eng_footer_click,item_name:<?php echo $item->text; ?>">
											<?php if ($item->attr_title) {
												SVG::the_svg('social/' . $item->attr_title, ['class' => 'site-footer__social-icon']);
											} ?>
											<?php echo esc_html($item->text); ?>
										</a>
									<?php
									}
									?>
								</div>
							<?php
							}
							?>
							<?php if ($i === 0) { ?>
								<div class="site-footer__language-links">
									<div class="site-footer__language-select">
										<i class="icon-globe"></i>日本語<?php SVG::the_svg('general/chevron-down-white') ?>
									</div>
									<div class="site-footer__language-options">
										<a href="https://www.pingcap.com/">英文 </a>
										<a href="https://cn.pingcap.com/">中文</a>
									</div>
								</div>
							<?php } ?>
						</nav>
					<?php
					}
					?>

					<nav class="site-footer__col-links">
						<div class="site-footer__links-group">
							<div class="site-footer__links-group-title">TiDBの最新情報</div>
							<div class="block-cta">
								<form class="block-cta__subscribe-form" method="POST" action="https://pingcap.co.jp" data-hs-portal-id="4466002" data-hs-form-id="2857677f-c4bf-4907-9e87-3f40c09b9bb2" data-hs-name-field="" data-hs-email-field="email">
									<input type="email" name="cta_email" placeholder="ビジネスメールをご入力ください *" aria-label="Enter your email address">
								</form>
							</div>
							<p class="site-footer__links-group-tip">PingCAPの<a href="/privacy-policy/">プライバシーポリシー</a>に同意し、製品、サービス、イベント等に関する連絡を受け取ることを希望します。</p>
							<div class="site-footer__social-group">
								<?php
								foreach ($this->social_links as $item) {
								?>
									<a class="site-footer__social-group-link" href="<?php echo esc_url($item['url']); ?>">
										<?php SVG::the_svg($item['icon'], ['class' => 'site-footer__social-icon']); ?>
									</a>
								<?php
								}
								?>
							</div>
						</div>
					</nav>
				</div>
				<div class="site-footer__row-bottom">
					<div class="site-footer__legal">
						<div class="site-footer__legal-top-row">
							<span class="site-footer__copyright">&copy; <?php echo esc_html(gmdate('Y')); ?> <?php echo esc_html($this->copyright_text); ?></span>
						</div>
						<div class="site-footer__legal-bottom-row">

							<nav class="site-footer__menu-legal">
								<?php
								foreach ($this->legal_links as $link) {
									$title = trim($link->title ?? '');
									$url = trim($link->url ?? '');

									if (!$title || !$url) {
										continue;
									}

								?>
									<a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a>
								<?php
								}
								?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</footer>

<?php
	}
}
