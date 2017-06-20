<?php

class EcwidSSO
{
	static protected $instance = null;
	
	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new EcwidSSO();
		}
		
		return self::$instance;
	}
	
	public function isEnabled()
	{
		if (Ecwid::getParam('ssoKey') != '') {
			return true;
		}

		if (!$this->isAvailable()) {
			return false;
		}

		if (
			Ecwid::getParam('ssoEnabled') 
			&& Ecwid::getApiV3()->getToken() != '' 
			&& Ecwid::getApiV3()->hasScope('create_customers')
		) {
			return true;
		}
		
		return false;
	}
	
	public function isAvailable()
	{
		return Ecwid::isPaidAccount();
	}	
}
