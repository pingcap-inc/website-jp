<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;
use WPUtil\{SVG};

class HeaderSummary implements IComponent
{

    public function __construct(array $params)
    {
    }

    public function render(): void
    {
?>
        <header class="tmpl-summary__header">
            <div class="contain">
                <div class="tmpl-summary__header-title">TiDB User Day</div>
                <nav class="tmpl-summary__header-nav">
                    <a class="nav-menu" href="/tidb-user-day/">
                        ホーム
                    </a>
                    <a class="nav-menu" href="#about">
                        イベントについて
                    </a>
                    <div class="nav-dropper__wrapper">
                        <div class="nav-menu">
                            開催実績
                        </div>
                        <div class="nav-dropper">
                            <div class="nav-dropper__content">
                                <a href="/tidb-user-day/jul-2024">
                                    TiDB User Day 2024
                                </a>
                            </div>
                        </div>
                    </div>
                    <a class="button" href="/tidb-user-day/jul-2024/">アーカイブ動画を視聴する</a>
                </nav>
                <div class="navbar-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            </div>
            <nav class="navbar-collapse contain">
                <a class="nav-menu" href="/tidb-user-day/">
                    ホーム
                </a>
                <a class="nav-menu" href="#about">
                    イベントについて
                </a>
                <div class="nav-dropper__wrapper">
                    <div class="nav-menu">
                        <div>開催実績</div>
                        <?php SVG::the_svg('general/chevron-down', ['class' => 'nav-arrow']); ?>
                    </div>
                    <div class="nav-dropper">
                        <div class="nav-dropper__content">
                            <a href="/tidb-user-day/jul-2024">
                                TiDB User Day 2024
                            </a>
                        </div>
                    </div>
                </div>
                <a class="button" href="/tidb-user-day/jul-2024/">アーカイブ動画を視聴する</a>
            </nav>
        </header>
<?php
    }
}
