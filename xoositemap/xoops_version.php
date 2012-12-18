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

$modversion['name']           = _MI_XOO_SITEMAP_NAME;
$modversion['description']    = _MI_XOO_SITEMAP_DESC;
$modversion['version']        = 1.00;
$modversion['author']         = 'JEN Laurent';
$modversion['nickname']       = 'DuGris';
$modversion['credits']        = 'The XOOPS Project';
$modversion['license']        = 'GNU GPL 2.0';
$modversion['license_url']    = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']       = 1;
$modversion['help']           = 'page=help';
$modversion['image']          = 'images/xoositemap_logo.png';
$modversion['dirname']        = 'xoositemap';

// about
$modversion['release_date']        = '2012/11/26';
$modversion['module_website_url']  = 'dugris.xoofoo.org';
$modversion['module_website_name'] = 'XooFoo.org - Laurent JEN';
$modversion['module_status']       = 'alpha';
$modversion['min_php']             = '5.2';
$modversion['min_xoops']           = '2.6.0';
$modversion['min_db']              = array('mysql'=>'5.0.7', 'mysqli'=>'5.0.7');

// paypal
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'dugris93@gmail.com';
$modversion['paypal']['item_name']     = _MI_XOO_SITEMAP_DESC;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'EUR';

// Admin menu
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Manage extension
$modversion['extension'] = 0;
$modversion['extension_module'][] = 'system';

// Scripts to run upon installation or update
$modversion['onInstall'] = '';
$modversion['onUpdate'] = '';
$modversion['onUninstall'] = '';

// JQuery
$modversion['jquery'] = 1;

// Menu
$modversion['hasMain'] = 1;

$xoops = Xoops::getInstance();
if ( is_object($xoops->module) && $xoops->module->dirname() == 'xoositemap' && !$xoops->isAdminSide ) {    $xoositemap_module = Xoositemap::getInstance();
    $Xoositemap_config = $xoositemap_module->LoadConfig();
    if ($Xoositemap_config['xoositemap_main']) {        $i = 0;        foreach ($Xoositemap_config['xoositemap_module'] as $k => $module ) {            $menu = $xoops->module->getByDirName($module);            $modversion['sub'][$i]['name']  = $menu->getVar('name');
            $modversion['sub'][$i]['url']   = 'index.php?op=' . $module;
            $i++;
        }
    }
}
?>