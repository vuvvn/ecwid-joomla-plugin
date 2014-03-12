<?php
/**
 * @version   $Id: controller.php 10387 2013-05-17 12:33:14Z steph $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Based on work by
 * @author Rick Blalock
 * @package Joomla
 * @subpackage ecwid
 * @license GNU/GPL
 *
 * ECWID.com e-commerce wrapper
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
include_once(JPATH_COMPONENT_ADMINISTRATOR.'/helpers/legacy_class.php');

jimport('joomla.application.component.controller');

/**
 * ecwid Component Controller
 */
class RokEcwidController extends EcwidLegacyJController {
	function display($cachable = false, $urlparams = array()) {
		$app = JFactory::getApplication();
                $app->redirect(str_replace('com_rokecwid', 'com_ecwid', JURI::getInstance()), '', 'message', 301);
	}
}
?>
