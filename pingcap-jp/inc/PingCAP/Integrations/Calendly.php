<?php

namespace PingCAP\Integrations;

class Calendly
{
	public static array $enqueued_forms = [];
	public static bool $footer_action_added = false;

	public static function enqueueForm(string $calendly_id, string $calendly_url, array $params = [])
	{
		$form_params = array_merge([
			'calendly_id' => $calendly_id,
			'url' => $calendly_url,
		], $params);

		self::$enqueued_forms[] = $form_params;

		if (!self::$footer_action_added) {
			add_action('wp_footer', [__CLASS__, 'generateEmbedJS']);

			self::$footer_action_added = true;
		}
	}

	public static function generateEmbedJS()
	{

?>
		<link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
		<script src="https://assets.calendly.com/assets/external/forms.js" type="text/javascript" async></script>
		<script>
			window.addEventListener('load', function() {
				<?php
				foreach (self::$enqueued_forms as $form) {
				?>
					Calendly.initHubspotForm(<?php echo stripslashes(wp_json_encode($form)); ?>);
				<?php
				}
				?>

			})
		</script>
<?php

		// phpcs:enable WordPress.WP.EnqueuedResources.NonEnqueuedScript
	}
}
