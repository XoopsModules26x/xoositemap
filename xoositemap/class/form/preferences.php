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
    public function __construct()
    {        $this->_config = XooSitemapPreferences::getInstance()->loadConfig();
    }

    /**
     * Maintenance Form
     * @return void
     */
    public function PreferencesForm()
    {        extract( $this->_config );
        parent::__construct('', "form_preferences", "preferences.php", 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        // main
        $this->addElement( new XoopsFormRadioYN(_MI_XOO_CONFIG_MAIN, 'xoositemap_main', $xoositemap_main) );

        // main
        $this->addElement( new XoopsFormRadioYN(_MI_XOO_CONFIG_SUBCAT, 'xoositemap_subcat', $xoositemap_subcat) );

        // welcome
        $this->addElement( new XoopsFormTextArea(_MI_XOO_CONFIG_WELCOME, 'xoositemap_welcome', $xoositemap_welcome, 12, 12) );

        // Modules
        $system_module = new SystemModule();
        $installed = $system_module->getModuleList();
        $modules = new XoopsFormSelect(_MI_XOO_CONFIG_MODULES, 'xoositemap_module', $xoositemap_module, count($installed)-1, true);
        foreach ($installed as $module ) {
            if ( $module->getVar('dirname') != 'system') {
                if ( file_exists(XOOPS_ROOT_PATH . '/modules/' . $module->getVar('dirname') . '/include/plugin.xoositemap.php') || file_exists(XOOPS_ROOT_PATH . '/modules/xoositemap/plugins/' . $module->getVar('dirname') . '.php') ) {                    $modules->addOption($module->getVar('dirname'), $module->getVar('dirname') );                }
            }
        }
        $this->addElement( $modules );

        // button
        $button_tray = new XoopsFormElementTray('', '');
        $button_tray->addElement(new XoopsFormHidden('op', 'save'));
        $button_tray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        $button_tray->addElement(new XoopsFormButton('', 'reset', _RESET, 'reset'));
        $cancel_send = new XoopsFormButton('', 'cancel', _CANCEL, 'button');
        $cancel_send->setExtra("onclick='javascript:history.go(-1);'");
        $button_tray->addElement($cancel_send);
        $this->addElement($button_tray);
    }
}
?>