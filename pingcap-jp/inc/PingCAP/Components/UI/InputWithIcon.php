<?php
namespace PingCAP\Components\UI;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, SVG, Util };

class InputWithIcon implements IComponent
{
	public int $is_form = 0;
	public string $icon = '';
	public array $container_attrs = [];
	public array $container_classes = [];
	public array $input_attrs = [];
	public array $input_classes = [];
	public array $icon_container_attrs = [];
	public array $icon_container_classes = [];
	public array $icon_classes = [];

	public function __construct(array $params)
	{
		$this->is_form = Arrays::get_value_as_int($params, 'is_form', 0);
		$this->icon = Arrays::get_value_as_string($params, 'icon', 'general/chevron-right');

		$add_container_attrs = Arrays::get_value_as_array($params, 'add_container_attrs');
		$add_container_classes = Arrays::get_value_as_array($params, 'add_container_classes');
		$add_input_attrs = Arrays::get_value_as_array($params, 'add_input_attrs');
		$add_input_classes = Arrays::get_value_as_array($params, 'add_input_classes');
		$add_icon_container_attrs = Arrays::get_value_as_array($params, 'add_icon_container_attrs');
		$add_icon_container_classes = Arrays::get_value_as_array($params, 'add_icon_container_classes');
		$add_icon_classes = Arrays::get_value_as_array($params, 'add_icon_classes');

		$this->container_classes = array_merge([
			'input-with-icon'
		], $add_container_classes);

		$this->input_classes = array_merge([
			'input-with-icon__input'
		], $add_input_classes);

		$this->icon_container_classes = array_merge([
			'input-with-icon__submit'
		], $add_icon_container_classes);

		$default_container_attrs = [
			'class' => implode(' ', $this->container_classes)
		];

		if ($this->is_form) {
			if('post' == get_post_type()) {
				$default_container_attrs['action'] = esc_url(get_post_type_archive_link( 'post' ));
			}elseif (is_post_type_archive('event')){
				$default_container_attrs['action'] = esc_url(get_post_type_archive_link( 'event' ));
			}elseif (is_post_type_archive('partner')){
				$default_container_attrs['action'] = esc_url(get_post_type_archive_link( 'partner' ));
			}else{
				$default_container_attrs['action'] = esc_url(home_url());
			}
			
			$default_container_attrs['method'] = 'get';
		}

		$this->container_attrs = array_merge($default_container_attrs, $add_container_attrs);

		$this->input_attrs = array_merge([
			'type' => 'text',
			'name' => 's',
			'class' => implode(' ', $this->input_classes)
		], $add_input_attrs);

		$initial_icon_container_attrs = [];

		if ($this->is_form) {
			$initial_icon_container_attrs['type'] = 'submit';
		}

		$this->icon_container_attrs = array_merge([
			'class' => implode(' ', $this->icon_container_classes)
		], $initial_icon_container_attrs, $add_icon_container_attrs);

		$this->icon_classes = array_merge([
			'input-with-icon__icon'
		], $add_icon_classes);
	}

	public function render(): void
	{
		$tag_container = $this->is_form ? 'form' : 'div';
		$tag_icon = $this->is_form ? 'button' : 'div';

		?>
		<<?php echo esc_attr($tag_container); ?> <?php echo Util::attributes_array_to_string($this->container_attrs); // phpcs:ignore ?>>
			<input <?php echo Util::attributes_array_to_string($this->input_attrs); // phpcs:ignore ?> />
			<<?php echo esc_attr($tag_icon); ?> <?php echo Util::attributes_array_to_string($this->icon_container_attrs); // phpcs:ignore ?>>
				<?php SVG::the_svg($this->icon, ['class' => implode(' ', $this->icon_classes)]); ?>
			</<?php echo esc_attr($tag_icon); ?>>
			<?php
			if ($this->is_form)
			{
				?>
				<span class="ui__spin-loader"></span>
				<?php
			}
			?>
		</<?php echo esc_attr($tag_container); ?>>
		<?php
	}
}
