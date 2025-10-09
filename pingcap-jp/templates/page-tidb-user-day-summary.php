<?php

/**
 * Template Name: TiDB User Day Summary
 */

use WPUtil\{Vendor};

get_header();

?>
<main class="tmpl-summary__content bg-black-dark">
    <div class="banner-container">
        <!-- <video class="banner-video" src="https://static.pingcap.co.jp/files/2023/06/12233132/20230613-143048.mp4" autoplay loop muted playsinline></video> -->
        <img class="banner-image" src="https://static.pingcap.co.jp/files/2025/10/09143243/20251009-133131-scaled.jpeg">
        <img class="banner-overlay" src="https://static.pingcap.co.jp/files/2025/10/09143232/20251009-133147.png">
    </div>
    <div class="contain">
        <h1 class="tmpl-summary__content-title">2025年 NewSQLの旅</h1>
        <div>本イベントは終了しました。<br /> たくさんのご参加ありがとうございました！</div>
        <div class="button-group">
            <a class="button js--trigger-form-modal" data-form-id="cc527b2b-dcf3-4d9a-97f6-fd72fc97e9e8">録画視聴に登録</a>
            <a href="https://tidbcloud.com/free-trial/" class="button-link">無料ではじめる</a>
        </div>
    </div>
</main>

<?php Vendor\BlueprintBlocks::safe_display(); ?>

<script>
    const navbarEl = document.querySelector('.navbar-toggle');
    const navCollapseEl = document.querySelector('.navbar-collapse');
    const navMenuEls = navCollapseEl.querySelectorAll('.nav-menu');
    navbarEl.addEventListener('click', () => {
        if (navCollapseEl.classList.contains('active')) {
            navCollapseEl.classList.remove('active');
        } else {
            navCollapseEl.classList.add('active');
        }
    });
    navMenuEls.forEach(el => {
        el.addEventListener('click', () => {
            navCollapseEl.classList.remove('active');
        })
    });
</script>
<?php

get_footer();
