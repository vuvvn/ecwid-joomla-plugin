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

jimport('joomla.plugin.plugin');

class plgSystemEcwid extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access    protected
	 *
	 * @param    object    $subject The object to observe
	 * @param     array    $config  An array that holds the plugin configuration
	 *
	 * @since    1.0
	 */
	function plgSystemEcwid(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}

    /**
     * onBeforeRender handler
     *
     * Adds the prefetch metas
     *
     * @access  public
     * @return null
     */
    function onBeforeRender()
    {
        $doc = JFactory::getDocument();

        if ($doc->getType() == 'html') {
            $doc->addCustomTag('<link rel="dns-prefetch" href="//images-cdn.ecwid.com/">');
            $doc->addCustomTag('<link rel="dns-prefetch" href="//images.ecwid.com/">');
            $doc->addCustomTag('<link rel="dns-prefetch" href="//app.ecwid.com/">');
        }
    }

	/**
	 * onAfterInitialise handler
	 *
	 * Adds the mtupgrade folder to the list of directories to search for JHTML helpers.
	 *
	 * @access    public
	 * @return null
	 */
	function onAfterRender()
	{

		//print_r ($body);

		if (defined('ECWID_SCRIPT')) {

			$app = JFactory::getApplication();

			$eparams = $app->getParams();
			if ($eparams->get('storeID', null) == null) {
				$eparams = JComponentHelper::getParams('com_ecwid');
			}

			$body    = JResponse::getBody();

			$ecwid_script = "app.ecwid.com/script.js";
            $protocol     = '//';
            $escript      = PHP_EOL . '<script data-cfasync="false" type="text/javascript" src="' . $protocol . $ecwid_script . '?' . $eparams->get('storeID', 1003) . '&data_platform=joomla"></script>';

			// split up the body after the body tag			
			$matches = preg_split('/(<body.*?>)/i', $body, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

            $sso = $this->getSSOCode($eparams);

			/* assemble the HTML output back with the iframe code in it */
			$body = $matches[0] . $matches[1] . $escript . $sso . $matches[2];

			JResponse::setBody($body);


		}
	}

    protected function getSSOCode($params)
    {
        require_once JPATH_SITE
            . DIRECTORY_SEPARATOR . 'components'
            . DIRECTORY_SEPARATOR . 'com_ecwid'
            . DIRECTORY_SEPARATOR . 'helpers'
            . DIRECTORY_SEPARATOR . 'common.php';

        $key = $params->get('ssoKey');

        if (empty($key) || !EcwidCommon::isPaidAccount($params->get('storeID'))) {
            return "";
        }

        global $current_user;
        $user = JFactory::getUser();

        $sso_profile = '';
        if ($user->get('id')) {

            $user_data = array(
                'appId' => "wp_" . $params->get('storeID'),
                'userId' => $user->get('id'),
                'profile' => array(
                    'email' => $user->get('email'),
                    'billingPerson' => array(
                        'name' => $user->get('name')
                    )
                )
            );

            $user_data = base64_encode(json_encode($user_data));
            $time = time();
            $hmac = hash_hmac('sha1', "$user_data $time", $key);

            $sso_profile = "$user_data $hmac $time";
        }

        $signin_url = JRoute::_('index.php?option=com_users&view=login');
        $signout_url = JRoute::_('index.php?option=com_user&task=logout');
        $sign_in_out_urls = <<<JS
window.Ecwid.OnAPILoaded.add(function() {
                window.Ecwid.setSignInUrls({
        signInUrl: '$signin_url',
        signOutUrl: '$signout_url' // signOutUrl is optional
    });
});
  window.Ecwid.setSignInProvider({
    addSignInLinkToPB: function() { return true; },
    canSignOut: function() { return true; },
  });
JS;

        return '<script type="text/javascript"> var ecwid_sso_profile="'
            . $sso_profile
            . '";'
            . $sign_in_out_urls
            . '</script>';

    }
}
