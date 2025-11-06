<?php

namespace PingCAP\Components\Headers;

use WPUtil\Interfaces\IComponent;

class HeaderTiUD2025 implements IComponent
{

    public function __construct(array $params) {}

    public function render(): void
    {
?>
        <header class="tmpl-tidb-user-day-2025__header">
            <div class="header">
                <div class="contain">
                    <a href="/" class="logo">
                        <img src="https://static.pingcap.co.jp/files/2025/03/31190230/logo.svg" alt="TiDB">
                    </a>
                    <nav>
                        <div class="nav">
                            <a class="nav-menu" href="#about">
                                開催概要
                            </a>
                            <a class="nav-menu" href="#agenda">
                                タイムテーブル
                            </a>
                            <a class="nav-menu" href="#speakers">
                                登壇企業
                            </a>
                            <a class="nav-menu" href="#sponsors">
                                スポンサー
                            </a>
                            <a class="nav-menu" href="#campaign">
                                キャンペーン
                            </a>
                            <div class="nav-dropper__wrapper">
                                <div class="nav-menu">
                                    開催実績
                                </div>
                                <div class="nav-dropper">
                                    <div class="nav-dropper__content">
                                        <a href="/tidb-user-day/oct-2025">
                                            TiDB User Day 2025
                                        </a>
                                        <a href="/tidb-user-day/jul-2024">
                                            TiDB User Day 2024
                                        </a>
                                        <a href="/tidb-user-day/jul-2023">
                                            TiDB User Day 2023
                                        </a>
                                        <a href="/tidb-user-day/jul-2022">
                                            TiDB User Day 2022
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                        $isInPerson = strpos($currentPath, 'in-person') !== false;
                        ?>
                        <a class="button-tiud js--trigger-form-modal" data-form-id="<?php echo $isInPerson ? '7468f90a-1056-4d73-80e9-87f8efcc18a8' : 'cc527b2b-dcf3-4d9a-97f6-fd72fc97e9e8'; ?>">
                            <span>動画を視聴する</span>
                        </a>
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
