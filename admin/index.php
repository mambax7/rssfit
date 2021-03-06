<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    XOOPS Project (https://xoops.org)
 * @license      GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */
require_once __DIR__ . '/admin_header.php';

$do = isset($_GET['do']) ? trim($_GET['do']) : '';
$do = isset($_POST['do']) ? trim($_POST['do']) : $do;
$op = isset($_GET['op']) ? trim($_GET['op']) : 'list';
$op = isset($_POST['op']) ? trim($_POST['op']) : $op;

//$do = \Xmf\Request::getString('do', '');
//$op = \Xmf\Request::getString('op',  \Xmf\Request::getString('op', 'list', 'GET'), 'POST');
//define('RSSFIT_OK', 1);

//$adminObject = \Xmf\Module\Admin::getInstance();

if (file_exists(RSSFIT_ROOT_PATH . 'admin/do_' . $do . '.php')) {
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $hidden_do = new \XoopsFormHidden('do', $do);
    $button_save = new \XoopsFormButton('', 'submit', _AM_RSSFIT_SAVE, 'submit');
    $button_go = new \XoopsFormButton('', 'submit', _GO, 'submit');
    $button_cancel = new \XoopsFormButton('', 'cancel', _CANCEL);
    $button_cancel->setExtra('onclick="javascript:history.go(-1)"');
    $tray_save_cancel = new \XoopsFormElementTray('', '');
    $tray_save_cancel->addElement($button_save);
    $tray_save_cancel->addElement($button_cancel);
    $adminObject->displayNavigation('?do=' . $do);
    require RSSFIT_ROOT_PATH . 'admin/do_' . $do . '.php';
} else {
    $adminObject->displayNavigation(basename(__FILE__));
    $adminObject->displayIndex();
}

require_once __DIR__ . '/admin_footer.php';
