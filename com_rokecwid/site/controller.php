<?php
/**
 * @author     Ecwid, Inc http://www.ecwid.com
 * @copyright  (C) 2009 - 2014 Ecwid, Inc.
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Contributors:
 * @author     Rick Blalock
 * @license    GNU/GPL
 * and
 * @author     RocketTheme http://www.rockettheme.com
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

include_once(JPATH_COMPONENT_ADMINISTRATOR.'/helpers/legacy_class.php');

jimport('joomla.application.component.controller');

/**
 * ecwid Component Controller
 */
class RokEcwidController extends EcwidLegacyJController {
	function display($cachable = false, $urlparams = array()) {
		$app = JFactory::getApplication();
        if (strpos(JURI::getInstance(), 'rokecwid') !== false) {
            $app->redirect(str_replace('rokecwid', 'ecwid', JURI::getInstance()), '', 'message', 301);
        }
	}
}
?>
