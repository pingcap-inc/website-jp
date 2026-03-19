<?php

namespace PingCAP\Components\Headers;

use WPUtil\Interfaces\IComponent;

class HeaderTiUD2026 implements IComponent
{

    public function __construct(array $params) {}

    public function render(): void
    {
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $isWhyNewSQL = strpos($currentPath, 'why-newsql') !== false;
?>
        <header class="tmpl-tidb-user-day-2026__header">
            <div class="header">
                <div class="contain">
                    <a href="/" class="logo">
                        <img src="https://static.pingcap.co.jp/files/2025/03/31190230/logo.svg" alt="TiDB">
                    </a>
                    <nav>
                        <div class="nav">
                            <a class="nav-menu" href="#agenda">
                                タイムテーブル
                            </a>
                            <a class="nav-menu" href="#partner">
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
                        <a class="button-tiud js--trigger-form-modal" data-form-id="2c77365f-067c-4762-9c04-db33bd056bd5">
                            <span>登録する</span>
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
