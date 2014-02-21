<?php
/**
 * @version   $Id: legacy_class.php 6867 2013-01-28 23:08:31Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('_JEXEC') or die('Restricted access');

if (!class_exists('EcwidLegacyJView', false)) {
	$jversion = new JVersion();
	if (version_compare($jversion->getShortVersion(), '2.5.5', '>')) {
		class EcwidLegacyJView extends JViewLegacy
		{
		}

		class EcwidLegacyJController extends JControllerLegacy
		{
		}

		class EcwidLegacyJModel extends JModelLegacy
		{
		}
	} else {
		jimport('joomla.application.component.view');
		jimport('joomla.application.component.controller');
		jimport('joomla.application.component.model');
		class EcwidLegacyJView extends JView
		{
		}

		class EcwidLegacyJController extends JController
		{
		}

		class EcwidLegacyJModel extends JModel
		{
		}
	}
}
