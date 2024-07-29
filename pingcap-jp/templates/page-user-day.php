<?php

/**
 * Template Name: New Event Template
 */

use WPUtil\{Vendor};
use PingCAP\Constants;

get_header();
?>
<?php if ($_mv = get_field("user_day_section_mv")) : ?>
<style>
    <?php
    $_image = "";
    if( isset($_mv["sp"]) && $_mv["sp"] ){
        $_image = wp_get_attachment_image_src( $_mv["sp"] , "full");
    }
    if( $_image ):
    ?>
    .p-hero {
        background: url(<?php echo $_image[0] ?>) no-repeat 50%/cover;
    }
    <?php endif; ?>
    <?php
    $_image = "";
    if( isset($_mv["pc"]) && $_mv["pc"] ){
        $_image = wp_get_attachment_image_src( $_mv["pc"] , "full");
    }
    if( $_image ):
    ?>
    @media (min-width: 750px) {
        .p-hero {
            background:url(<?php echo $_image[0] ?>) no-repeat 50%/auto;
        }
    }
    <?php endif; ?>
</style>
<?php endif; ?>
<main class="tmpl-page">
    <div class="tidb-user-day-html">
        <section class="l-section">
            <div class="l-wrap">
                <div class="l-content is-w-full">
                    <div class="l-inner">
                        <div class="p-hero">
                            <div class="p-hero_inner">
                                <h1 class="a-heading ">
                                    <span class="a-heading_text-one  tw-text-white tw-text-center tw-text-[4rem] md:tw-text-[9.2rem] tw-leading-tight"><?php the_title(); ?></span>
                                </h1>
                                <?php if ($_tag = get_field("user_day_section_tag")) : ?>
                                    <p class="tw-text-white tw-text-center tw-font-bold tw-text-[2rem] tw-mt-[2rem]"><?php echo $_tag; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section -->
        <section class="l-section tw-pb-[4.2rem] md:tw-pb-[8rem]" id="outline">
            <div class="l-wrap">
                <div class="l-content is-w-1172">
                    <div class="l-inner">
                        <div class="p-outline">
                            <?php if ($_about = get_field("user_day_section_about")) : ?>
                                <div class="p-outline_item">
                                    <div class="p-outline_left">
                                        <h2 class="a-heading ">
                                            <span class="a-heading_text-one  tw-text-[1.8rem] md:tw-text-[2rem] tw-font-bold tw-leading-normal">イベントについて</span>
                                        </h2>
                                    </div>
                                    <div class="p-outline_right">
                                        <?php if ($_about["title"]) : ?>
                                            <h3 class="a-heading ">
                                                <span class="a-heading_text-one  tw-text-[2rem] md:tw-text-[2.4rem] tw-font-bold tw-leading-snug"><?php echo $_about["title"]; ?></span>
                                            </h3>
                                        <?php endif; ?>
                                        <?php if ($_about["detail"]) : ?>
                                            <p class="tw-text-[1.6rem] tw-mt-[1rem]"><?php echo $_about["detail"]; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($_overview = get_field("user_day_section_overview")) : ?>
                                <div class="p-outline_item">
                                    <div class="p-outline_left">
                                        <h2 class="a-heading ">
                                            <span class="a-heading_text-one  tw-text-[1.8rem] md:tw-text-[2rem] tw-font-bold tw-leading-normal">開催概要</span>
                                        </h2>
                                    </div>
                                    <div class="p-outline_right">
                                        <div class="tw-grid tw-grid-cols-1 tw-gap-[1rem]">
                                            <?php if ($_overview["date"]) : ?>
                                                <dl>
                                                    <dt>開催日</dt>
                                                    <dd>
                                                        <p><?php echo $_overview["date"]; ?></p>
                                                    </dd>
                                                </dl>
                                            <?php endif; ?>
                                            <?php if ($_overview["time"]) : ?>
                                                <dl>
                                                    <dt>時間</dt>
                                                    <dd>
                                                        <p><?php echo $_overview["time"]; ?></p>
                                                    </dd>
                                                </dl>
                                            <?php endif; ?>
                                            <?php if ($_overview["format"]) : ?>
                                                <dl>
                                                    <dt>形式</dt>
                                                    <dd>
                                                        <p><?php echo $_overview["format"]; ?></p>
                                                    </dd>
                                                </dl>
                                            <?php endif; ?>
                                            <?php if ($_overview["sponsorship"]) : ?>
                                                <dl>
                                                    <dt>主催</dt>
                                                    <dd>
                                                        <p><?php echo $_overview["sponsorship"]; ?></p>
                                                    </dd>
                                                </dl>
                                            <?php endif; ?>
                                            <?php if ($_overview["fee"]) : ?>
                                                <dl>
                                                    <dt>参加費</dt>
                                                    <dd>
                                                        <p><?php echo $_overview["fee"]; ?></p>
                                                    </dd>
                                                </dl>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="l-inner tw-mt-[4.2rem] md:tw-mt-[6rem]">
                        <div class="tw-flex tw-justify-center tw-gap-3 tw-px-8 md:tw-px-0">
                            <a href="#entry" class="a-button is-content-fit is-design-square is-type-grd-primary tw-font-bold js-scroll">
                                <span class="a-button_inner ">
                                    <span class="a-button_text">イベントの参加申込はこちら</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                        <rect width="20" height="20" style="fill:none;" />
                                        <path d="M8.74,13.34l-2.6-2.6c-.5-.5-1.3-.5-1.8,0s-.5,1.3,0,1.7h0l4.7,4.7c.3,.3,.7,.4,1,.4s.7-.1,.9-.4l4.7-4.7c.2-.2,.4-.5,.4-.9,0-.3-.1-.6-.4-.9-.2-.2-.6-.4-.9-.4s-.7,.1-.9,.4l-2.6,2.6V3.74c0-.3-.1-.6-.4-.9-.5-.5-1.3-.5-1.8,0-.1,.3-.3,.6-.3,.9V13.34h0Z" style="fill:#fff;" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section -->
        <?php if (have_rows("user_day_section_room")) : ?>
            <section class="l-section tw-py-[4.2rem] md:tw-py-[8rem] tw-overflow-hidden" id="timetable">
                <div class="l-wrap">
                    <div class="l-content is-w-1172">
                        <div class="l-inner">
                            <h2 class="a-heading ">
                                <span class="a-heading_text-one  tw-text-white tw-text-[3rem] md:tw-text-[4.2rem] tw-font-bold tw-text-center tw-leading-snug">タイムテーブル</span>
                            </h2>
                        </div>
                        <div class="l-inner tw-mt-[4rem]">
                            <div class="p-timetable-anchor">
                                <ul class="p-timetable-anchor_list">
                                    <?php while (have_rows("user_day_section_room")) : the_row(); ?>
                                        <li>
                                            <a href="#day_<?php echo get_row_index(); ?>" class="a-button is-left is-design-square is-type-solid-white tw-font-bold js-scroll">
                                                <span class="a-button_inner ">
                                                    <span class="a-button_text"><?php echo get_sub_field("name"); ?></span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                        <rect width="20" height="20" style="fill:none;" />
                                                        <path d="M8.74,13.34l-2.6-2.6c-.5-.5-1.3-.5-1.8,0s-.5,1.3,0,1.7h0l4.7,4.7c.3,.3,.7,.4,1,.4s.7-.1,.9-.4l4.7-4.7c.2-.2,.4-.5,.4-.9,0-.3-.1-.6-.4-.9-.2-.2-.6-.4-.9-.4s-.7,.1-.9,.4l-2.6,2.6V3.74c0-.3-.1-.6-.4-.9-.5-.5-1.3-.5-1.8,0-.1,.3-.3,.6-.3,.9V13.34h0Z" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        </div>
                        <?php
                        $_all_terms = array();
                        if (have_rows("user_day_section_room")) {
                            while (have_rows("user_day_section_room")) {
                                the_row();
                                if (have_rows("program")) {
                                    while (have_rows("program")) {
                                        the_row();
                                        foreach (get_sub_field("tags") as $tag_id) {
                                            $term = get_term($tag_id, Constants\Taxonomies::USERDAY);
                                            $_all_terms[$term->term_id] = $term;
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        <div class="l-inner tw-mt-[5rem] md:tw-mt-[6rem]">
                            <div class="p-timetable-sort js-sort">
                                <div class="p-timetable-sort_inner">
                                    <div class="p-timetable-sort_icon">
                                        <div class="a-image ">
                                            <img src="<?php echo get_template_directory_uri() . '/userday/images/'; ?>icon_sort.svg" class="" width="34" height="34" alt="sort" loading="lazy" decoding="async">
                                        </div>
                                    </div>
                                    <ul class="p-timetable-sort_list">
                                        <li>
                                            <input type="checkbox" name="timetable" id="all" value="all" class="p-timetable-sort_checkbox">
                                            <label for="all">
                                                すべて
                                            </label>
                                        </li>
                                        <?php foreach ($_all_terms as $term) : ?>
                                            <li>
                                                <input type="checkbox" name="timetable" id="<?php echo $term->term_id; ?>" value="<?php echo $term->term_id; ?>" class="p-timetable-sort_checkbox">
                                                <label for="<?php echo $term->term_id; ?>">
                                                    <?php echo $term->name; ?>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="l-inner tw-mt-[3rem] md:tw-mt-[3.2rem]">
                            <div class="p-timetable js-sort__table">
                                <?php while (have_rows("user_day_section_room")) : the_row(); ?>
                                    <div class="p-timetable_block" id="day_<?php echo get_row_index(); ?>">
                                        <div class="p-timetable_head">
                                            <h3 class="tw-text-white tw-text-[3rem] md:tw-text-[3.2rem] tw-leading-snug"><?php echo get_sub_field("name"); ?></h3>
                                        </div>
                                        <div class="p-timetable_body ">
                                            <?php while (have_rows("program")) : the_row(); ?>
                                                <div class="p-timetable-item<?php if (get_sub_field("break")) : ?> is-rest<?php endif; ?>">
                                                    <div class="p-timetable-item_inner">
                                                        <div class="p-timetable-item_left">
                                                            <p class="p-timetable-item_date">
                                                                <?php echo get_sub_field("start"); ?> - <?php echo get_sub_field("end"); ?>
                                                            </p>
                                                            <?php if (get_sub_field("tags")) : ?>
                                                                <ul class="p-timetable-item_tags tw-mt-2">
                                                                    <?php foreach (get_sub_field("tags") as $tag_id) : ?>
                                                                        <?php $term = get_term($tag_id, Constants\Taxonomies::USERDAY); ?>
                                                                        <li data-tags="<?php echo $term->term_id; ?>">
                                                                            <span><?php echo $term->name; ?></span>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="p-timetable-item_right">
                                                            <h4 class="a-heading ">
                                                                <span class="a-heading_text-one  tw-text-[2rem] tw-font-bold tw-leading-snug"><?php echo get_sub_field("title"); ?></span>
                                                            </h4>

                                                            <?php if (get_sub_field("text")) : ?>
                                                                <div class="p-timetable-item_text js-text-more">
                                                                    <div class="p-timetable-item_text-inner">
                                                                        <p><?php echo get_sub_field("text"); ?></p>
                                                                    </div>
                                                                    <div class="tw-mt-2 tw-flex tw-justify-end">
                                                                        <button type="button" class="p-timetable-item_text-button js-text-more-button">
                                                                            <span>▼続きをみる</span>
                                                                            <span>▲たたむ</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>

                                                            <?php if (get_sub_field("speakers")) : ?>
                                                                <div class="tw-mt-[1.2rem] tw-grid tw-grid-cols-1 tw-gap-[1rem]">
                                                                    <?php while (have_rows("speakers")) : the_row(); ?>
                                                                        <div class="p-timetable-item_speaker">
                                                                            <?php if (get_sub_field("image")) : ?>
                                                                                <?php $_image = wp_get_attachment_image_src(get_sub_field("image")["ID"], "full"); ?>
                                                                                <div class="p-timetable-item_speaker-visual">
                                                                                    <div class="a-image is-fit">
                                                                                        <picture>
                                                                                            <?php if ($_image[0]) : ?>
                                                                                                <img src="<?php echo $_image[0]; ?>" class="" width="<?php echo $_image[1]; ?>" height="<?php echo $_image[2]; ?>" alt="<?php echo get_sub_field("name"); ?>" loading="lazy" decoding="async">
                                                                                            <?php endif; ?>
                                                                                        </picture>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <div class="p-timetable-item_speaker-content">
                                                                                <h5 class="tw-text-[1.6rem] tw-font-bold tw-leading-snug"><?php echo get_sub_field("name"); ?></h5>
                                                                                <p class="tw-text-[1.4rem] md:tw-text-[1.6rem] tw-mt-1"><?php echo get_sub_field("text"); ?></p>
                                                                            </div>
                                                                        </div>
                                                                    <?php endwhile; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php if (get_sub_field("links")) : ?>
                                                        <div class="p-timetable-item_bottom">
                                                            <ul class="p-timetable-item_buttons">
                                                                <?php foreach (get_sub_field("links") as $link) : ?>
                                                                    <?php if (isset($link["type"]) && $link["type"] == "link") : ?>
                                                                        <li>
                                                                            <a href="<?php echo $link["url"] ? $link["url"] : "#"; ?>" class="a-button is-border is-content-fit is-design-square is-type-grd-secondary<?php echo $link["url"] ? "" : " is-disabled"; ?>">
                                                                                <span class="a-button_inner ">
                                                                                    <span class="a-button_text"><?php echo $link["text"] ? $link["text"] : $link["url"]; ?></span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    <?php elseif (isset($link["type"]) && $link["type"] == "movie") : ?>
                                                                        <li>
                                                                            <a href="<?php echo $link["url"] ? $link["url"] : "#" ; ?>" class="a-button is-border is-content-fit js--trigger-video-modal is-design-square is-type-grd-secondary<?php echo $link["url"] ? "" : " is-disabled" ; ?>">
                                                                            <span class="a-button_inner ">
                                                                                <span class="a-button_text"><?php echo $link["text"] ? $link["text"] : $link["url"] ; ?></span>
                                                                            </span>
                                                                            </a>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    <?php endif; ?>
                                                </div><!-- /  -->
                                            <?php endwhile; ?>
                                            <?php if (get_sub_field("note")) : ?>
                                                <p class="tw-text-white tw-text-[1.6rem]">
                                                    <?php echo get_sub_field("note"); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <!-- /section -->
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <?php if (get_field("user_day_section_cta_btn")) : ?>
                            <div class="l-inner tw-mt-[4.2rem] md:tw-mt-[6rem]">
                                <div class="tw-flex tw-justify-center tw-gap-3 tw-px-8 md:tw-px-0">
                                    <a href="#entry" class="a-button is-content-fit is-design-square is-type-grd-primary tw-font-bold js-scroll">
                                        <span class="a-button_inner ">
                                            <span class="a-button_text">イベントの参加申込はこちら</span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                                <rect width="20" height="20" style="fill:none;" />
                                                <path d="M8.74,13.34l-2.6-2.6c-.5-.5-1.3-.5-1.8,0s-.5,1.3,0,1.7h0l4.7,4.7c.3,.3,.7,.4,1,.4s.7-.1,.9-.4l4.7-4.7c.2-.2,.4-.5,.4-.9,0-.3-.1-.6-.4-.9-.2-.2-.6-.4-.9-.4s-.7,.1-.9,.4l-2.6,2.6V3.74c0-.3-.1-.6-.4-.9-.5-.5-1.3-.5-1.8,0-.1,.3-.3,.6-.3,.9V13.34h0Z" style="fill:#fff;" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!-- section -->
        <?php endif; ?>
        <?php if ($_company = get_field("user_day_section_company")) : ?>
            <section class="l-section tw-py-[4.2rem] md:tw-py-[8rem] tw-bg-white" id="partner">
                <div class="l-wrap">
                    <div class="l-content is-w-1172">
                        <div class="l-inner">
                            <h2 class="a-heading ">
                                <span class="a-heading_text-one  tw-text-center tw-text-[3rem] md:tw-text-[4.2rem] tw-leading-normal">登壇企業</span>
                            </h2>
                        </div>
                        <?php if (get_field("user_day_section_company_pc") || get_field("user_day_section_company_sp")) : ?>
                            <?php $_pc = wp_get_attachment_image_src(get_field("user_day_section_company_pc")["ID"], "full"); ?>
                            <?php $_sp = wp_get_attachment_image_src(get_field("user_day_section_company_sp")["ID"], "full"); ?>
                            <div class="l-inner tw-mt-[4.2rem] md:tw-mt-[6rem]">
                                <div class="a-image ">
                                    <picture>
                                        <source media="(min-width: 751px)" srcset="<?php echo $_pc[0]; ?>" width="<?php echo $_pc[1]; ?>" height="<?php echo $_pc[2]; ?>">
                                        <source media="(max-width: 750px)" srcset="<?php echo $_sp[0]; ?>" width="<?php echo $_sp[1]; ?>" height="<?php echo $_sp[2]; ?>">
                                        <img src="<?php echo $_pc[0]; ?>" class="" width="<?php echo $_pc[1]; ?>" height="<?php echo $_pc[2]; ?>" alt="登壇企業" loading="lazy" decoding="async">
                                    </picture>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <!-- section -->
        <?php endif; ?>
        <?php if (get_field("user_day_section_campaign")) : ?>
            <section class="l-section tw-py-[4.2rem] md:tw-py-[8rem] tw-bg-[#efefef]" id="campaign">
                <?php the_field("user_day_section_campaign", null, true); ?>
            </section>
        <?php endif; ?>
        <?php if (get_field("user_day_section_influencer")) : ?>
            <section class="l-section tw-py-[4.2rem] md:tw-py-[8rem] tw-bg-[#efefef]" id="influencer">
                <?php the_field("user_day_section_influencer", null, true); ?>
            </section>
        <?php endif; ?>
        <?php if (get_field("user_day_section_application")) : ?>
            <section data-block-index="1" id="entry" class="tidb-user-day__entry bg-blue block-container block-columns block-index-1" aria-label="Columns">
                <?php the_field("user_day_section_application", null, true); ?>
            </section>
        <?php endif; ?>

        <?php
        Vendor\BlueprintBlocks::safe_display();
        ?>

        <!-- section -->
        <div class="p-fixed-nav-pc">
            <div class="p-fixed-nav-pc_inner">
                <div class="p-fixed-nav-pc_head">
                    <h3 class="a-heading ">
                        <span class="a-heading_text-one  tw-text-white tw-text-[2rem] tw-font-bold tw-leading-snug"><?php the_title(); ?></span>
                    </h3>
                </div>
                <div class="p-fixed-nav-pc_content">
                    <ul class="p-fixed-nav-pc_list">
                        <?php if (get_field("user_day_section_about") || get_field("user_day_section_overview")) : ?>
                            <li>
                                <a href="#outline" class="p-fixed-nav-pc_link js-scroll">
                                    開催概要
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (have_rows("user_day_section_room")) : ?>
                            <li>
                                <a href="#timetable" class="p-fixed-nav-pc_link js-scroll">
                                    タイムテーブル
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_field("user_day_section_company_pc") || get_field("user_day_section_company_sp")) : ?>
                            <li>
                                <a href="#partner" class="p-fixed-nav-pc_link js-scroll">
                                    登壇企業
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_field("user_day_section_campaign_title")) : ?>
                            <li>
                                <a href="#campaign" class="p-fixed-nav-pc_link js-scroll">
                                    <?php the_field("user_day_section_campaign_title"); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_field("user_day_section_influencer_title")) : ?>
                            <li>
                                <a href="#influencer" class="p-fixed-nav-pc_link js-scroll">
                                    <?php the_field("user_day_section_influencer_title"); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_field("user_day_section_cta_btn")) : ?>
                            <li>
                                <a href="#entry" class="a-button a-button is-design-square is-type-grd-primary tw-font-bold p-fixed-nav-pc_entry js-scroll">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="none" viewBox="0 0 20 16">
                                        <path stroke="#fff" fill="transparent" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 1v2m0 4v2m0 4v2M3 1h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 1 0 0-4V3a2 2 0 0 1 2-2Z" />
                                    </svg>
                                    <span class="a-button_inner ">
                                        <span class="a-button_text">参加申込</span>
                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- p-fixed-nav-pc -->
        <div class="p-fixed-nav-sp">
            <div class="p-fixed-nav-sp_inner">
                <div class="p-fixed-nav-sp_nav">
                    <button type="button" data-modal="nav-sp" class="p-fixed-nav-sp_nav-button js-modal">
                        <span>
                            <img src="<?php echo get_template_directory_uri() . '/userday/images/'; ?>icon_menu.svg" alt="メニュー" loading="lazy" width="20" height="20">
                        </span>
                    </button>
                </div>
                <?php if (get_field("user_day_section_cta_btn")) : ?>
                    <div class="p-fixed-nav-sp_button">
                        <a href="#entry" class="a-button a-button is-design-square is-type-grd-primary tw-font-bold p-fixed-nav-pc_entry js-scroll">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="none" viewBox="0 0 20 16">
                                <path stroke="#fff" fill="transparent" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 1v2m0 4v2m0 4v2M3 1h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a2 2 0 1 0 0-4V3a2 2 0 0 1 2-2Z" />
                            </svg>
                            <span class="a-button_inner ">
                                <span class="a-button_text">参加申込</span>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- p-fixed-nav-sp -->
        <div class="o-modal" data-modal-id="nav-sp">
            <div class="o-modal_wrap">
                <div class="o-modal_inner">
                    <div class="p-modal-nav">
                        <div class="p-modal-nav_head">
                            <h3 class="a-heading ">
                                <span class="a-heading_text-one  tw-text-white tw-text-[1.6rem] tw-font-bold tw-leading-snug"><?php the_title(); ?></span>
                            </h3>
                            <div class="p-modal-nav_close js-modal__close"></div>
                        </div>
                        <div class="p-modal-nav_content">
                            <ul class="p-modal-nav_list">
                                <?php if (get_field("user_day_section_about") || get_field("user_day_section_overview")) : ?>
                                    <li>
                                        <a href="#outline" class="p-modal-nav_link js-modal__close">
                                            開催概要
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (have_rows("user_day_section_room")) : ?>
                                    <li>
                                        <a href="#timetable" class="p-modal-nav_link js-modal__close">
                                            タイムテーブル
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_field("user_day_section_company_pc") || get_field("user_day_section_company_sp")) : ?>
                                    <li>
                                        <a href="#partner" class="p-modal-nav_link js-modal__close">
                                            登壇企業
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_field("user_day_section_campaign_title")) : ?>
                                    <li>
                                        <a href="#campaign" class="p-modal-nav_link js-modal__close">
                                            <?php the_field("user_day_section_campaign_title"); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_field("user_day_section_influencer_title")) : ?>
                                    <li>
                                        <a href="#influencer" class="p-modal-nav_link js-modal__close">
                                            <?php the_field("user_day_section_influencer_title"); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="o-modal_bg js-modal__close"></div>
        </div>
    </div>
</main>


<?php

get_footer();
