<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{Arrays, Component};
use PingCAP\{Components};

class PackageDownload implements IComponent
{
    public function __construct(array $params)
    {
        $this->title = Arrays::get_value_as_string($params, 'title');
        $this->packages = Arrays::get_value_as_array($params, 'packages');
        $this->version_numbers = Arrays::get_value_as_array($params, 'version');
        $this->page_link = Arrays::get_value_as_array($params, 'page_link');
    }

    public function render(): void
    {
        if ($this->version_numbers && $this->packages) {
?>
            <div class="package-download" id="version-list">
                <h4><?php echo $this->title; ?></h4>
                <div class="package-download__row-selectors">
                    <select class="package-download__filter-control" data-role="version">
                        <?php
                        foreach ($this->version_numbers as $index => $version) {
                            $label = Arrays::get_value_as_string($version, 'title');
                            $value = Arrays::get_value_as_string($version, 'value');
                        ?>

                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select class="package-download__filter-control" data-role="package">
                        <?php
                        foreach ($this->packages as $index => $package) {
                            $label = Arrays::get_value_as_string($package, 'title');
                            $value = Arrays::get_value_as_string($package, 'value');
                        ?>

                            <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <select class="package-download__filter-control" data-role="type">
                        <option value="amd64">x86, 64-bit</option>
                        <option value="arm64">ARM, 64-bit</option>
                    </select>
                </div>

                <div class="package-download__download-checkbox">
                    <input type="checkbox" id="policy">
                    <label for="policy">I agree to PingCAP's <a href="https://www.pingcap.com/privacy-policy/" target="_blank">Privacy Policy</a>.*</label>
                    <div class="package-download__download-error-message hide">Please complete this required field.</div>
                </div>

                <div>
                    <div class="button package-download__download-button">Download</div>
                    <?php
                    if ($this->page_link) {
                        Component::render(Components\UI\Button::class, [
                            'link' => $this->page_link['url'],
                            'text' => $this->page_link['title'],
                            'style' => 'button--secondary',
                            'attributes' => ['target' => $this->page_link['target'] ? $this->page_link['target'] : '_self']
                        ]);
                    } ?>
                </div>
            </div>
<?php
        }
    }
}
