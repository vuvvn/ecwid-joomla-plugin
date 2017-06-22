<?php

class Ecwid {
	
	protected static $is_paid_account = null;
	
	public static function getSso()
	{
		if (!class_exists('EcwidSSO')) {
			self::registerHelper('EcwidSSO', 'sso.php');
		}
		
		return EcwidSSO::getInstance();
	}
	
	public static function getApiV3()
	{
		if (!class_exists('EcwidApiV3')) {
			self::registerHelper('EcwidApiV3', 'apiv3.php');
		}

		return EcwidApiV3::getInstance();
	}

	protected static function registerHelper($class, $file = null)
	{
		if (is_null($file)) {
			$file = strtolower($class) . '.php';
		}
 		JLoader::register($class,
			JPATH_SITE . DIRECTORY_SEPARATOR .
			'components' . DIRECTORY_SEPARATOR .
			'com_ecwid' . DIRECTORY_SEPARATOR .
			'helpers' . DIRECTORY_SEPARATOR .
			$file
		);
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