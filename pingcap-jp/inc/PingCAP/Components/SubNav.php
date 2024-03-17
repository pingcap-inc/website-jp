<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\Arrays;
use WPUtil\Vendor\ACF;

class SubNav implements IComponent
{
    public function __construct(array $params)
    {
        $this->post_id = Arrays::get_value_as_int($params, 'post_id', fn () => get_the_ID());
        $this->acf_prefix = Arrays::get_value_as_string($params, 'acf_prefix', 'sub_nav');

        $this->type = Arrays::get_value_as_string(
            $params,
            'type',
            fn () => ACF::get_field_string($this->acf_prefix . '_type', $this->post_id)
        );
        $this->links = Arrays::get_value_as_array(
            $params,
            'links',
            fn () => ACF::get_field_array($this->acf_prefix . '_links', $this->post_id)
        );
    }

    public function render(): void
    {
        if (!count($this->links)) {
            return;
        }

?>
        <div class="sub-nav" data-type="<?php echo $this->type; ?>">
            <nav class="sub-nav__container contain">
                <?php
                foreach ($this->links as $link) {
                    $anchor = Arrays::get_value_as_string($link, 'anchor');
                    $title = Arrays::get_value_as_string($link, 'title');
                ?>
                    <span class="sub-nav__item">
                        <a class="sub-nav__link" href="<?php echo esc_url($anchor); ?>"><?php echo esc_html($title); ?></a>
                    </span>
                <?php
                }
                ?>
            </nav>
        </div>
<?php
    }
}
