<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Vendor\ACF;
use WPUtil\{Arrays};

class HeaderSessionReplay implements IComponent
{
    public int $post_id = 0;

    public function __construct(array $params)
    {
        $this->post_id = Arrays::get_value_as_int($params, 'post_id', fn() => get_the_ID());
    }

    public function render(): void
    {
        $header_title = ACF::get_field_string('header_title', $this->post_id);
        $home_url = ACF::get_field_string('home_url', $this->post_id);
        $header_bg = ACF::get_field_string('header_bg', $this->post_id);
?>
        <header class="tmpl-session-replay__header" <?php echo $header_bg ? 'style="background-image: url(' . $header_bg . ')"' : ''; ?>>
            <div class="contain">
                <div class="tmpl-session-replay__header-title"><?php echo $header_title; ?></div>
                <a href="<?php echo $home_url; ?>">ホーム</a>
            </div>
        </header>
<?php
    }
}
