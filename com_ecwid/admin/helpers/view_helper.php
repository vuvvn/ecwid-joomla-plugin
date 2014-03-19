<?php
/**
 * @version   $Id: legacy_class.php 6867 2013-01-28 23:08:31Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('_JEXEC') or die('Restricted access');

$jversion = new JVersion();

if (version_compare($jversion->getShortVersion(), '3.0', '<')) {
    class EcwidViewHelper {
        static function buildSubmenu($items)
        {
            foreach ($items as $item)
            {
                JSubMenuHelper::addEntry($item['name'], $item['link'], $item['active']);
            }
        }

        static function renderSubmenu()
        {

        }
    }
} else {
    class EcwidViewHelper {
        static public function buildSubmenu($items)
        {
            foreach ($items as $item)
            {
                JHtmlSidebar::addEntry($item['name'], $item['link'], $item['active']);
            }
        }

        static public function renderSubmenu()
        {
            return JHtmlSidebar::render();
        }
    }
}