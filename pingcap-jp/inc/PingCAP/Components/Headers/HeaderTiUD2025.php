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
                            <a class="nav-menu" href="#">
                                タイムテーブル
                            </a>
                            <a class="nav-menu" href="#">
                                登壇企業
                            </a>
                            <a class="nav-menu" href="#prize">
                                キャンペーン
                            </a>
                        </div>
                        <a class="button js--trigger-form-modal" data-form-id="4e29b6c1-e7d3-4861-9e26-2bd163baee68">
                            <div>登録する</div>
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
