<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{ Arrays, Component };
use WPUtil\Vendor\ACF;
use Blueprint\Images;
use PingCAP\{ Components, Constants, CPT, Taxonomies };

class CardCaseStudy implements IComponent
{
	/**
	 * The case study post id
	 *
	 * @var integer
	 */
	public int $post_id = 0;

	/**
	 * The case study title
	 *
	 * @var string
	 */
	public string $title = '';

	/**
	 * The case study permalink
	 *
	 * @var string
	 */
	public string $permalink = '';

	/**
	 * The card button text
	 *
	 * @var string
	 */
	public string $button_text = '';

	/**
	 * The customer name
	 *
	 * @var string
	 */
	public string $customer_name = '';

	/**
	 * The customer logo
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $customer_logo = null;

	/**
	 * Flag indicating that this is a featured case study post card
	 *
	 * @var boolean
	 */
	public bool $is_featured = false;

	public string $featured_content_type = '';
	public int $featured_testimonial_id = 0;
	public array $featured_stats = [];


	public function __construct(array $params)
	{
		$this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());

		$customer_term = CPT\CaseStudy::getCustomerTerm($this->post_id);

		$this->title = Arrays::get_value_as_string($params, 'title', fn () => get_the_title($this->post_id));
		$this->permalink = Arrays::get_value_as_string($params, 'permalink', fn () => get_the_permalink($this->post_id));
		$this->button_text = Arrays::get_value_as_string($params, 'button_text', __('View Case Study', Constants\TextDomains::DEFAULT));
		$this->customer_name = Arrays::get_value_as_string($params, 'customer_name', $customer_term->name ?? '');
		$this->customer_logo = $params['customer_logo'] ?? ($customer_term ? Taxonomies\Customer::getLogoImageACFObject($customer_term->term_id) : null);
		$this->is_featured = Arrays::get_value_as_bool($params, 'is_featured', false);

		if ($this->is_featured) {
			$this->featured_content_type = Arrays::get_value_as_string(
				$params,
				'featured_content_type',
				fn () => ACF::get_field_string('featured_content_type', $this->post_id)
			);

			switch ($this->featured_content_type) {
				case 'testimonial':
					$this->featured_testimonial_id = Arrays::get_value_as_int(
						$params,
						'featured_testimonial_id',
						fn () => ACF::get_field_int('featured_testimonial_id', $this->post_id)
					);

					break;

				case 'stats':
					$this->featured_stats = Arrays::get_value_as_array(
						$params,
						'featured_stats',
						fn () => ACF::get_field_array('featured_stats', $this->post_id)
					);

					break;

				default:
					break;
			}
		}
	}

	public function render(): void
	{
		$container_classes = ['card-case-study', 'bg-white'];

		if ($this->is_featured) {
			$container_classes[] = 'card-case-study--featured';
		}

		$button_classes = ['card-case-study__button button'];

		if (!$this->is_featured) {
			$button_classes[] = 'button--secondary';
		}

		?>
		<a class="<?php echo esc_attr(implode(' ', $container_classes)); ?>" href="<?php echo esc_url($this->permalink); ?>">
			<?php
			if ($this->customer_logo)
			{
				$image_params = [
					'class' => 'card-case-study__image'
				];

				if ($this->is_featured) {
					$image_params['data-ib-no-cache'] = 1;
				}

				?>
				<div class="card-case-study__image-container">
					<?php Images::safe_image_output($this->customer_logo, $image_params); ?>
				</div>
				<?php
			}

			if ($this->is_featured)
			{
				?>
				<h5 class="card-case-study__title-featured"><?php echo esc_html($this->title); ?></h5>
				<?php

				switch ($this->featured_content_type)
				{
					case 'testimonial':
						if ($this->featured_testimonial_id)
						{
							$content = CPT\Testimonial::getTestimonial($this->featured_testimonial_id);
							$attribution = CPT\Testimonial::getAttribution($this->featured_testimonial_id);

							Component::render(Components\Testimonial::class, [
								'content' => $content,
								'attribution' => $attribution
							]);
						}

						break;

					case 'stats':
						if ($this->featured_stats)
						{
							?>
							<div class="card-case-study__stats-container">
								<?php
								foreach ($this->featured_stats as $stat)
								{
									Component::render(Components\BasicStat::class, [
										'value' => Arrays::get_value_as_string($stat, 'stat_value'),
										'description' => Arrays::get_value_as_string($stat, 'stat_desc')
									]);
								}
								?>
							</div>
							<?php
						}

						break;

					default:
						break;
				}
			}
			else
			{
				?>
				<h5 class="card-case-study__customer-name"><?php echo esc_html($this->customer_name); ?></h5>
				<span class="card-case-study__title"><?php echo esc_html($this->title); ?></span>
				<?php
			}
			?>
			<span class="<?php echo esc_attr(implode(' ', $button_classes)); ?>"><?php echo esc_html($this->button_text); ?></span>
		</a>
		<?php
	}
}
