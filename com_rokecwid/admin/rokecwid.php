<?php
/**
 * @version    $Id: rokecwid.php 10741 2013-05-28 17:02:09Z steph $
 * @author     RocketTheme http://www.rockettheme.com
 * @copyright  Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Based on work by
 * @author     Rick Blalock
 * @package    Joomla
 * @subpackage ecwid
 * @license    GNU/GPL
 *
 * ECWID.com e-commerce wrapper
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
include_once(JPATH_COMPONENT_ADMINISTRATOR . '/helpers/legacy_class.php');
require_once( JPATH_COMPONENT_ADMINISTRATOR.'/controller.php' );


$controller = RokEcwidLegacyJController::getInstance('RokEcwid');
$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
?>