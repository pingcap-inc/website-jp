<?php

namespace PingCAP\Integrations;

class Gartner
{
    public static bool $footer_action_added = false;

    public static function enqueueGartner()
    {
        if (!self::$footer_action_added) {
            add_action('wp_footer', [__CLASS__, 'generateEmbedJS']);

            self::$footer_action_added = true;
        }
    }

    public static function generateEmbedJS()
    {
        // phpcs:disable WordPress.WP.EnqueuedResources.NonEnqueuedScript
?>

        <script src="https://www.gartner.com/reviews/public/Widget/js/widget.js"></script>
        <script>
            if (window.GartnerPI_Widget !== 'undefined') {

                GartnerPI_Widget({
                    size: "line",
                    theme: "light",
                    sourcingLink: "",
                    widget_id: "NGU0MTQzNTAtYTk3Yi00MDYwLTgwMTYtZmY1N2UxZGFiY2Ix",
                    version: "2",
                    container: document.querySelector('.widget-container')
                })

            }
        </script>
<?php

        // phpcs:enable WordPress.WP.EnqueuedResources.NonEnqueuedScript
    }
}
