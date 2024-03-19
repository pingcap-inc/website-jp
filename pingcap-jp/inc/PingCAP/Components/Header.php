<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Menus, MenuDropdowns, SVG};
use WPUtil\Vendor\ACF;
use PingCAP\{Components, Constants, Logo};
use Blueprint\Images;

class Header implements IComponent
{
	public array $primary_links = [];
	public array $secondary_links = [];
	public string $cta_button_text = '';
	public int $cta_dropdown_menu_id = 0;

	public function __construct(array $params)
	{
		$this->primary_links = Arrays::get_value_as_array(
			$params,
			'primary_links',
			fn () => Menus::get_for_location(Constants\Menus::DESKTOP_PRIMARY_MENU, [], 0)
		);

		$this->secondary_links = Arrays::get_value_as_array(
			$params,
			'secondary_links',
			fn () => Menus::get_for_location(Constants\Menus::DESKTOP_SECONDARY_MENU, [], 0)
		);

		$this->cta_button_text = Arrays::get_value_as_string(
			$params,
			'cta_button_text',
			fn () => ACF::get_field_string(
				Constants\ACF::THEME_OPTIONS_HEADER_BASE . '_cta_button_text',
				'option'
			)
		);

		$this->cta_dropdown_menu_id = Arrays::get_value_as_int(
			$params,
			'cta_dropdown_menu_id',
			fn () => ACF::get_field_int(
				Constants\ACF::THEME_OPTIONS_HEADER_BASE . '_cta_dropdown_menu_id',
				'option'
			)
		);
	}

	public function render(): void
	{
?>
		<header class="site-header-wrapper">
			<div class="site-header__top">
				<div class="contain">
					<nav class="site-header__top-menu">
						<a href="https://tidbcloud.com/signin" data-gtag="event:signin_click,position:header"><span class="site-header__top-menu-icon ph-user-circle-thin"></span>Sign In</a>
					</nav>
				</div>
			</div>
			<div class="site-header bg-black">
				<div class="site-header__inner contain">
					<div class="site-header__logo-container">
						<a href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(bloginfo('name')); ?>" aria-label="Home">
							<img class="site-header__logo" src="https://static.pingcap.com/files/2022/09/25230007/PingCAP-logo.png" alt="PingCAP logo" />
						</a>
					</div>
					<div class="site-header__menu">
						<nav class="site-header__menu-primary">
							<?php
							foreach ($this->primary_links as $link) {
								$title = trim($link->title ?? '');
								$url = trim($link->url ?? '');
								$dropdown_id = intval($link->dropdown_id ?? '0');
								$dropdown_classes = ['site-header__dropdown-menu-container'];
								$template_name = ACF::get_field_string('template', $dropdown_id);

								if (!$title || (!$dropdown_id && !$url)) {
									continue;
								}

								if ($template_name === 'columns') {
									$dropdown_classes = ['site-header__dropdown-menu-container', 'site-header__dropdown-menu-container-relative'];
								}

								if ($dropdown_id) {
							?>
									<div class="<?php echo esc_attr(implode(' ', $dropdown_classes)); ?>">
										<a class="site-header__primary-menu-link" href="<?php echo esc_url($url); ?>" data-dropdown-id="<?php echo esc_attr($dropdown_id); ?>">
											<?php echo esc_html($title); ?>
										</a>
										<?php MenuDropdowns::render_now($dropdown_id); ?>
									</div>
								<?php
								} else {
								?>
									<a class="site-header__primary-menu-link" href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a>
							<?php
								}
							}
							?>
						</nav>
						<div class="site-header__menu-cta">
							<a href="/contact-us/" data-gtag="event:go_to_lead_form_page,button_name:Book a Demo,position:header" class="button button-blue-outline dropdown-menu-activate">
								お問い合わせ
							</a>
							<a href="/get-started-tidb/" data-gtag="event:start_button_click,button_name:Start Instantly,position:header" class="button dropdown-menu-activate">
								今すぐ始める
							</a>
						</div>
					</div>
					<button class="site-header__mobile-menu-button" type="button" aria-label="Menu">
						<span class="site-header__mobile-menu-button-box">
							<span class="site-header__mobile-menu-button-inner"></span>
						</span>
					</button>
				</div>
			</div>
		</header>
<?php

		Component::render(Components\MobileMenuDefault::class);

		if ($this->cta_dropdown_menu_id) {
			Component::render(Components\MobileMenuCTA::class, [
				'cta_dropdown_menu_id' => $this->cta_dropdown_menu_id
			]);
		}
	}
}
