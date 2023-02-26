<?php
/**
 * Public admin area function: view.
 */

namespace Includes\PluginAdmin\View;

if (false === defined('ABSPATH')) {
    exit;
}

/**
 * Include plugin admin area templates.
 */
function includeTemplates(): void
{
    $selectedTab = \Includes\PluginAdmin\queryString('tab');
    $currentTab = (true !== empty($selectedTab)) ? $selectedTab : 'settings';
    $templatePath = \Includes\settings('template_path');

    include_once $templatePath.'/header.php';
    include_once $templatePath.'/'.$currentTab.'.php';
    include_once $templatePath.'/footer.php';
}
