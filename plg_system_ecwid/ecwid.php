<?php
/**
 * @author     Ecwid, Inc http://www.ecwid.com
 * @copyright  (C) 2009 - 2016 Ecwid, Inc.
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

        JLoader::register(
            'EcwidCommon',
            JPATH_SITE . DIRECTORY_SEPARATOR .
            'components' . DIRECTORY_SEPARATOR .
            'com_ecwid' . DIRECTORY_SEPARATOR .
            'helpers' . DIRECTORY_SEPARATOR .
            'common.php'
        );
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

        if (JFactory::getApplication()->isAdmin()) {

            $input = JFactory::getApplication()->input;

            if ('com_menus' == $input->getCmd('option') && 'item' == $input->getCmd('view')) {
                $doc->addScript('components/com_ecwid/assets/menu-item.js');
                $doc->addStylesheet('components/com_ecwid/assets/css/menu-item.css');
            }

            $is_landing = $input->getCmd('option') == 'com_cpanel';
            $is_ecwid = $input->getCmd('option') == 'com_ecwid';

            if (!$is_landing && !$is_ecwid) return;

            $params = JComponentHelper::getParams('com_ecwid');

            $installDate = $params->get('ecwidInstallDate');
            if (empty($installDate)) {
                EcwidCommon::setParam('ecwidInstallDate', time());
            }

            if (!$params->get('hideVoteMessage') && time() - $params->get('ecwidInstallDate') > 60*60*24*30 && EcwidCommon::isPaidAccount()) {

                $doc->addStylesheet('components/com_ecwid/assets/css/messages.css');
                $doc->addScript('components/com_ecwid/assets/messages.js');

                JPlugin::loadLanguage('com_ecwid', JPATH_ADMINISTRATOR);
                $message = JText::_('COM_ECWID_VOTE_MESSAGE');
                $buttonText = JText::_('COM_ECWID_VOTE_BUTTON');
                $hideText = JText::_('COM_ECWID_VOTE_HIDE');
                $url = 'http://extensions.joomla.org/write-review/review/add?extension_id=1017';
                $messageHtml = <<<HTML
            <div id="ecwid-vote-message" style="display:inline-block;width:100%">
                <div id="ecwid-vote-text">$message</div>
                <a class="btn btn-primary" id="ecwid-vote-button" target="_blank" href="$url">$buttonText</a>
                <a href="javascript:void(0);" id="ecwid-vote-hide">$hideText</a>
            </div>
HTML;
                JFactory::getApplication()->enqueueMessage($messageHtml, 'message');
            }

        }
    }

    function onAfterRender()
    {

        $doc = JFactory::getDocument();
        $app = JFactory::getApplication();

        if ($app->isSite() && $doc->getType() == 'html') {
            $eparams = $app->getParams();
            if ($eparams->get('storeID', null) == null) {
                $eparams = JComponentHelper::getParams('com_ecwid');
            }

            $body = method_exists($app, 'getBody') ? $app->getBody() : JResponse::getBody();

            $ecwid_script = "app.ecwid.com/script.js";
            $protocol = 'https://';
            $escript  = PHP_EOL . '<script data-cfasync="false" type="text/javascript" src="' . $protocol . $ecwid_script . '?' . $eparams->get('storeID', 1003) . '&data_platform=joomla"></script>';

            // split up the body after the body tag
            $matches = preg_split('/(<body.*?>)/i', $body, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

            $sso = $this->getSSOCode($eparams);
            if (defined('ECWID_SCRIPT')) {
                $body = $matches[0] . $matches[1] . $escript . $sso . $matches[2];
            } else {
                $body = $matches[0] . $matches[1] . $sso . $matches[2];
            }

            if (method_exists($app, 'setBody')) {
                $app->setBody($body);
            } else {
                JResponse::setBody($body);
            }
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

        $pb_url = EcwidCommon::getProductBrowserURL();

        $template = JRoute::_('index.php?option=com_users&view=login&return=ECWIDBACKURL', false);
        $signin_url = str_replace('BACKURL', base64_encode($pb_url), $template);
        $sign_in_out_urls = <<<JS


var ecwidSignInUrlTemplate = '$template';

if (typeof window.btoa != 'undefined') {
    window.Ecwid.OnPageLoaded.add(function() {
        var url = ecwidSignInUrlTemplate.replace('ECWIDBACKURL', btoa(location.href));
        window.Ecwid.setSignInUrls({
            signInUrl: url,
            signOutUrl: url
        });
    });
}

window.Ecwid.OnAPILoaded.add(function() {
    window.Ecwid.setSignInUrls({
        signInUrl: '$signin_url',
        signOutUrl: '$signin_url'
    });
});

JS;

        return <<<JS

<script type="text/javascript">
var ecwid_sso_profile="$sso_profile";
$sign_in_out_urls
</script>

JS;
    }
}
