<?php

use PingCAP\{Components, Constants};

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<?php
	do_action('global_head_top_content');

	if (!defined('IGNORE_USER_SCRIPTS') || !constant('IGNORE_USER_SCRIPTS')) {
		the_field(Constants\ACF::THEME_OPTIONS_SCRIPTS_BASE . '_global_head_top_content', 'option', false);
	}

	?>
	<title><?php wp_title('&bull;'); ?></title>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="application-name" content="<?php bloginfo('name'); ?>">
	<meta name="referrer" content="no-referrer-when-downgrade" />

	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_template_directory_uri()); ?>/media/favicon/apple-touch-icon.png">
	<!-- <link rel="manifest" href="<?php echo esc_url(get_template_directory_uri()); ?>/media/favicon/site.webmanifest"> -->
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-config" content="<?php echo esc_url(get_template_directory_uri()); ?>/media/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php if (is_page_template('templates/page-tidb-user-day.php') || is_page_template('templates/page-tidb-user-day-in-person.php')) { ?>
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/tidb-user-day/assets/css/index.css">
		<script src="<?php echo esc_url(get_template_directory_uri()); ?>/tidb-user-day/assets/js/main.js" defer></script>
	<?php } ?>

	<?php if (is_page_template('templates/page-user-day.php')) { ?>
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/userday/css/userday.css">
		<script src="<?php echo esc_url(get_template_directory_uri()); ?>/userday/js/userday.js" defer></script>
	<?php } ?>

	<?php
	wp_head();

	if (!defined('IGNORE_USER_SCRIPTS') || !constant('IGNORE_USER_SCRIPTS')) {
		the_field(Constants\ACF::THEME_OPTIONS_SCRIPTS_BASE . '_global_head_bottom_content', 'option', false);
	}
	?>
</head>

<body id="body" <?php body_class(); ?>>
	<?php
	if (!defined('IGNORE_USER_SCRIPTS') || !constant('IGNORE_USER_SCRIPTS')) {
		the_field(Constants\ACF::THEME_OPTIONS_SCRIPTS_BASE . '_global_body_top_content', 'option', false);
	}

	if (is_page_template('templates/page-session-replay.php')) {
		WPUtil\Component::render(Components\HeaderSessionReplay::class);
	} else if (is_page_template('templates/page-tidb-user-day-summary.php')) {
		WPUtil\Component::render(Components\HeaderSummary::class);
	} else {
		WPUtil\Component::render(Components\Header::class);
	}
