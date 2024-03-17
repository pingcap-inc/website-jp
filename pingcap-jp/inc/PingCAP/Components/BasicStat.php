<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;

class BasicStat implements IComponent
{
	public string $value = '';
	public string $description = '';

	public function __construct(array $params)
	{
		$this->value = Arrays::get_value_as_string($params, 'value');
		$this->description = Arrays::get_value_as_string($params, 'description');
	}

	public function render(): void
	{
		?>
		<div class="basic-stat">
			<h2 class="basic-stat__value"><?php echo esc_html($this->value); ?></h2>
			<p class="basic-stat__desc"><?php echo esc_html($this->description); ?></p>
		</div>
		<?php
	}
}
