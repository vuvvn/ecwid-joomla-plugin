<?php
/**
 * @version    $Id: controller.php 6867 2013-01-28 23:08:31Z btowles $
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

/**
 * ecwid Controller
 *
 * @package    Joomla
 * @subpackage ecwid
 */
include_once(JPATH_COMPONENT_ADMINISTRATOR . '/helpers/legacy_class.php');

class EcwidController extends EcwidLegacyJController
{
	protected $default_view = 'default';
}