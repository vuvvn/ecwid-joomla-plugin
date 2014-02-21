<?php
/**
 * @version   $Id: mod_rokecwid_search.php 6867 2013-01-28 23:08:31Z btowles $
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

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
if (!defined('ECWID_SCRIPT')) define('ECWID_SCRIPT',1);

global $ecwid_itemid, $Itemid, $option;

if ($option=='com_rokecwid') {
	$ecwid_itemid = $Itemid;
} elseif (!isset($ecwid_itemid)) {
	$db = JFactory::getDBO();
	$queryitemid = "SELECT id FROM #__menu WHERE type='component' AND link LIKE '%com_rokecwid%view=ecwid%' ORDER BY id ASC LIMIT 1";
	$db->setQuery($queryitemid);
	$ecwid_itemid = $db->loadResult();
}

?>
<script type="text/javascript">
	var ecwid_ProductBrowserURL = "<?php echo JRoute::_('index.php?option=com_rokecwid&Itemid='.$ecwid_itemid, true); ?>";
</script>

<div id="ecwid_search_module_wrapper">
	<script type="text/javascript"> xSearchPanel("style="); </script>
</div>
