<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use PingCAP\Models\BreadcrumbLink;
use PingCAP\Constants;

class Breadcrumbs implements IComponent
{
	/**
	 * Array of BreadcrumbLink objects
	 *
	 * @var array<\PingCAP\Models\BreadcrumbLink>
	 */
	public array $links = [];


	public function __construct(array $params)
	{
		$this->links = Arrays::get_value_as_array($params, 'links');

		$add_home = Arrays::get_value_as_bool($params, 'add_home', true);

		if ($add_home) {
			$home_label = Arrays::get_value_as_string($params, 'home_label', __('Home', Constants\TextDomains::DEFAULT));

			$this->links = [
				new BreadcrumbLink($home_label, home_url('/')),
				...$this->links
			];
		}
	}

	public function render(): void
	{
		if (!count($this->links)) {
			return;
		}

		?>
		<nav class="banner__breadcrumbs">
			<?php
			foreach ($this->links as $link)
			{
				?>
				<span class="banner__breadcrumbs-item">
					<a class="banner__breadcrumbs-link" href="<?php echo esc_url($link->link); ?>"><?php echo esc_html($link->label); ?></a>
				</span>
				<?php
			}
			?>
		</nav>
		<?php
	}
}
