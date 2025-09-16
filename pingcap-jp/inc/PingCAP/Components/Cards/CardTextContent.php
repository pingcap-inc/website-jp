<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, SVG};
use Blueprint\Images;

class CardTextContent implements IComponent
{
	public $svg_icon = null;
	public string $image_position = '';
	public string $border_color = '';
	public string $label = '';
	public string $title = '';
	public string $content = '';
	public string $link_text = '';
	public string $link_url = '';
	public bool $hide_content = false;

	public function __construct(array $params)
	{
		$this->hide_content = Arrays::get_value_as_bool($params, 'hide_content');
		$this->svg_icon = Arrays::get_value_as_array($params, 'svg_icon');
		$this->image_position = Arrays::get_value_as_string($params, 'image_position');
		$this->border_color = Arrays::get_value_as_string($params, 'border_color');
		$this->label = Arrays::get_value_as_string($params, 'label');
		$this->title = Arrays::get_value_as_string($params, 'title');
		$this->content = Arrays::get_value_as_string($params, 'content');
		$this->link_text = Arrays::get_value_as_string($params, 'link_text');
		$this->link_url = Arrays::get_value_as_string($params, 'link_url');
	}

	public function render(): void
	{
		$classes = ['card-text-content'];

		if ($this->hide_content) {
			$classes[] = 'hide-content';
		}

		if ($this->border_color) {
			$classes[] = $this->border_color;
		}
?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">

			<?php if ($this->label) { ?>
				<p class="card-text-content__label"><?php echo $this->label ?></p>
			<?php } ?>

			<div class="card-text-content__title-container <?php echo $this->image_position; ?>">
				<?php
				if ($this->svg_icon) {
					Images::safe_image_output($this->svg_icon, [
						'class' => 'card-text-content__icon',
					]);
					// SVG::the_svg($this->svg_icon, ['class' => 'card-text-content__icon']);
				}
				?>
				<h5 class="card-text-content__title"><?php echo esc_html($this->title); ?></h5>
			</div>
			<div class="card-text-content__content">
				<?php echo wp_kses_post(wpautop($this->content)); ?>
			</div>
			<?php
			if ($this->link_text && $this->link_url) {
			?>
				<a class="button button--secondary card-text-content__link" href="<?php echo esc_url($this->link_url); ?>"><?php echo esc_html($this->link_text); ?></a>
			<?php
			}
			?>
		</div>
<?php
	}
}
