<?php

/**
 * Template Name: TiDB User Day 2026
 */

use Blueprint\Images;
use WPUtil\{Arrays, Vendor};
use WPUtil\Vendor\ACF;

get_header();

?>
<div class="tmpl-tidb-user-day-2026">
    <div class="banner">
        <?php echo ACF::get_field_string('banner_content'); ?>
    </div>
    <section class="introduction bg-black-dark block-container block-columns" aria-label="Columns">
        <div class="block-inner contain grid is-12" data-num-col="1" data-format="">
            <div class="block-columns__column wysiwyg">
                <?php echo ACF::get_field_string('introduction_content'); ?>
            </div>
        </div>
    </section>
    <section class="carousel block-options-padding-remove-top  bg-black-gradient block-container block-carousel" aria-label="carousel">
        <div class="block-inner contain">
            <h2><?php echo ACF::get_field_string('carousel_title'); ?></h2>
            <div class="block-carousel__container embla-instance">
                <div class="embla-wrapper">
                    <div class="embla">
                        <div class="embla__container">
                            <?php
                            foreach (ACF::get_field_array('carousel_list') as $item) {
                                $carousel_image = Arrays::get_value_as_array($item, 'carousel_image');
                            ?>

                                <div class="embla__slide">
                                    <?php
                                    Images::safe_image_output($carousel_image);
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="embla__pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

 

    <?php
    $agenda_lists = ACF::get_field_array('agenda_lists');
    if (count($agenda_lists)) {
    ?>
        <section id="agenda" class="agenda bg-black-dark block-container">
            <div class="block-inner contain">
                <h2><?php echo ACF::get_field_string('agenda_block_title'); ?></h2>
                <div class="agenda-tabs">
                    <div class="agenda-tabs__nav">
                        <?php
                        $tab_index = 0;
                        foreach ($agenda_lists as $agenda_list_item) {
                            $agenda_list_title = Arrays::get_value_as_string($agenda_list_item, 'agenda_list_title');
                            $agenda_items = Arrays::get_value_as_array($agenda_list_item, 'agenda_list');
                            
                            if (count($agenda_items)) {
                                $tab_index++;
                        ?>
                            <button class="agenda-tabs__nav-item <?php echo $tab_index === 1 ? 'active' : ''; ?>" data-tab="tab-<?php echo $tab_index; ?>">
                                <?php echo $agenda_list_title; ?>
                            </button>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $tab_index = 0;
                    foreach ($agenda_lists as $agenda_list_item) {
                        $agenda_list_desc = Arrays::get_value_as_string($agenda_list_item, 'agenda_list_desc');
                        $agenda_list_color = Arrays::get_value_as_string($agenda_list_item, 'agenda_list_color');
                        $agenda_items = Arrays::get_value_as_array($agenda_list_item, 'agenda_list');
                        
                        if (count($agenda_items)) {
                            $tab_index++;
                    ?>
                        <div class="agenda-tabs__content agenda-list agenda-list--<?php echo $agenda_list_color; ?> <?php echo $tab_index === 1 ? 'active' : ''; ?>" id="tab-<?php echo $tab_index; ?>">
                            <?php if ($agenda_list_desc) { ?>
                                <div class="agenda-list__desc"><?php echo $agenda_list_desc; ?></div>
                            <?php } ?>
                            <?php
                            foreach ($agenda_items as $list) {
                                $agenda_card_color = Arrays::get_value_as_string($list, 'agenda_card_color');
                                $agenda_start_time = Arrays::get_value_as_string($list, 'agenda_start_time');
                                $agenda_end_time = Arrays::get_value_as_string($list, 'agenda_end_time');
                                $agenda_image = Arrays::get_value_as_array($list, 'agenda_image');
                                $agenda_title = Arrays::get_value_as_string($list, 'agenda_title');
                                $agenda_desc = Arrays::get_value_as_string($list, 'agenda_desc');
                                $agenda_summary = Arrays::get_value_as_string($list, 'agenda_summary');
                                $has_multiple_avatar = Arrays::get_value_as_bool($list, 'has_multiple_avatar');
                                $multiple_avatar = Arrays::get_value_as_array($list, 'multiple_avatar');
                            ?>
                                <div class="timeline <?php echo $agenda_summary ? 'timeline--has-summary js--trigger-tiud-summary-modal' : ''; ?>">
                                    <div class="time"><?php echo $agenda_start_time; ?><span class="line"></span><?php echo $agenda_end_time; ?></div>
                                    <div class="card <?php echo $agenda_card_color ?> <?php echo !$agenda_summary ? 'bg-' . $agenda_card_color : ''; ?>">
                                        <div>
                                            <div class="image-container <?php echo $agenda_image ? 'has-image' : ''; ?> <?php echo $has_multiple_avatar ? 'has-multiple' : ''; ?>">
                                                <?php Images::safe_image_output($agenda_image, ['data-lazy-ignore' => 1]); ?>
                                            </div>
                                            <?php if ($has_multiple_avatar) { ?>
                                                <div class="avatars">
                                                    <?php foreach ($multiple_avatar as $avatar) {
                                                        Images::safe_image_output(Arrays::get_value_as_array($avatar, 'avatar'), ['data-lazy-ignore' => 1]);
                                                    }  ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="content">
                                            <h3><?php echo $agenda_title; ?></h3>
                                            <?php if ($agenda_desc) { ?>
                                                <p><?php echo $agenda_desc; ?></p>
                                            <?php } ?>
                                            <?php if ($agenda_summary) { ?>
                                                <div class="summary"><?php echo $agenda_summary; ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php
    $exhibitors_list = ACF::get_field_array('exhibitors_list');
    if (count($exhibitors_list)) {
    ?>
        <section id="partner" class="speakers bg-black-dark block-container block-logos" aria-label="Logos">
            <div class="block-inner contain">
                <h2><?php echo ACF::get_field_string('exhibitors_title'); ?></h2>
                <div class="block-logos__logo">
                    <div class="block-logos__logo-grid">
                        <?php
                        foreach ($exhibitors_list as $exhibitor) {
                            $company_logo = Arrays::get_value_as_array($exhibitor, 'company_logo');
                            $company_case_url = Arrays::get_value_as_string($exhibitor, 'company_case_url');
                        ?>
                            <div class="block-logos__column">
                                <?php if ($company_case_url) { ?>
                                    <a href="<?php echo esc_url($company_case_url); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php Images::safe_image_output($company_logo, ['data-ib-no-cache' => 1, 'class' => 'lazy block-logos__logo-image']); ?>
                                    </a>
                                <?php } else {
                                    Images::safe_image_output($company_logo, ['data-ib-no-cache' => 1, 'class' => 'lazy block-logos__logo-image']);
                                } ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php
    $sponsors_list = ACF::get_field_array('sponsors_list');
    if (count($sponsors_list)) {
    ?>
        <section id="sponsors" class="sponsors bg-black-dark block-container block-logos" aria-label="Logos">
            <div class="block-inner contain">
                <h2><?php echo ACF::get_field_string('sponsors_title'); ?></h2>
                <div class="block-logos__logo">
                    <div class="block-logos__logo-grid">
                        <?php
                        foreach ($sponsors_list as $sponsor) {
                            $company_logo = Arrays::get_value_as_array($sponsor, 'company_logo');
                            $company_case_url = Arrays::get_value_as_string($sponsor, 'company_case_url');
                        ?>
                            <div class="block-logos__column">
                                <?php if ($company_case_url) { ?>
                                    <a href="<?php echo esc_url($company_case_url); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php Images::safe_image_output($company_logo, ['data-ib-no-cache' => 1, 'class' => 'lazy block-logos__logo-image']); ?>
                                    </a>
                                <?php } else {
                                    Images::safe_image_output($company_logo, ['data-ib-no-cache' => 1, 'class' => 'lazy block-logos__logo-image']);
                                } ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php
    $campaign_lists = ACF::get_field_array('campaign_lists');
    if (count($campaign_lists)) {
    ?>
        <section id="campaign" class="campaign bg-black-dark block-container">
            <div class="block-inner contain">
                <h2><?php echo ACF::get_field_string('campaign_title'); ?></h2>
                <div class="campaign-tabs">
                    <div class="campaign-tabs__nav">
                        <?php
                        $tab_index = 0;
                        foreach ($campaign_lists as $campaign_item) {
                            $campaign_tab_title = Arrays::get_value_as_string($campaign_item, 'campaign_tab_title');
                            $tab_index++;
                        ?>
                            <button class="campaign-tabs__nav-item <?php echo $tab_index === 1 ? 'active' : ''; ?>" data-tab="campaign_tab_<?php echo $tab_index; ?>">
                                <?php echo $campaign_tab_title; ?>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    $tab_index = 0;
                    foreach ($campaign_lists as $campaign_item) {
                        $campaign_content = Arrays::get_value_as_string($campaign_item, 'campaign_content');
                        $campaign_image = Arrays::get_value_as_array($campaign_item, 'campaign_image');
                        $tab_index++;
                    ?>
                        <div class="campaign-tabs__content <?php echo $tab_index === 1 ? 'active' : ''; ?>" id="campaign_tab_<?php echo $tab_index; ?>">
                            <div class="campaign-content">
                                <div class="campaign-text">
                                    <?php echo $campaign_content; ?>
                                </div>
                                <div class="campaign-image">
                                    <?php Images::safe_image_output($campaign_image); ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="campaign-desc"><?php echo ACF::get_field_string('campaign_description'); ?></div>
            </div>
        </section>
    <?php
    }
    ?>

    <?php echo Vendor\BlueprintBlocks::safe_display(); ?>
</div>

<script>
    const navbarEl = document.querySelector('.navbar-toggle');
    const navEl = document.querySelector('.tmpl-tidb-user-day-2026__header nav');
    const navMenuEls = document.querySelectorAll('.tmpl-tidb-user-day-2026__header .nav-menu');
    navbarEl.addEventListener('click', () => {
        if (navEl.classList.contains('active')) {
            navEl.classList.remove('active');
        } else {
            navEl.classList.add('active');
        }
    });
    navMenuEls.forEach(el => {
        el.addEventListener('click', () => {
            navEl.classList.remove('active');
        })
    });
</script>

<script>
    // Agenda tabs functionality
    const tabNavItems = document.querySelectorAll('.agenda-tabs__nav-item');
    const tabContents = document.querySelectorAll('.agenda-tabs__content');
    
    tabNavItems.forEach(item => {
        item.addEventListener('click', () => {
            const tabId = item.getAttribute('data-tab');
            
            // Remove active class from all nav items
            tabNavItems.forEach(navItem => {
                navItem.classList.remove('active');
            });
            
            // Add active class to clicked nav item
            item.classList.add('active');
            
            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById(tabId);
            if (selectedContent) {
                selectedContent.classList.add('active');
            }
        });
    });
</script>

<script>
    // Campaign tabs functionality
    const campaignTabNavItems = document.querySelectorAll('.campaign-tabs__nav-item');
    const campaignTabContents = document.querySelectorAll('.campaign-tabs__content');
    
    campaignTabNavItems.forEach(item => {
        item.addEventListener('click', () => {
            const tabId = item.getAttribute('data-tab');
            
            // Remove active class from all nav items
            campaignTabNavItems.forEach(navItem => {
                navItem.classList.remove('active');
            });
            
            // Add active class to clicked nav item
            item.classList.add('active');
            
            // Hide all tab contents
            campaignTabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById(tabId);
            if (selectedContent) {
                selectedContent.classList.add('active');
            }
        });
    });
</script>

<?php

get_footer();
