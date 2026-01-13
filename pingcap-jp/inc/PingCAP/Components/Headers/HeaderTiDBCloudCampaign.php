<?php

namespace PingCAP\Components\Headers;

use WPUtil\Interfaces\IComponent;
use WPUtil\{SVG};

class HeaderTiDBCloudCampaign implements IComponent
{

    public function __construct(array $params) {}

    public function render(): void
    {
?>
        <header class="tmpl-tidb-cloud-campaign__header bg-black-dark tmpl-tidb-cloud-campaign">
            <div class="header">
                <div class="contain">
                    <a href="<?php echo esc_url(site_url()); ?>" title="<?php echo esc_attr(bloginfo('name')); ?>" aria-label="Home">
                        <?php SVG::the_svg('general/logo', ['class' => 'site-header__logo-image']); ?>
                    </a>
                    <nav>
                        <div class="nav">
                            <a class="nav-menu" href="https://docs.pingcap.com/ja/tidbcloud/">
                                ドキュメント
                            </a>
                            <a class="nav-menu" href="https://labs.tidb.io/ja">
                                オンライン学習
                            </a>
                            <a class="nav-menu" href="/event/">
                                キャンペーン
                            </a>
                            <a class="nav-menu" href="/case-study/">
                                事例記事
                            </a>
                            <a class="nav-menu" href="/tidb-user-day/">
                                TiUD
                            </a>
                        </div>
                        <a class="button" href="/contact-us/">お問い合わせ</a>
                    </nav>
                    <div class="navbar-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                </div>
            </div>
        </header>
<?php
    }
}
