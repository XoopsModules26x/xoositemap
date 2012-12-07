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
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xoositemap
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)
 * @version         $Id$
 */

include dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'mainfile.php';

$op = '';
if ( isset( $_POST ) ){
    foreach ( $_POST as $k => $v )  {
        ${$k} = $v;
    }
}
if ( isset( $_GET ) ){
    foreach ( $_GET as $k => $v )  {
        ${$k} = $v;
    }
}

XoopsLoad::load('xoopreferences', 'xoositemap');
$Xoositemap_config = XooSitemapPreferences::getInstance()->getConfig();

if ( $op != '') {    $modules[] = $op;} else {    $modules = $Xoositemap_config['xoositemap_module'];}
$xoops->header('xoositemap_index.html');
$xoops->theme()->addStylesheet('modules/xoositemap/css/module.css');

$sitemap = array();
foreach ($modules as $k => $mod) {    $module = $xoops->module->getByDirName($mod);
    if ( file_exists(XOOPS_ROOT_PATH . '/modules/' . $module->getVar('dirname') . '/include/plugin.xoositemap.php') ) {        include XOOPS_ROOT_PATH . '/modules/' . $module->getVar('dirname') . '/include/plugin.xoositemap.php';    } elseif (file_exists(XOOPS_ROOT_PATH . '/modules/xoositemap/plugins/' . $module->getVar('dirname') . '.php') ) {        include XOOPS_ROOT_PATH . '/modules/xoositemap/plugins/' . $module->getVar('dirname') . '.php';    }

    if (  function_exists( $func = 'XooSitemap_' . ucfirst($module->getVar('dirname')) ) ) {        $sitemap[$k]['name']    = $module->getVar('name');
        $sitemap[$k]['dirname'] = $module->getVar('dirname');
        $sitemap[$k]['image']   = XOOPS_URL . '/modules/' . $module->getVar('dirname') . '/icons/logo_large.png';

        $datas = call_user_func($func, $Xoositemap_config['xoositemap_subcat']);        if ( count($datas) > 0 ) {            $sitemap[$k]['sitemap'] = $datas;
        }
    }
}

$xoops->tpl()->assign('moduletitle', $xoops->module->name() );
$xoops->tpl()->assign('xoositemap_config', $Xoositemap_config );
$xoops->tpl()->assign('sitemap', $sitemap);
?>