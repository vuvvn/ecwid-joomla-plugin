<?php
/**
 * @version   $Id: common.php 11282 2013-06-06 13:23:58Z steph $
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


/**
 * ecwid Common Helper
 */
class EcwidCommon  {

	function displayECWIDScript() {
	
		// Get Component parameters
		$eparams = JComponentHelper::getParams( 'com_ecwid' );
		
		$body = JResponse::getBody();
		
		//var_dump ($body);
		
		$ecwid_script = "app.ecwid.com/script.js";
        $protocol     = '//';
		
		if (!defined('ECWID_SCRIPT')) {
			//echo '<script type="text/javascript" src="'. $protocol.$ecwid_script.'?'. $eparams->get('storeID', 1003). '"></script>'."\n";
			define('ECWID_SCRIPT',1);
		
		}
		
	
	}	
	


	// Returns ecwid_ProductBrowserURL javascript code that provides modules with a product browser url to link to
	function getProductBrowserJS() {
		global $ecwid_itemid, $Itemid, $option;

		if ($option == 'com_ecwid') {
			$ecwid_itemid = $Itemid;
		} elseif (!isset($ecwid_itemid)) {
			$db = JFactory::getDBO();
			$queryitemid = "SELECT id FROM #__menu WHERE type='component' AND link LIKE '%com_ecwid%view=ecwid%' AND published='1' ORDER BY id ASC LIMIT 1";
			$db->setQuery($queryitemid);
			$ecwid_itemid = $db->loadResult();
		}
		$url = 'index.php?option=com_ecwid';
		if ($ecwid_itemid) {
			$url .= '&Itemid=' . $ecwid_itemid;
		}

		$url = JRoute::_($url, true);

		$code = '<script type="text/javascript">';
		$code .= ' var ecwid_ProductBrowserURL = "' . $url . '"';
		$code .= '</script>';

		return $code;
	}

	
}
?>
