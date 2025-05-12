<?php
namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use Blueprint\Images;
use PingCAP\{ CPT, Taxonomies };

class CardCustomer implements IComponent
{
	/**
	 * The customer term id
	 *
	 * @var integer
	 */
	public int $customer_term_id = 0;

	/**
	 * The customer name
	 *
	 * @var string
	 */
	public string $customer_name = '';

	/**
	 * The customer description
	 *
	 * @var string
	 */
	public string $customer_description = '';

	/**
	 * The customer logo
	 *
	 * @var null|string|integer|array<string, mixed>
	 */
	public $customer_logo = null;

	/**
	 * CardCustomer constructor
	 *
	 * @param array<string, mixed> $params
	 */
	public function __construct(array $params)
	{
		$this->customer_term_id = Arrays::get_value_as_int($params, 'customer_term_id');

		$this->customer_name = Arrays::get_value_as_string($params, 'customer_name', function () {
			$customer_term = CPT\CaseStudy::getCustomerTerm($this->customer_term_id);

			return $customer_term->name ?? '';
		});

		$this->customer_description = Arrays::get_value_as_string($params, 'customer_description', function () {
			$customer_term = CPT\CaseStudy::getCustomerTerm($this->customer_term_id);

			return $customer_term->description ?? '';
		});

		$this->customer_logo = $params['customer_logo'] ?? ($this->customer_term_id ? Taxonomies\Customer::getLogoImageACFObject($this->customer_term_id) : null);
	}

	public function render(): void
	{
		?>
		<div class="card-customer">
			<?php
			if ($this->customer_logo)
			{
				$image_params = [
					'class' => 'card-customer__image'
				];

				?>
				<div class="card-customer__image-container">
					<?php Images::safe_image_output($this->customer_logo, $image_params); ?>
				</div>
				<?php
			}
			?>
			<h5 class="card-customer__customer-name"><?php echo esc_html($this->customer_name); ?></h5>
			<?php
			if ($this->customer_description)
			{
				?>
				<span class="card-customer__customer-description">
					<?php echo wp_kses_post($this->customer_description); ?>
				</span>
				<?php
			}
			?>
		</div>
		<?php
	}
}
