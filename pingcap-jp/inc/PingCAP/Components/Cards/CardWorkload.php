<?php

namespace PingCAP\Components\Cards;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays};
use Blueprint\Images;

class CardWorkload implements IComponent
{
    /**
     * The workload icon image
     *
     * @var null|string|integer|array<string, mixed>
     */
    public $image = null;

    /**
     * The workload subtitle
     *
     * @var string
     */
    public string $subtitle = '';

    /**
     * The workload title
     *
     * @var string
     */
    public string $title = '';

    /**
     * The workload content
     *
     * @var string
     */
    public string $content = '';

    public function __construct(array $params)
    {
        $this->image = Arrays::get_value_as_array($params, 'image');
        $this->subtitle = Arrays::get_value_as_string($params, 'subtitle');
        $this->title = Arrays::get_value_as_string($params, 'title');
        $this->content = Arrays::get_value_as_string($params, 'content');
    }

    public function render(): void
    {
?>
        <div class="card-workload">
            <?php
            if ($this->image) {
                Images::safe_image_output($this->image, ['class' => 'card-workload__image']);
            }
            ?>
            <div class="card-workload__content">
                <?php if ($this->subtitle) { ?>
                    <div class="title-mono"><?php echo $this->subtitle; ?></div>
                <?php } ?>
                <h5><?php echo $this->title; ?></h5>
                <?php echo $this->content; ?>
            </div>
        </div>
<?php
    }
}
