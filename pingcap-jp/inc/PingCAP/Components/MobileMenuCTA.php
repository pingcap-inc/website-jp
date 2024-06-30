<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, MenuDropdowns };

class MobileMenuCTA implements IComponent
{
	/**
	 * The CTA dropdown menu ID
	 *
	 * @var integer
	 */
	public int $cta_dropdown_menu_id = 0;


	public function __construct(array $params)
	{
		$this->cta_dropdown_menu_id = Arrays::get_value_as_int($params, 'cta_dropdown_menu_id');
	}

	public function render(): void
	{
		if (!$this->cta_dropdown_menu_id) {
			return;
		}

		?>
		<div class="mobile-menu mobile-menu-cta bg-black">
			<div class="mobile-menu-cta__inner">
				<?php MenuDropdowns::render_now($this->cta_dropdown_menu_id); ?>
			</div>
		</div>
		<?php
	}
}
