<?php
/**
 * @version   $Id: ecwid.php 6867 2013-01-28 23:08:31Z btowles $
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

// Require the base controller
require_once JPATH_COMPONENT . '/controller.php';

// Initialize the controller
$controller = new EcwidController();
$controller->execute( null );

// Redirect if set by the controller
$controller->redirect();
?>
