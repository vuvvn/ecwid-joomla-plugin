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


$options = array(
	'store_id'                        => $params->get('storeID', 1003),
	'list_of_views'                   => array('list', 'grid', 'table'),
	'ecwid_pb_categoriesperrow'       => $params->get('categoriesPerRow', 3),
	'ecwid_pb_productspercolumn_grid' => $params->get('gridColumns', 3),
	'ecwid_pb_productsperrow_grid'    => $params->get('gridRows', 3),
	'ecwid_pb_productsperpage_list'   => $params->get('list', 10),
	'ecwid_pb_productsperpage_table'  => $params->get('table', 20),
	'ecwid_pb_defaultview'            => $params->get('categoryView', 'grid'),
	'ecwid_pb_searchview'             => $params->get('searchView', 'list'),
	'ecwid_mobile_catalog_link'       => '',
	'ecwid_default_category_id'       => $params->get('defaultCategory'),
	'ecwid_is_secure_page'            => '',
	'display_categories'			  => $params->get('displayCategories', 1),
	'display_search'			      => $params->get('displaySearch', 1)
);
?>
<div id="ecwid_jwrapper">
	<?php
	echo show_ecwid($options);
	?>
</div>
