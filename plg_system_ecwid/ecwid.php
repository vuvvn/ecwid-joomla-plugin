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

		if (isset($_GET['_escaped_fragment_'])) {
			foreach ($doc->_links as $key => $link) {
				if ($link['relation'] == 'canonical') {
					unset($doc->_links[$key]);
				}
			}
		}
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
			$eparams = JComponentHelper::getParams('com_ecwid');
			$body    = JResponse::getBody();

			$ecwid_script = "app.ecwid.com/script.js";
            $protocol     = '//';
            $escript      = '<script data-cfasync="false" type="text/javascript" src="' . $protocol . $ecwid_script . '?' . $eparams->get('storeID', 1003) . '&data_platform=joomla"></script>';

			// split up the body after the body tag			
			$matches = preg_split('/(<body.*?>)/i', $body, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);


			/* assemble the HTML output back with the iframe code in it */
			$body = $matches[0] . $matches[1] . $escript . $matches[2];

			JResponse::setBody($body);


		}
	}
}
