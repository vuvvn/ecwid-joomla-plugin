<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

// The class name must always be the same as the filename (in camel case)
class JFormFieldStoreIdForMenuItem extends JFormFieldText {

    //The field class must know its own type through the variable $type.
    protected $type = 'StoreIdForMenuItem';

        public function getInput() {

            $ver = new JVersion();
            if (!$ver->isCompatible('3')) {
                $doc = JFactory::getDocument();

                $doc->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
            }

            if (empty($this->value)) {
                $params = JComponentHelper::getParams('com_ecwid');
                $this->value = $params->get('storeID');
            }

            return parent::getInput();
        }
}