<?php
/**
 * @version   $Id: legacy_class.php 6867 2013-01-28 23:08:31Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 */
defined('_JEXEC') or die('Restricted access');

if (!class_exists('RokEcwidLegacyJView', false)) {
	$jversion = new JVersion();
	if (version_compare($jversion->getShortVersion(), '2.5.5', '>')) {
		class RokEcwidLegacyJView extends JViewLegacy
		{
		}

		class RokEcwidLegacyJController extends JControllerLegacy
		{
		}

		class RokEcwidLegacyJModel extends JModelLegacy
		{
		}
	} else {
		jimport('joomla.application.component.view');
		jimport('joomla.application.component.controller');
		jimport('joomla.application.component.model');
		class RokEcwidLegacyJView extends JView
		{
		}

		class RokEcwidLegacyJController extends JController
		{
		}

		class RokEcwidLegacyJModel extends JModel
		{
		}
	}
}
