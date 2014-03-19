<?php
/**
 * @version    $Id: view.html.php 10741 2013-05-28 17:02:09Z steph $
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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
jimport('joomla.application.component.helper');
JHtml::_("behavior.framework");
include_once(JPATH_COMPONENT_ADMINISTRATOR . '/helpers/legacy_class.php');
include_once(JPATH_COMPONENT_ADMINISTRATOR . '/helpers/view_helper.php');

/**
 * HTML View class for the Rokdownloads component
 *
 * @static
 * @package        Joomla
 * @subpackage     RokDownloads
 * @since          1.0
 */

class EcwidViewDefault extends EcwidLegacyJView
{

	protected $storeID;

	protected $api;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		if ($this->_layout == 'default') {
			if ($this->isStoreIdSet()) {
				$this->setLayout('general');
			} else {
				$this->setLayout('general_initial');
			}
		}

		$option   = JFactory::getApplication()->input->getWord('option', 'com_ecwid');
		$document = JFactory::getDocument();
		$document->addStyleSheet('components/' . $option . '/assets/css/pure-min.css');
        $document->addStyleSheet('components/' . $option . '/assets/css/ecwid.css');
		$document->addStyleSheet('components/' . $option . '/assets/css/' . $this->getLayout() . '.css');

		$this->params = $this->get('params');

		$this->addToolbar();
		$this->addSubmenu();

		$this->form = $this->getForm();

		$document = JFactory::getDocument();
		$document->setTitle(JText::_('Ecwid Edit Configuration'));
		parent::display($tpl);
	}

	public function getForm()
	{
		if (!isset($this->form)) {
			$this->form = null;
		}
		$form = $this->get($this->getLayout() . 'Form');
		if (empty($form)) {
			if (method_exists(get_parent_class(), 'getForm')) {
				$form = parent::getForm();
			} else {
				$form = $this->get('form');
			}
		}

		return $this->form = $form;
	}

    protected function getPage()
    {
        return in_array($this->getLayout(), array('general', 'general_initial')) ? 'general' : $this->getLayout();
    }

	/**
	 * Add the page title and toolbar.
	 *
	 * @since    1.6
	 */
	protected function addToolbar()
	{
		JToolBarHelper::title(JText::_('COM_ECWID_CONFIGURATION'));
        JToolBarHelper::apply('default.save' . ($this->getPage()), 'COM_ECWID_SAVE');

		JToolBarHelper::divider();
	}

	protected function addSubmenu()
	{
        $submenu = array(
            array(
                'name'   => JText::_('COM_ECWID_GENERAL_SETTINGS'),
                'link'   => JRoute::_('index.php?option=com_ecwid'),
                'active' => $this->getPage() == 'general'
            ),
            array(
                'name'   => JText::_('COM_ECWID_APPEARANCE_SETTINGS'),
                'link'   => JRoute::_('index.php?option=com_ecwid&layout=appearance'),
                'active' => $this->getPage() == 'appearance'
            ),
            array(
                'name'   => JText::_('COM_ECWID_ADVANCED_SETTINGS'),
                'link'   => JRoute::_('index.php?option=com_ecwid&layout=advanced'),
                'active' => $this->getPage() == 'advanced'
            )
        );

        EcwidViewHelper::buildSubmenu($submenu);
		$this->submenu = EcwidViewHelper::renderSubmenu();
	}

	protected function isPaidAccount()
	{
		$api = $this->getProductAPI();

		return $this->getStoreID() != 1003 && $api->is_api_enabled();
	}

	protected function getProductAPI()
	{
		if (is_null($this->api)) {
			$this->api = new EcwidProductApi($this->getStoreID());
		}

		return $this->api;
	}

    protected function isStoreIdSet()
    {
        $storeID = $this->getStoreID();

        return !empty($storeID) && $storeID != 1003;
    }

	protected function getStoreID()
	{
		if (is_null($this->storeID)) {
			$this->storeID = JComponentHelper::getParams('com_ecwid')->get('storeID');
		}

		return $this->storeID;
	}

	protected function embedSvg($name)
	{
		$code = file_get_contents(JPATH_COMPONENT_ADMINISTRATOR . '/assets/svg/' . $name . '.svg');

		echo $code;
	}

	protected function renderElement($name)
	{
		echo $this->getForm()->getField($name)->input;
	}

	protected function renderLabel($name)
	{
		echo $this->getForm()->getField($name)->label;
	}
}
