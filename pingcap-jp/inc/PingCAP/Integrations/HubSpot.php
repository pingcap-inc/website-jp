<?php

namespace PingCAP\Integrations;

class HubSpot
{
	public static array $enqueued_forms = [];
	public static bool $footer_action_added = false;

	public static function enqueueForm(string $portal_id, string $form_id, string $salesforce_id, string $target, array $params = [])
	{
		$form_params = array_merge([
			'portalId' => $portal_id,
			'formId' => $form_id,
			'target' => $target,
			'css' => '' // NOTE: sending a blank 'css' value to the HubSpot forms API will restrict the default styles from being loaded
		], $params);

		self::$enqueued_forms[] = $form_params;

		if (!self::$footer_action_added) {
			add_action('wp_footer', [__CLASS__, 'generateEmbedJS']);

			self::$footer_action_added = true;
		}
	}

	public static function generateEmbedJS()
	{
		// phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedScript

		if (!count(self::$enqueued_forms)) {
			return;
		}

?>
		<!--[if lte IE 8]>
		<script src="//js.hsforms.net/forms/v2-legacy.js"></script>
		<![endif]-->
		<script src="//js.hsforms.net/forms/v2.js"></script>
		<script>
			const lead_type_map = {
				'demo': 'book_demo',
				'contact-us': 'contact_us',
				'ebook-whitepaper': 'ebook_download',
				'event': 'event_registration',
				'tidb-enterprise': 'get_tidb_enterprise_edition',
			};
			if (window.hbspt !== 'undefined') {
				<?php
				foreach (self::$enqueued_forms as $form) {
				?>
					hbspt.forms.create({
						...<?php echo wp_json_encode($form); ?>,
						onFormSubmit: function($form) {
							window.gtag && window.gtag({
								event: 'lead_form_submit_complete',
								button_name: 'SUBMIT',
								lead_type: lead_type_map[window.location.pathname.split('/')[1]] || ''
							});
						}
					});
				<?php
				}
				?>
				window.addEventListener('message', (event) => {
					if (event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {
						document.querySelectorAll('.hs-form-container').forEach(el => {
							el.addEventListener('submit', function(event) {
								window.gtag && window.gtag({
									event: 'lead_form_submit_click',
									button_name: 'SUBMIT',
									lead_type: lead_type_map[window.location.pathname.split('/')[1]] || ''
								});
							});
						})
					}
				});

			}
		</script>
<?php

		// phpcs:enable WordPress.WP.EnqueuedResources.NonEnqueuedScript
	}
}
