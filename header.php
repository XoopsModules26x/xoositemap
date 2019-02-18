<?php
/**
 * Xoositemap module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xoositemap
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)

 */
include dirname(dirname(__DIR__)) .  '/mainfile.php';

$op = '';
if (isset($_POST)) {
    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }
}
if (isset($_GET)) {
    foreach ($_GET as $k => $v) {
        ${$k} = $v;
    }
}

$helper = \XoopsModules\Xoositemap\Helper::getInstance();
$sitemapConfig = $helper->loadConfig();

if ('' != $op) {
    $modules[] = $op;
} else {
    $modules = $sitemapConfig['xoositemapModule'];
}
$xoops = \Xoops::getInstance();
$xoops->header('xoositemap_index.tpl');
$xoops->theme()->addStylesheet('modules/xoositemap/assets/css/module.css');

$sitemap = [];
foreach ($modules as $k => $mod) {
    $moduleObj = $xoops->module->getByDirname($mod);

    $plugin = \Xoops\Module\Plugin::getPlugin($moduleObj->getVar('dirname'), 'xoositemap');
    if (is_object($plugin)) {
        $results = $plugin->Xoositemap($sitemapConfig['xoositemap_subcat']);

        $sitemap[$k]['name']    = $moduleObj->getVar('name');
        $sitemap[$k]['dirname'] = $moduleObj->getVar('dirname');
        $sitemap[$k]['image']   = \XoopsBaseConfig::get('url')  . '/modules/' . $moduleObj->getVar('dirname') . '/assets/icons/logo_large.png';

        if (count($results) > 0) {
            foreach (array_keys($results) as $i) {
                $results[$i]['date'] = \XoopsLocale::formatTimestamp($results[$i]['time'], 's');
            }
            $sitemap[$k]['sitemap'] = $results;

            foreach ($results as $data) {
                if (isset($data['category'])) {
                    $sitemap[$k]['category'] = true;
                    break;
                }
            }
        }
    }
}

$xoops->tpl()->assign('moduletitle', $xoops->module->name());
$xoops->tpl()->assign('xoositemap_config', $sitemapConfig);
$xoops->tpl()->assign('sitemap', $sitemap);
