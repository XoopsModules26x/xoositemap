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

include dirname(__FILE__) . '/header.php';

$xoops->loadLanguage('preferences', 'xoositemap');

switch ($op) {    case 'save':
    if (!$xoops->security()->check()) {
        $xoops->redirect("preferences.php", 3, implode('<br />', $xoops->security()->getErrors()));
    }

    // Write configuration file
    $object = new XooSitemapPreferences();
    $object->writeConfig( $object->Prepare2Save() );
    $xoops->redirect("preferences.php", 3, _XOO_CONFIG_SAVED);
    break;
    default:
    $form = $xoops->getModuleForm(null, 'preferences', 'xoositemap');
    $form->PreferencesForm();
    $form->display();
}
include dirname(__FILE__) . '/footer.php';
?>