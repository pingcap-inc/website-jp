<?php
namespace PingCAP\Components\UI;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, SVG, Util };
use PingCAP\Constants;
use Blueprint\SocialShare;

class ShareIcon implements IComponent
{
	/**
	 * The post id that will be used in the generated share link
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * The social media site title. This will be used in the "aria-label" attribute.
	 *
	 * @var string
	 */
	public string $site = '';

	/**
	 * The social media site slug name. This will be used in the "data-social-share" attribute.
	 *
	 * @var string
	 */
	public string $site_slug = '';

	/**
	 * An array of classnames used by the link anchor element
	 *
	 * @var array<string>
	 */
	public array $button_classes = [];


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
		$this->site = Arrays::get_value_as_string($params, 'site', __('Social Media', Constants\TextDomains::DEFAULT));
		$this->site_slug = Arrays::get_value_as_string($params, 'site_slug', sanitize_title(strtolower($this->site)));

		$add_button_classes = Arrays::get_value_as_array($params, 'add_button_classes');

		$this->button_classes = array_merge([
			'share-icon',
			'share-icon--' . $this->site_slug
		], $add_button_classes);
	}

	public function render(): void
	{
		$attrs_str = Util::attributes_array_to_string([
			'data-social-share' => $this->site_slug,
			'aria-label' => __('Share on', Constants\TextDomains::DEFAULT) . ' ' . $this->site
		]);

		?>
		<a class="<?php echo esc_attr(implode(' ', $this->button_classes)); ?>" href="<?php echo esc_url(SocialShare::get_social_share_link($this->site_slug, $this->post_id)); ?>" <?php echo $attrs_str; // phpcs:ignore ?>>
			<?php SVG::the_svg('social/' . $this->site_slug, ['class' => 'share-icon__icon']); ?>
		</a>
		<?php
	}
}
