<?php
/**
 * @author     Ecwid, Inc http://www.ecwid.com
 * @copyright  (C) 2009 - 2014 Ecwid, Inc.
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Contributors:
 * @author     Rick Blalock
 * @license    GNU/GPL
 * and
 * @author     RocketTheme http://www.rockettheme.com
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class EcwidControllerOauth extends JControllerAdmin
{
	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask('authorize', 'processAuthorization');
		$this->registerTask('connect', 'connect');
	}

	public function connect()
	{
		$url = $this->buildConnectUrl();	
		
		$this->setRedirect($url);
	}
	
	public function processAuthorization()
	{
		if ( isset( $_REQUEST['error'] ) || !isset( $_REQUEST['code'] ) ) {
			$this->redirectOnOauthError('request_error');
		}

		$params = array();
		$params['code'] = $_REQUEST['code'];
		$params['client_id'] = $this->getClientId();
		$params['client_secret'] = $this->getClientSecret();
		$params['redirect_uri'] = $this->getRedirectUri();
		$params['grant_type'] = 'authorization_code';

		$http = JHttpFactory::getHttp();
		$result = $http->post(
			$this->getTokenUri(),
			$params
		);
		
		$response_object = null;
		if ($result->code == 200) {
			$response_object = json_decode($result->body);
		}
		
		if (!$response_object) {
			$this->redirectOnOauthError('token_response_object_error');
		}
		
		if (
			!isset($response_object->store_id)
			|| !isset($response_object->scope)
			|| !isset($response_object->access_token)
			|| ($response_object->token_type != 'Bearer')
		) {
			$this->redirectOnOauthError('token_response_contents_error');
		}
		
		Ecwid::getApiV3()->setToken($response_object->access_token);
		Ecwid::getApiV3()->setScope($response_object->scope);
		
		$this->setRedirect(JRoute::_('index.php?option=com_ecwid&layout=advanced', false));
	}
	
	protected function buildConnectUrl()
	{
		$pattern = 'https://my.ecwid.com/api/oauth/authorize?client_id=%s&redirect_uri=%s&response_type=code&scope=%s';
		
		$scope = implode(' ', array( 'create_customers', 'read_store_profile', 'read_catalog' ) );
		
		$url = sprintf(
			$pattern,
			$this->getClientId(),
			urlencode($this->getRedirectUri()),
			urlencode($scope)
		);
		
		return $url;
	}
	
	protected function getClientId()
	{
		return 'bmWzQL83eEQBrPkd';
	}
	
	protected function getClientSecret()
	{
		return 'X37DpDfXQFYmvhJHjG74HXPfWBBTTZzM';
	}
	
	protected function getRedirectUri()
	{
		return JRoute::_(JUri::base() . 'index.php?option=com_ecwid&a=b&task=oauth.authorize', false, true);
	}
	
	protected function getTokenUri()
	{
		return 'https://my.ecwid.com/api/oauth/token';
	}
	
	protected function redirectOnOauthError($error_type)
	{
		$this->setRedirect(JRoute::_('index.php?option=com_ecwid&layout=advanced&error=error', false));
	}
	
}