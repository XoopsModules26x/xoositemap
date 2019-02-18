<?php

namespace XoopsModules\Xoositemap\Form;

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
class PreferencesForm extends \Xoops\Form\ThemeForm
{
    private $config = [];

    /**
     * @param string $config
     * @internal param null $obj
     */
    public function __construct($config)
    {
        extract($config);

        parent::__construct('', 'form_preferences', 'preferences.php', 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        $tabTray = new \Xoops\Form\TabTray('', 'uniqueid');

        /**
         * Main page
         */
        $tab1 = new \Xoops\Form\Tab(_XOO_CONFIG_MAINPAGE, 'tabid-1');
        $tab1->addElement(new \Xoops\Form\RadioYesNo(_XOO_CONFIG_MAIN, 'xoositemap_main', $xoositemap_main));

        // main
        $tab1->addElement(new \Xoops\Form\RadioYesNo(_XOO_CONFIG_SUBCAT, 'xoositemap_subcat', $xoositemap_subcat));

        // welcome
        $tab1->addElement(new \Xoops\Form\TextArea(_XOO_CONFIG_WELCOME, 'xoositemap_welcome', $xoositemap_welcome, 12, 12));

        /**
         * Main page
         */
        $tab2 = new \Xoops\Form\Tab(_XOO_CONFIG_MODULES, 'tabid-2');
        $systemModule = new \SystemModule();
        $installed    = $systemModule->getModuleList();
        $modules = new \Xoops\Form\Select(_XOO_CONFIG_MODULES_SELECT, 'xoositemapModule', $xoositemapModule, count($installed) - 1, true);
        foreach ($installed as $module) {
            $plugin = \Xoops\Module\Plugin::getPlugin($module->getVar('dirname'), 'xoositemap');
            if (is_object($plugin)) {
                $modules->addOption($module->getVar('dirname'), $module->getVar('dirname'));
            }
        }
        $tab2->addElement($modules);

        $tabTray->addElement($tab1);
        $tabTray->addElement($tab2);
        $this->addElement($tabTray);

        /**
         * Buttons
         */
        $buttonTray = new \Xoops\Form\ElementTray('', '');
        $buttonTray->addElement(new \Xoops\Form\Hidden('op', 'save'));

        $buttonSubmit = new \Xoops\Form\Button('', 'submit', \XoopsLocale::A_SUBMIT, 'submit');
        $buttonSubmit->setClass('btn btn-success');
        $buttonTray->addElement($buttonSubmit);

        $buttonReset = new \Xoops\Form\Button('', 'reset', \XoopsLocale::A_RESET, 'reset');
        $buttonReset->setClass('btn btn-warning');
        $buttonTray->addElement($buttonReset);

        $buttonCancel = new \Xoops\Form\Button('', 'cancel', \XoopsLocale::A_CANCEL, 'button');
        $buttonCancel->setExtra("onclick='javascript:history.go(-1);'");
        $buttonCancel->setClass('btn btn-danger');
        $buttonTray->addElement($buttonCancel);

        $this->addElement($buttonTray);
    }
}
