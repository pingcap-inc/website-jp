<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Component };
use Blueprint\Images;
use PingCAP\Components;

class CardIllustration implements IComponent
{
	/**
	 * The illustration file info object returned from ACF
	 *
	 * @var array<string, mixed>
	 */
	public array $illustration_file_info = [];

	/**
	 * The illustration card title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The illustration card permalink
	 *
	 * @var string
	 */
	public string $permalink = '';


	public function __construct(array $params)
	{
		$this->illustration_file_info = Arrays::get_value_as_array($params, 'illustration_file_info');
		$this->title = Arrays::get_value_as_string($params, 'title');
		$this->permalink = Arrays::get_value_as_string($params, 'permalink');
	}

	public function render(): void
	{
		?>
		<a class="card-illustration bg-white ignore-link-styles" href="<?php echo esc_url($this->permalink); ?>">
			<?php
			Component::render(Components\Illustration::class, [
				'illustration_file_info' => $this->illustration_file_info,
				'image_classes' => ['card-illustration__image'],
				'video_classes' => ['card-illustration__video']
			]);
			?>
			<h5 class="card-illustration__title"><?php echo esc_html($this->title); ?></h5>
		</a>
		<?php
	}
}
