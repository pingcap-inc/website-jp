<?php
$gated_resource_setting = get_field('gated_resource_template');
if ($gated_resource_setting === true) {
    require_once 'page-template-gated-resource.php';
} else {
    require_once 'single-post.php';
}
