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
use Xoops\Core\Request;

require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';

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

$script_name = basename(Request::getString('SCRIPT_NAME', '', 'SERVER'), '.php');

$helper = \XoopsModules\Xoositemap\Helper::getInstance();
$sitemapConfig = $helper->loadConfig();

\XoopsLoad::load('system', 'system');
$system = \System::getInstance();

$xoops = \Xoops::getInstance();
if ('about' !== $script_name) {
    $xoops->header('xoositemap_admin_' . $script_name . '.tpl');
} else {
    $xoops->header();
}
$xoops->theme()->addStylesheet('modules/xoositemap/assets/css/moduladmin.css');

$admin_page = new \Xoops\Module\Admin();
if ('about' !== $script_name && 'index' !== $script_name) {
    $admin_page->renderNavigation(basename(Request::getString('SCRIPT_NAME', '', 'SERVER')));
} elseif ('index' !== $script_name) {
    $admin_page->displayNavigation(basename(Request::getString('SCRIPT_NAME', '', 'SERVER')));
}
