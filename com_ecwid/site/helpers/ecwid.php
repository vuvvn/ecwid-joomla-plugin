<?php

class Ecwid {
	
	protected static $is_paid_account = null;
	
	public static function getSso()
	{
		if (!class_exists('EcwidSSO')) {
			JLoader::register(
				'EcwidSSO',
				JPATH_COMPONENT_SITE . DIRECTORY_SEPARATOR .
				'helpers' . DIRECTORY_SEPARATOR .
				'sso.php'
			);
		}
		
		return EcwidSSO::getInstance();
	}
	
	public static function getApiV3()
	{
		if (!class_exists('EcwidApiV3')) {
			JLoader::register(
				'EcwidApiV3',
				JPATH_COMPONENT_SITE . DIRECTORY_SEPARATOR .
				'helpers' . DIRECTORY_SEPARATOR .
				'apiv3.php'
			);
		}

		return EcwidApiV3::getInstance();
	}

	public static function setParam($param, $value) {

		$params = new JRegistry();
		$table  = JTable::getInstance('extension');
		$result = $table->find(array('element' => 'com_ecwid'));
		$table->load($result);
		$params->loadString($table->params);

		$params->set($param, $value);

		$table  = JTable::getInstance('extension');
		$result = $table->find(array('element' => 'com_ecwid'));
		$table->load($result);

		$table->params = $params->__toString();

		$table->store();
	}
	
	public static function getParam($name) {
		return JComponentHelper::getParams('com_ecwid')->get($name);
	}
	
	public static function isPaidAccount()
	{
		if (!is_null(self::$is_paid_account)) {
			return self::$is_paid_account;
		}
		
		if (self::getApiV3()->getToken()) {
			return self::$is_paid_account = Ecwid::getApiV3()->isPaidAccount();
		}

		if (EcwidCommon::isPaidAccount()) {
			return self::$is_paid_account = true;
		}

		return self::$is_paid_account = false;
	}
	
}