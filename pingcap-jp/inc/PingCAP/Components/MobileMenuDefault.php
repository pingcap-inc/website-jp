<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Menus, MenuDropdowns, SVG};
use PingCAP\Constants;

class MobileMenuDefault implements IComponent
{
	public array $primary_links = [];
	public array $secondary_links = [];

	public function __construct(array $params)
	{
		$this->primary_links = Arrays::get_value_as_array(
			$params,
			'primary_links',
			fn () => Menus::get_for_location(Constants\Menus::MOBILE_PRIMARY_MENU, [], 0)
		);

		$this->secondary_links = Arrays::get_value_as_array(
			$params,
			'secondary_links',
			fn () => Menus::get_for_location(Constants\Menus::MOBILE_SECONDARY_MENU, [], 0)
		);
	}

	public function render(): void
	{
		$field_id = uniqid('mobile_menu_');

?>
		<div class="mobile-menu mobile-menu-default">
			<nav class="mobile-menu-default__primary-links">
				<?php
				foreach ($this->primary_links as $link) {
					$title = trim($link->title ?? '');
					$url = trim($link->url ?? '');
					$dropdown_id = intval($link->dropdown_id ?? '0');

					if (!$title || (!$dropdown_id && !$url)) {
						continue;
					}

				?>
					<div class="mobile-menu-default__primary-group">
						<?php
						if ($dropdown_id) {
							$section_id = $field_id . '_' . $dropdown_id;

						?>
							<input style="display: none;" type="checkbox" name="<?php echo esc_attr($field_id); ?>" id="<?php echo esc_attr($section_id); ?>" class="mobile-menu-default__primary-title-input">
							<label class="mobile-menu-default__primary-title-label" for="<?php echo esc_attr($section_id); ?>">
								<span class="mobile-menu-default__primary-button-text">
									<?php echo esc_html($title); ?>
								</span>
								<?php SVG::the_svg('general/chevron-down', ['class' => 'mobile-menu-default__primary-button-icon']); ?>
							</label>
						<?php

							MenuDropdowns::render_now($dropdown_id, [
								'render_file_name' => 'render_mobile',
								'section' => 'mobile'
							]);
						} else {
						?>
							<a class="mobile-menu-default__primary-link" href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a>
						<?php
						}
						?>
					</div>
				<?php
				}
				?>
			</nav>
			<nav class="mobile-menu-default__secondary-links">
				<?php
				foreach ($this->secondary_links as $link) {
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
			<div class="mobile-menu-default__menu-cta">
				<a href="/contact-us/" data-gtag="event:go_to_lead_form_page,button_name:Book a Demo,position:header" class="button button-blue-outline dropdown-menu-activate">
					お問い合わせ
				</a>
				<a href="https://tidbcloud.com/free-trial/" data-gtag="event:event:go_to_cloud_signup,button_name:Start Free,product_type:serverless,position:header" class="button dropdown-menu-activate">
					無料で始める
				</a>
			</div>
		</div>
<?php
	}
}
