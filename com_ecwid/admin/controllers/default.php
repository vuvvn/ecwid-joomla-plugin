<?php
/**
 * @version    $Id: default.php 10727 2013-05-28 12:51:00Z steph $
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

jimport('joomla.application.component.controllerform');

class EcwidControllerDefault extends JControllerForm
{
	public function __construct($config = array())
	{
		parent::__construct($config);
		// Apply, Save & New, and Save As copy should be standard on forms.
		$this->registerTask('apply', 'save');
	}

	public function saveAppearance()
	{
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');
		$data = array_merge(
			array(
				'displayCategories' => 0,
				'displaySearchBox' => 0,
				'displayMinicart' => 0,
			),
			$data
		);

		$result = $this->save($this->getModel()->getAppearanceForm(), $data);
		// Redirect to the list screen.
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option. '&layout=appearance', false));

		return $result;
	}

	public function saveGeneral()
	{
		$result = $this->save($this->getModel()->getAppearanceForm(), $data);
		// Redirect to the list screen.
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option . '&layout=general', false));

		return $result;
	}

	public function save($form, $data = null)
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app   = JFactory::getApplication();
		$lang  = JFactory::getLanguage();
		$model = $this->getModel();

		if (is_null($data)) {
			$data = JFactory::getApplication()->input->get('jform', array(), 'array');
		}
		$context = "$this->option.edit.$this->context";

		// Validate the posted data.
		// Sometimes the form needs some posted data, such as for plugins and modules.

		if (!$form) {
			$app->enqueueMessage($model->getError(), 'error');

			return false;
		}

		// Test if the data is valid.
		$validData = $model->validate($form, $data);

		// Check for validation errors.
		if ($validData === false) {
			// Get the validation messages.
			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if (JError::isError($errors[$i])) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState($context . '.data', $data);

			// Redirect back to the edit screen.
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option, false));

			return false;
		}

		// Attempt to save the data.
		if (!$model->save($validData)) {
			// Save the data in the session.
			$app->setUserState($context . '.data', $validData);

			// Redirect back to the edit screen.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=' . $this->option, false));

			return false;
		}

		$this->setMessage(JText::_(($lang->hasKey($this->text_prefix . ($app->isSite() ? '_SUBMIT' : '') . '_SAVE_SUCCESS') ? $this->text_prefix : 'JLIB_APPLICATION') . ($app->isSite() ? '_SUBMIT' : '') . '_SAVE_SUCCESS'));

		// Invoke the postSave method to allow for the child class to access the model.
		$this->postSaveHook($model, $validData);

		return true;
	}

	/**
	 * Method to cancel an edit.
	 *
	 * @param    string    $key    The name of the primary key of the URL variable.
	 *
	 * @return    Boolean    True if access level checks pass, false otherwise.
	 * @since    1.6
	 */
	public function cancel($key = null)
	{
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$this->setRedirect(JRoute::_('index.php?option=' . $this->option, false));
		return true;
	}
}