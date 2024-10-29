<?php
namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use PingCAP\Integrations\HubSpot;
use PingCAP\Integrations\Calendly;

class HubSpotForm implements IComponent
{
	public string $portal_id = '';
	public string $form_id = '';
	public string $salesforce_id = '';
	public string $calendly_id = '';
	public string $calendly_url = '';
	public string $border = '';
	public string $message = '';
	public string $dark = '';

	public function __construct(array $params)
	{
		$this->portal_id = Arrays::get_value_as_string($params, 'portal_id');
		$this->form_id = Arrays::get_value_as_string($params, 'form_id');
		$this->salesforce_id = Arrays::get_value_as_string($params, 'salesforce_id');
		$this->calendly_id = Arrays::get_value_as_string($params, 'calendly_id');
		$this->calendly_url = Arrays::get_value_as_string($params, 'calendly_url');
		$this->border = Arrays::get_value_as_string($params, 'border');
		$this->dark = Arrays::get_value_as_string($params, 'dark');

		if (!$this->portal_id) {
			$this->message = 'portal id for hubspot form must be specified';
		} elseif (!$this->form_id) {
			$this->message = 'form id for hubspot form must be specified';
		}
	}

	public function render(): void
	{
		$form_container_class = sprintf('hs-form-container--%s-%s', esc_attr($this->form_id), uniqid());

		$form_border_class = '';
		if($this->border === 'none') {
			$form_border_class = 'has-no-border';
		}

		if ($this->portal_id && $this->form_id) {
			//HubSpot::enqueueForm($this->portal_id, $this->form_id, '.' . $form_container_class);
			HubSpot::enqueueForm($this->portal_id, $this->form_id, $this->salesforce_id, '.' . $form_container_class);
		}

		if($this->calendly_id && $this->calendly_url) {
			Calendly::enqueueForm($this->calendly_id, $this->calendly_url);
		}

		?>
		<div class="hs-form-container <?php echo $this->dark ? 'dark': 'bg-white'; ?> <?php echo esc_attr($form_container_class); ?> <?php echo esc_attr($form_border_class); ?> <?php echo $this->calendly_url;?>">
			<?php echo esc_html($this->message); ?>
		</div>
		<?php
	}
}
