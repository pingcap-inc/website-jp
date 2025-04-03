<?php

namespace PingCAP\Components\Headers;

use WPUtil\Interfaces\IComponent;
use WPUtil\{SVG};

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
                            <!-- <a class="nav-menu" href="#">
                                タイムテーブル
                            </a>
                            <a class="nav-menu" href="#">
                                登壇企業
                            </a> -->
                            <div class="nav-dropper__wrapper">
                                <div class="nav-menu">
                                    開催実績
                                </div>
                                <div class="nav-dropper">
                                    <div class="nav-dropper__content">
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
                            <a class="nav-menu" href="#prize">
                                キャンペーン
                            </a>
                        </div>
                        <a class="button-tiud js--trigger-form-modal" data-form-id="4e29b6c1-e7d3-4861-9e26-2bd163baee68">
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
