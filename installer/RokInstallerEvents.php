<?php
/**
 * @author	 Ecwid, Inc http://www.ecwid.com
 * @copyright  (C) 2009 - 2014 Ecwid, Inc.
 * @license	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Contributors:
 * @author	 Rick Blalock
 * @license	GNU/GPL
 * and
 * @author	 RocketTheme http://www.rockettheme.com
 * @license	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

class RokInstallerEvents extends JPlugin
{

	const STATUS_ERROR	 = 'error';
	const STATUS_INSTALLED = 'installed';
	const STATUS_UPDATED   = 'updated';

	public static $install_type;

	protected static $messages = array();

	/**
	 * @var JInstaller
	 */
	protected $toplevel_installer;

	public function setTopInstaller(&$installer)
	{
		$this->toplevel_installer = $installer;
	}

	public function __construct(&$subject, $config = array())
	{

		parent::__construct($subject, $config);

		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');

		$install_html_file = dirname(__FILE__) . '/../install.html';
		$install_css_file  = dirname(__FILE__) . '/../install.css';
		$tmp_path		  = JPATH_ROOT . '/tmp';
		if (JFolder::exists($tmp_path)) {
			// Copy install.css to tmp dir for inclusion
			JFile::copy($install_css_file, $tmp_path . '/install.css');
			JFile::copy($install_html_file, $tmp_path . '/install.html');
		}

	}

	public static function addMessage($package, $status, $message = '')
	{
		self::$messages[] = call_user_func_array(array('RokInstallerEvents', $status), array($package, $message));
	}



	/**
	 * @return string
	 */
	protected static function loadCss()
	{
		jimport('joomla.filesystem.file');
		jimport('joomla.filesystem.folder');
		$buffer			= '';
		// Drop out Style
		if (file_exists( JPATH_ROOT . '/tmp/install.html')) {
			$buffer .= JFile::read(JPATH_ROOT . '/tmp/install.html');
		}
		return $buffer;
	}


	/**
	 * @param $package
	 * @param $msg
	 *
	 * @return string
	 */
	public static function error($package, $msg)
	{
		ob_start();
		?>
	<li class="rokinstall-failure">
		<span class="rokinstall-icon"><span></span></span>
		<span class="rokinstall-row"><?php echo $package['name'];?> installation failed</span>
		<span class="rokinstall-errormsg">
			<?php echo $msg; ?>
		</span>
	</li>
	<?php
		$out = ob_get_clean();
		return $out;
	}

	/**
	 * @param $package
	 *
	 * @return string
	 */
	public static function installed($package)
	{
		ob_start();
		?>
	<li class="rokinstall-success">
		<span class="rokinstall-icon"><span></span></span>
		<span class="rokinstall-row"><?php echo $package['name'];?> installation was successful</span></li>
	<?php
		$out = ob_get_clean();
		return $out;
	}

	/**
	 * @param $package
	 *
	 * @return string
	 */
	public static function updated($package)
	{
		ob_start();
		?>
	<li class="rokinstall-update">
		<span class="rokinstall-icon"><span></span></span>
		<span class="rokinstall-row"><?php echo $package['name'];?> update was successful</span>
	</li>
	<?php
		$out = ob_get_clean();
		return $out;
	}


	public function onInstallerAfterInstaller($model, &$package, $installer, &$result, &$msg)
	{
		$lang = JFactory::getLanguage();
		$lang->load((self::$install_type == 'update' ? 'update' : 'install') . '_override', dirname(__FILE__), $lang->getTag(), true);
		$msg = JText::_('COM_INSTALLER_INSTALL_SUCCESS');

	}

	public function onExtensionAfterInstall($installer, $eid)
	{
		$lang = JFactory::getLanguage();
		$lang->load('install_override', dirname(__FILE__), $lang->getTag(), true);
		$this->toplevel_installer->set('extension_message', $this->getMessages());
	}

	public function onExtensionAfterUpdate($installer, $eid)
	{
		$lang = JFactory::getLanguage();
		$lang->load('install_override', dirname(__FILE__), $lang->getTag(), true);
		$this->toplevel_installer->set('extension_message', $this->getMessages());
	}

	protected function getMessages()
	{
		$buffer = '';
		$buffer .= self::loadCss();
		$buffer .= '<div id="rokinstall"><ul id="rokinstall-status">';
		$buffer .= implode('', self::$messages);
		$buffer .= '</ul>';
		$buffer .= '<i class="rokinstall-logo"></i>';
		$buffer .= '</div>';
		return $buffer;
	}


}
