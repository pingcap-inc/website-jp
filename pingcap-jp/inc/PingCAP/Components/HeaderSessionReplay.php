<?php

namespace PingCAP\Components;

use WPUtil\Interfaces\IComponent;

class HeaderSessionreplay implements IComponent
{

    public function __construct(array $params)
    {
    }

    public function render(): void
    {
?>
        <header class="tmpl-session-replay__header">
            <div class="contain">
                <div class="tmpl-session-replay__header-title">TiDB User Day 2024</div>
                <a href="https://pingcap.co.jp/tidb-user-day/">Home</a>
            </div>
        </header>
<?php
    }
}
