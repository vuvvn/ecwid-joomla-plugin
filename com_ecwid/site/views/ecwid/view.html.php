<?php
/**
 * @version   $Id: view.html.php 6867 2013-01-28 23:08:31Z btowles $
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Original by
 * @author Rick Blalock
 * @package Joomla
 * @subpackage ecwid
 * @license GNU/GPL
 *
 * ECWID.com e-commerce wrapper
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
include_once(JPATH_COMPONENT_ADMINISTRATOR.'/helpers/legacy_class.php');

/**
 * HTML View class for the ecwid component
 */
class EcwidViewEcwid extends EcwidLegacyJView {
	function display($tpl = null) {

        $this->_prepareDocument();

        parent::display($tpl);
    }

    function _prepareDocument() 
    {
        $app        = JFactory::getApplication();
        $params     = $app->getParams();

        if ($params->get('menu-meta_description'))
        {
            $this->document->setDescription($params->get('menu-meta_description'));
        }   
        
        if ($params->get('menu-meta_keywords'))
        {
            $this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
        }   
        
        if ($params->get('robots'))
        {
            $this->document->setMetadata('robots', $params->get('robots'));
        }   
    }
}
?>
