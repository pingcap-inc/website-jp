<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component, Menus, MenuDropdowns, SVG};
use WPUtil\Vendor\{ACF};
use PingCAP\{Components, Constants};

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
			fn() => Menus::get_for_location(Constants\Menus::DESKTOP_PRIMARY_MENU, [], 0)
		);

		$this->secondary_links = Arrays::get_value_as_array(
			$params,
			'secondary_links',
			fn() => Menus::get_for_location(Constants\Menus::DESKTOP_SECONDARY_MENU, [], 0)
		);

		$this->cta_button_text = Arrays::get_value_as_string(
			$params,
			'cta_button_text',
			fn() => ACF::get_field_string(
				Constants\ACF::THEME_OPTIONS_HEADER_BASE . '_cta_button_text',
				'option'
			)
		);

		$this->cta_dropdown_menu_id = Arrays::get_value_as_int(
			$params,
			'cta_dropdown_menu_id',
			fn() => ACF::get_field_int(
				Constants\ACF::THEME_OPTIONS_HEADER_BASE . '_cta_dropdown_menu_id',
				'option'
			)
		);

		$this->hello_bar = ACF::get_field_bool(
			Constants\ACF::THEME_OPTIONS_HELLO_BAR . '_enable_hello_bar',
			'option'
		);

		$this->hello_bar_bg = ACF::get_field_string(
			Constants\ACF::THEME_OPTIONS_HELLO_BAR . '_hello_bar_bg',
			'option'
		);

		$this->hello_bar_text = ACF::get_field_string(
			Constants\ACF::THEME_OPTIONS_HELLO_BAR . '_hello_bar_text',
			'option'
		);

		$this->hello_bar_button = ACF::get_field_array(
			Constants\ACF::THEME_OPTIONS_HELLO_BAR . '_hello_bar_link',
			'option'
		);
	}

	public function render(): void
	{
?>
		<?php
		if ($this->hello_bar) {
			$link_target = $this->hello_bar_button['target'] ? $this->hello_bar_button['target'] : '_self';
		?>
			<div class="site-header__hello-bar <?php echo $this->hello_bar_bg; ?> active">
				<a class="site-header__hello-bar-inner contain" href="<?php echo $this->hello_bar_button['url']; ?>" target="<?php echo esc_attr($link_target); ?>">
					<?php echo $this->hello_bar_text; ?><span class="button-link"><?php echo $this->hello_bar_button['title']; ?><i class="button__arrow"></i></span>
				</a>
			</div>
		<?php
		}
		?>
		<header class="site-header-wrapper">
			<div class="site-header">
				<div class="site-header__inner contain">
					<div class="site-header__logo-container">
						<a href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(bloginfo('name')); ?>" aria-label="Home">
							<?php SVG::the_svg('general/logo', ['class' => 'site-header__logo-image']); ?>
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
					</div>
					<div class="site-header__cta-container">
						<a href="https://tidbcloud.com/signin" data-gtag="event:signin_click,position:header" class="site-header__secondary-menu-link">Sign In</a>
						<a href="https://tidbcloud.com/free-trial/" data-gtag="event:go_to_cloud_signup,product_type:serverless,button_name:Start for Free,position:header" class="button-primary sm"><span>Start for Free</span><i class="button__arrow"></i></a>
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
	}
}
