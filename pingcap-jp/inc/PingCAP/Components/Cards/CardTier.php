<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays};
use Blueprint\Images;
use PingCAP\Blocks\Tabs;

class CardTier implements IComponent
{
    public function __construct(array $params)
    {
        $this->title = Arrays::get_value_as_string($params, 'title');
        $this->sub_title = Arrays::get_value_as_string($params, 'sub_title');
        $this->button = Arrays::get_value_as_array($params, 'button');
        $this->second_button = Arrays::get_value_as_array($params, 'second_button');
        $this->content = Arrays::get_value_as_string($params, 'content');
        $this->is_show_price = Arrays::get_value_as_bool($params, 'set_price');
        $this->tabs = Arrays::get_value_as_array($params, 'tabs');
        $this->link = Arrays::get_value_as_array($params, 'link');
    }

    public function render(): void
    {

?>
        <div class="card-tier">
            <div class="card-tier__title-container">
                <h3 class="card-tier__title"><?php echo esc_html($this->title); ?></h3>
                <div class="card-tier__button-group">
                    <?php if ($this->second_button) { ?>
                        <a class="button button-outline" href="<?php echo esc_url($this->second_button['url']); ?>" target="<?php echo $this->second_button['target'] || '_self' ?>">
                            <?php echo $this->second_button['title']; ?>
                        </a>
                    <?php } ?>
                    <a class="button" href="<?php echo esc_url($this->button['url']); ?>" target="<?php echo $this->button['target'] || '_self' ?>"><?php echo $this->button['title']; ?></a>
                </div>
            </div>
            <div class="card-tier__subtitle"><?php echo $this->sub_title; ?></div>
            <div class="card-tier__content">
                <?php echo wp_kses_post(wpautop($this->content)); ?>
            </div>
            <?php if ($this->is_show_price) { ?>
                <div class="card-tier__tabs-container">
                    <div class="card-tier__tabs">
                        <ul>
                            <?php foreach ($this->tabs as $index => $tab) {
                                $logo =  $tab['logo'] ?? null;
                                $tab_classes = ['js-tabs-nav'];
                                $section_key = Tabs::getSectionId($index);
                                if ($index === 0) {
                                    $tab_classes[] = 'active';
                                }
                            ?>
                                <li class="<?php echo esc_attr(implode(' ', $tab_classes)); ?>" data-section-id="<?php echo esc_attr($section_key); ?>">
                                    <?php echo Images::safe_image_output($logo, ['class' => 'card-tier__provider-logo','data-ib-no-cache' => 1]); ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php foreach ($this->tabs as $index => $tab) {
                        $tab_content = Arrays::get_value_as_string($tab, 'tabs_content');
                        $tab_content_classes = ['card-tier__tabs-content', 'js-tabs-content'];
                        $section_key = Tabs::getSectionId($index);
                        if ($index === 0) {
                            $tab_content_classes[] = 'active';
                        }
                    ?>
                        <div class="<?php echo esc_attr(implode(' ', $tab_content_classes)); ?>" data-section-id="<?php echo esc_attr($section_key); ?>">
                            <?php echo wp_kses_post(wpautop($tab_content)); ?>
                        </div>
                    <?php } ?>
                </div>
                <a class="button button--secondary" href="<?php echo esc_url($this->link['url']); ?>" target="<?php echo $this->link['target'] || '_self' ?>">
                    <?php echo $this->link['title']; ?>
                </a>
            <?php } ?>
        </div>
<?php

    }
}
