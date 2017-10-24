<?php
/**
 * ****************************************************************************
 * oledrion - MODULE FOR XOOPS
 * Copyright (c) Hervé Thouzard of Instant Zero (http://www.instant-zero.com)
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       Hervé Thouzard of Instant Zero (http://www.instant-zero.com)
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         oledrion
 * @author 			Hervé Thouzard of Instant Zero (http://www.instant-zero.com)
 *
 * ****************************************************************************
 */

if (!defined('RSSFIT_ROOT_PATH')) {
    exit();
}

/**
 * Class RssfitOledrion
 */
class RssfitOledrion
{
    public $dirname = 'oledrion';
    public $modname;
    public $grab;

    public function loadModule()
    {
        $mod = $GLOBALS['module_handler']->getByDirname($this->dirname);
        if (!$mod || !$mod->getVar('isactive')) {
            return false;
        }
        $this->modname = $mod->getVar('name');
        return $mod;
    }

    public function &grabEntries(&$obj)
    {
        $ret = false;
        include XOOPS_ROOT_PATH.'/modules/oledrion/include/common.php';
        $items = $h_oledrion_products->getRecentProducts(new Oledrion_parameters(array('start' => 0, 'limit' => $this->grab)));
        $i = 0;

        if (false != $items && count($items) > 0) {
            foreach ($items as $item) {
                $ret[$i]['link'] = $ret[$i]['guid'] = $item->getLink();
                $ret[$i]['title'] = $item->getVar('product_title', 'n');
                $ret[$i]['timestamp'] = $item->getVar('product_submitted');
                if (xoops_trim($item->getVar('product_summary')) != '') {
                    $description = $item->getVar('product_summary');
                } else {
                    $description = $item->getVar('product_description');
                }
                $ret[$i]['description'] = $description;
                $ret[$i]['category'] = $this->modname;
                $ret[$i]['domain'] = XOOPS_URL.'/modules/'.$this->dirname.'/';
                $i++;
            }
        }
        return $ret;
    }
}
