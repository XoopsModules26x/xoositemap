<?php

namespace XoopsModules\Xoositemap\Plugin;

/**
 * Xoopartners module
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
 * @package         Xoopartners
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)

 */
class MenusPlugin extends \Xoops\Module\Plugin\PluginAbstract implements \MenusPluginInterface
{
    /**
     * expects an array of array containing:
     * name,      Name of the submenu
     * url,       Url of the submenu relative to the module
     * ex: return array(0 => array(
     *      'name' => _MI_PUBLISHER_SUB_SMNAME3;
     *      'url' => "search.php";
     *    ));
     *
     * @return array
     */
    public function subMenus()
    {
        $ret = [];
        if (\Xoops::getInstance()->isModule() && 'xoositemap' == \Xoops::getInstance()->module->getVar('dirname')) {
            $xoops = \Xoops::getInstance();
            $helper = \XoopsModules\Xoositemap\Helper::getInstance();
            $sitemapConfig = $helper->loadConfig();

            $i = 0;
            if ($sitemapConfig['xoositemap_main']) {
                foreach ($sitemapConfig['xoositemapModule'] as $k => $module) {
                    $menu = $xoops->module->getByDirname($module);
                    $ret[$i]['name'] = $menu->getVar('name');
                    $ret[$i]['url']  = 'index.php?op=' . $module;
                    ++$i;
                }
            }
        }

        return $ret;
    }
}
