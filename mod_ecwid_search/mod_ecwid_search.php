<?php
/**
 * @version   1.3 July 15, 2011
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2011 RocketTheme, LLC
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
/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
if (!defined('ECWID_SCRIPT')) define('ECWID_SCRIPT',1);

JFactory::getDocument()->addStyleSheet(JURI::base() . 'components/com_ecwid/assets/frontend.css');


require_once JPATH_SITE
    . DIRECTORY_SEPARATOR . 'components'
    . DIRECTORY_SEPARATOR . 'com_ecwid'
    . DIRECTORY_SEPARATOR . 'helpers'
    . DIRECTORY_SEPARATOR . 'common.php';

echo EcwidCommon::getProductBrowserJS();
?>

<div id="ecwid_search_module_wrapper">
	<script type="text/javascript"> xSearchPanel("style="); </script>
</div>
