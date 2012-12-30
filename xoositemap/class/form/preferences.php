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

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class XooSitemapPreferencesForm extends XoopsThemeForm
{
    private $_config = array();
    /**
     * @param null $obj
     */
    public function __construct($config)
    {        extract( $config );
        parent::__construct('', 'form_preferences', 'preferences.php', 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        $tabtray = new XoopsFormTabTray('', 'uniqueid');

        /**
         * Main page
         */
        $tab1 = new XoopsFormTab(_XOO_CONFIG_MAINPAGE, 'tabid-1');
        $tab1->addElement( new XoopsFormRadioYN(_XOO_CONFIG_MAIN, 'xoositemap_main', $xoositemap_main) );

        // main
        $tab1->addElement( new XoopsFormRadioYN(_XOO_CONFIG_SUBCAT, 'xoositemap_subcat', $xoositemap_subcat) );

        // welcome
        $tab1->addElement( new XoopsFormTextArea(_XOO_CONFIG_WELCOME, 'xoositemap_welcome', $xoositemap_welcome, 12, 12) );

        /**
         * Main page
         */
        $tab2 = new XoopsFormTab(_XOO_CONFIG_MODULES, 'tabid-2');
        $system_module = new SystemModule();
        $installed = $system_module->getModuleList();
        $modules = new XoopsFormSelect(_XOO_CONFIG_MODULES_SELECT, 'xoositemap_module', $xoositemap_module, count($installed)-1, true);
        foreach ($installed as $module ) {
            $plugin = Xoops_Module_Plugin::getPlugin($module->getVar('dirname'), 'xoositemap');
            if (is_object($plugin)) {                $modules->addOption($module->getVar('dirname'), $module->getVar('dirname') );
            }
        }
        $tab2->addElement( $modules );

        $tabtray->addElement($tab1);
        $tabtray->addElement($tab2);
        $this->addElement($tabtray);

        /**
         * Buttons
         */
        $button_tray = new XoopsFormElementTray('', '');
        $button_tray->addElement(new XoopsFormHidden('op', 'save'));

        $button = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
        $button->setClass('btn btn-success');
        $button_tray->addElement($button);

        $button_2 = new XoopsFormButton('', 'reset', _RESET, 'reset');
        $button_2->setClass('btn btn-warning');
        $button_tray->addElement($button_2);

        $button_3 = new XoopsFormButton('', 'cancel', _CANCEL, 'button');
        $button_3->setExtra("onclick='javascript:history.go(-1);'");
        $button_3->setClass('btn btn-danger');
        $button_tray->addElement($button_3);

        $this->addElement($button_tray);
    }
}
?>