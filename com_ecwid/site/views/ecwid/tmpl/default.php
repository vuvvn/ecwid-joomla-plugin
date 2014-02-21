<?php
/**
 * @version   $Id: default.php 6867 2013-01-28 23:08:31Z btowles $
 * @author       RocketTheme http://www.rockettheme.com
 * @copyright    Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license      http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */
defined('_JEXEC') or die('Restricted access');

// Get Component parameters

if (!defined('ECWID_SCRIPT')) {
	define('ECWID_SCRIPT', 1);
}

$app = JFactory::getApplication();
$params = $app->getParams();

include_once (JPATH_SITE . '/components/com_ecwid/helpers/ecwid_catalog.php');

list($column_grid, $row_grid) = explode(",", $params->get('grid', '3,3'));

$options = array(
	'store_id'                        => $params->get('storeID', 1003),
	'list_of_views'                   => array('list', 'grid', 'table'),
	'ecwid_pb_categoriesperrow'       => $params->get('categoriesPerRow'),
	'ecwid_pb_productspercolumn_grid' => trim($column_grid),
	'ecwid_pb_productsperrow_grid'    => trim($row_grid),
	'ecwid_pb_productsperpage_list'   => $params->get('list'),
	'ecwid_pb_productsperpage_table'  => $params->get('table'),
	'ecwid_pb_defaultview'            => $params->get('categoryView'),
	'ecwid_pb_searchview'             => $params->get('searchView'),
	'ecwid_mobile_catalog_link'       => '',
	'ecwid_default_category_id'       => $params->get('defaultCategory'),
	'ecwid_is_secure_page'            => '',
);
?>
<div id="ecwid_jwrapper">
	<?php
	echo show_ecwid($options);
	?>
</div>
