<?php
/**
 * Public admin area function.
 */

namespace Includes\Admin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Include plugin admin area templates.
 */
function includeTemplates(): void
{
    $selectedTab = \Includes\Admin\queryString('tab');
    $currentTab = (true !== empty($selectedTab)) ? $selectedTab : 'settings';
    $templatePath = \Includes\settings('template_path');

    include_once $templatePath.'/header.php';
    include_once $templatePath.'/'.$currentTab.'.php';
    include_once $templatePath.'/footer.php';
}
