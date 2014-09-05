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

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

if (!class_exists('PlgSystemecwid_installerInstallerScript')) {

	/**
	 *
	 */
	class PlgSystemecwid_installerInstallerScript
	{
		/**
		 * @var array
		 */
		protected $packages = array();
		/**
		 * @var
		 */
		protected $sourcedir;
		/**
		 * @var
		 */
		protected $installerdir;
		/**
		 * @var
		 */
		protected $manifest;

		/**
		 * RokInstaller
		 */
		protected $parent;

        protected $needMigration;

		/**
		 * @param $parent
		 */
		protected function setup($parent)
		{
			$this->parent       = $parent;
			$this->sourcedir    = $parent->getParent()->getPath('source');
			$this->manifest     = $parent->getParent()->getManifest();
			$this->installerdir = $this->sourcedir . '/' . 'installer';
		}

		/**
		 * @param $parent
		 *
		 * @return bool
		 */
		public function install($parent)
		{

			$this->cleanBogusError();

			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');

			$retval = true;
			$buffer = '';


			$buffer .= ob_get_clean();

			$run_installer = true;

			// Cycle through cogs and install each

			if ($run_installer) {
                $this->needMigration = $this->componentExists('com_rokecwid') && !$this->componentExists('com_ecwid');

				if (count($this->manifest->cogs->children())) {
					if (!class_exists('RokInstaller')) {
						require_once($this->installerdir . '/' . 'RokInstaller.php');
					}

					foreach ($this->manifest->cogs->children() as $cog) {

						if (trim($cog) == 'com_rokecwid' && !$this->componentExists('com_rokecwid')) {
							continue;
						}

						$folder_found = false;
						$folder = $this->sourcedir . '/' . trim($cog);

						jimport('joomla.installer.helper');
						if (is_dir($folder)) {
							// if its actually a directory then fill it up
							$package                = Array();
							$package['dir']         = $folder;
							$package['type']        = JInstallerHelper::detectType($folder);
							$package['installer']   = new RokInstaller();
							$package['name']        = (string)$cog->name;
							$package['state']       = 'Success';
							$package['description'] = (string)$cog->description;
							$package['msg']         = '';
							$package['type']        = ucfirst((string)$cog['type']);

							$package['installer']->setCogInfo($cog);
							// add installer to static for possible rollback
							$this->packages[] = $package;
							if (!@$package['installer']->install($package['dir'])) {
								while ($error = JError::getError(true)) {
									$package['msg'] .= $error;
								}
								RokInstallerEvents::addMessage($package, RokInstallerEvents::STATUS_ERROR, $package['msg']);
								break;
							}
							if ($package['installer']->getInstallType() == 'install') {
								RokInstallerEvents::addMessage($package, RokInstallerEvents::STATUS_INSTALLED);
							} else {
								RokInstallerEvents::addMessage($package, RokInstallerEvents::STATUS_UPDATED);
							}
						} else {
							$package                = Array();
							$package['dir']         = $folder;
							$package['name']        = (string)$cog->name;
							$package['state']       = 'Failed';
							$package['description'] = (string)$cog->description;
							$package['msg']         = '';
							$package['type']        = ucfirst((string)$cog['type']);
							RokInstallerEvents::addMessage($package, RokInstallerEvents::STATUS_ERROR, JText::_('JLIB_INSTALLER_ABORT_NOINSTALLPATH'));
							break;
						}
					}
				} else {
					$parent->getParent()->abort(JText::sprintf('JLIB_INSTALLER_ABORT_PACK_INSTALL_NO_FILES', JText::_('JLIB_INSTALLER_' . strtoupper($this->route))));
				}
			}

            // Create package in the database if none existed before
            $this->createPackageInDb();
    	}

		/**
		 * @param $parent
		 */
		public function uninstall($parent)
		{

		}

		/**
		 * @param $parent
		 *
		 * @return bool
		 */
		public function update($parent)
		{
			return $this->install($parent);
		}

		/**
		 * @param $type
		 * @param $parent
		 *
		 * @return bool
		 */
		public function preflight($type, $parent)
		{
			$this->setup($parent);

			//Load Event Handler
			if (!class_exists('RokInstallerEvents')) {
				$event_handler_file = $this->installerdir . '/RokInstallerEvents.php';
				require_once($event_handler_file);
				$dispatcher = JDispatcher::getInstance();
				$plugin = new RokInstallerEvents($dispatcher);
                $parent = $this->parent->getParent();
				$plugin->setTopInstaller($parent);
			}

			if (is_file(dirname(__FILE__) . '/requirements.php')) {
				// check to see if requierments are met
				if (($loaderrors = require_once(dirname(__FILE__) . '/requirements.php')) !== true) {
					$manifest = $parent->get('manifest');
					$package['name'] = (string)$manifest->description;
					RokInstallerEvents::addMessage($package, RokInstallerEvents::STATUS_ERROR, implode('<br />', $loaderrors));
					return false;
				}
			}
		}

		/**
		 * @param $type
		 * @param $parent
		 */
		public function postflight($type, $parent)
		{
            $conf = JFactory::getConfig();
            $conf->set('debug', false);
            $parent->getParent()->abort();

            if ($this->needMigration && $this->componentExists('com_rokecwid')) {

				$this->migrateComponentSettings();
                $this->migrateComponentMenu();
				$this->migrateModules();
                $this->uninstallOldExtensions();
                $this->hideLegacyComponentMenuItem();
			}
		}

        protected function createPackageInDb()
        {

            $manifest_path = $this->sourcedir . '/pkg_ecwid/pkg_ecwid.xml';
            $element = 'pkg_ecwid';
            $installer = new JInstaller();
            $installer->setPath('manifest', $manifest_path);

            $manifest = $installer->isManifest($manifest_path);

            $row = JTable::getInstance('extension');
            $eid = $row->find(array('element' => $element, 'type' => 'package'));

            if ($eid)
            {
                $row->load($eid);
            }
            else
            {
                $row->name = $manifest->name;
                $row->type = 'package';
                $row->element = $element;
                $row->folder = '';
                $row->enabled = 1;
                $row->protected = 0;
                $row->access = 1;
                $row->client_id = 0;
                $row->custom_data = '';
                $row->params = $installer->getParams();
            }

            // Update the manifest cache for the entry
            $row->manifest_cache = $installer->generateManifestCache();

            if (!$row->store())
            {
                // Install failed, roll back changes
                $this->parent->abort(JText::sprintf('JLIB_INSTALLER_ABORT_PACK_INSTALL_ROLLBACK', $row->getError()));
            }

            // Lastly, we will copy the manifest file to its appropriate place.
            $copy = array();
            $copy['src'] = $manifest_path;
            $copy['dest'] = JPATH_MANIFESTS . '/packages/pkg_ecwid.xml';

            if (!$installer->copyFiles(array($copy), true))
            {
                // Install failed, rollback changes
                $this->parent->abort(
                    JText::sprintf('JLIB_INSTALLER_ABORT_PACK_INSTALL_COPY_SETUP', JText::_('JLIB_INSTALLER_ABORT_PACK_INSTALL_NO_FILES'))
                );

                return false;
            }


            $children = $manifest->updateservers->children();
            foreach ($children as $child)
            {
                $attrs = $child->attributes();
                $this->addUpdateSite($row->get($row->getKeyName()), $attrs['name'], $attrs['type'], trim($child), true);
            }
        }

        protected function addUpdateSite($eid, $name, $type, $location, $enabled)
        {
            $db = JFactory::getDbo();

            // Look if the location is used already; doesn't matter what type you can't have two types at the same address, doesn't make sense
            $query = $db->getQuery(true)
                ->select('update_site_id')
                ->from('#__update_sites')
                ->where('location = ' . $db->quote($location));
            $db->setQuery($query);
            $update_site_id = (int) $db->loadResult();

            // If it doesn't exist, add it!
            if (!$update_site_id)
            {
                $query->clear()
                    ->insert('#__update_sites')
                    ->columns(array($db->quoteName('name'), $db->quoteName('type'), $db->quoteName('location'), $db->quoteName('enabled')))
                    ->values($db->quote($name) . ', ' . $db->quote($type) . ', ' . $db->quote($location) . ', ' . (int) $enabled);
                $db->setQuery($query);
                if ($db->execute())
                {
                    // Link up this extension to the update site
                    $update_site_id = $db->insertid();
                }
            }

            // Check if it has an update site id (creation might have faileD)
            if ($update_site_id)
            {
                // Look for an update site entry that exists
                $query->clear()
                    ->select('update_site_id')
                    ->from('#__update_sites_extensions')
                    ->where('update_site_id = ' . $update_site_id)
                    ->where('extension_id = ' . $eid);
                $db->setQuery($query);
                $tmpid = (int) $db->loadResult();
                if (!$tmpid)
                {
                    // Link this extension to the relevant update site
                    $query->clear()
                        ->insert('#__update_sites_extensions')
                        ->columns(array($db->quoteName('update_site_id'), $db->quoteName('extension_id')))
                        ->values($update_site_id . ', ' . $eid);
                    $db->setQuery($query);
                    $db->execute();
                }
            }
        }

        protected function hideLegacyComponentMenuItem()
        {
            $db 		= JFactory::getDbo();
            $query 		= $db->getQuery(true);
            $table 		= JTable::getInstance('menu');

            // Get component id
            $component = JComponentHelper::getComponent('com_rokecwid');
            if (!isset($component->id)) return;

            $id	       = $component->id;
            // Get the ids of the menu items
            $query->select('id')
                ->from('#__menu')
                ->where($db->qn('client_id') . ' = ' . $db->q(1))
                ->where($db->qn('component_id') . ' = ' . $id)
            ;

            $db->setQuery($query);

            $ids = $db->loadColumn();

            if (!empty($ids))
            {
                foreach ($ids as $menuid)
                {
                    if (!$table->delete($menuid));
                }

                // Rebuild the whole tree
                $table->rebuild();
            }
        }

        protected function uninstallOldExtensions()
        {
            $installer = JInstaller::getInstance();
            $db = JFactory::getDbo();

            $extensions = array(
                'mod_rokecwid_categories' => 'module',
                'mod_rokecwid_search' => 'module',
                'mod_rokecwid_minicart' => 'module',
                'rokecwid' => 'plugin');

            foreach ($extensions as $extension => $type) {
                $query = "SELECT * FROM #__extensions WHERE element='$extension' and type='$type'";
                $db->setQuery($query);
                $obj = $db->loadObject();
                if (is_object($obj) && isset($obj->type) && isset($obj->extension_id)) {
                    $installer->uninstall($obj->type, $obj->extension_id);
                }
            }
        }

        protected function componentExists($name)
        {
            $db = JFactory::getDbo();

            $db->setQuery("SELECT element FROM #__extensions WHERE element='$name'");
            $result = $db->loadResult();

            return !is_null($result);
        }

		protected function migrateComponentSettings()
		{
			$rokEcwidParams = JComponentHelper::getParams('com_rokecwid');
			$ecwidParams = JComponentHelper::getParams('com_ecwid');

			$copyParams = array(
				'storeID',
				'categoriesPerRow',
				'categoryView',
				'searchView',
				'list',
				'table',
				'defaultCategory'
			);

			foreach ($copyParams as $param) {
				$ecwidParams->set($param, $rokEcwidParams->get($param));
			}

			$ecwidParams->set('displaySearch', false);
			$ecwidParams->set('displayCategories', false);

            $grid = $rokEcwidParams->get('grid');
            if (is_null($grid))
                $grid = '3,3';
			list ($rows, $cols) = explode(',', $grid);
			$ecwidParams->set('gridRows', intval($rows));
			$ecwidParams->set('gridColumns', intval($cols));

			$table  = JTable::getInstance('extension');
			$result = $table->find(array('element' => 'com_ecwid'));
			$table->load($result);

			$table->params = $ecwidParams->__toString();

			$table->store();
		}

        protected function migrateComponentMenu()
        {
            $db = JFactory::getDbo();

            $rokEcwid = JComponentHelper::getComponent('com_rokecwid', true);
            $ecwid = JComponentHelper::getComponent('com_ecwid', true);

            if (empty($rokEcwid) || empty($ecwid)) return;

            $query = "SELECT #__menu.* FROM #__menu JOIN #__menu_types ON (#__menu.menutype=#__menu_types.menutype) WHERE type='component' AND component_id='$rokEcwid->id'";
            $db->setQuery($query);
            $pages = $db->loadObjectList();

            if (!is_array($pages) || empty($pages))
                return;

            foreach ($pages as $page) {
                if (!is_object($page) || !isset($page->link) || !isset($page->component_id))
                    return;
                $page->link = str_replace('com_rokecwid', 'com_ecwid', $page->link);
                $page->component_id = $ecwid->id;

                $db->updateObject('#__menu', $page, 'id');
            }

        }

		protected function migrateModules()
		{
			foreach (
				array(
                    'search' => 'RokEcwid Search Module',
					'categories' => 'RokEcwid Categories Module',
                    'minicart' => 'RokEcwid Mini-cart Module',

				) as $name => $old_title
			) {
				$old_name = 'mod_rokecwid_' . $name;
				$new_name = 'mod_ecwid_' . $name;

				$db = JFactory::getDbo();

				$query = "SELECT * FROM #__extensions WHERE element='$new_name'";
				$db->setQuery($query);
				$new_module = $db->loadObject();

				$query = "SELECT * FROM #__modules WHERE module='$old_name'";
				$db->setQuery($query);
				$old_modules = $db->loadObjectList();

                if ($old_modules) {
                    foreach ($old_modules as $module) {
                        if (!is_object($module) || !isset($module->title) || !isset($module->module)) continue;
                        $module->title = str_replace($old_title, $new_module->name, $module->title);
                        $module->module = $new_module->element;

                        $db->updateObject('#__modules', $module, 'id');

                        if (isset($module->asset_id)) {
                            $query = "SELECT * FROM #__assets WHERE id='$module->asset_id'";
                            $db->setQuery($query);
                            $asset = $db->loadObject();
                            if (is_object($asset) && isset($asset->title) && isset($asset->id)) {
                                $asset->title = $new_module->name;

                                $db->updateObject('#__assets', $asset, 'id');
                            }
                        }
                    }
                }
			}
		}

		protected function migrateModule($old_module_data, $new_module_data) {

			$new = JTable::getInstance('module');
			if (!$new->load(array('id' => $new_module_data->id))) return;

			$toCopy = array(
				'params',
				'published',
				'publish_up',
				'publish_down',
				'showtitle',
				'access',
				'ordering',
				'language',
				'note',
				'position'
			);
			foreach ($toCopy as $param) {
				$new->set($param, $old_module_data->$param);
			}
			$new->store();
		}

		protected function migrateModuleMenu($old_module_data, $new_module_data) {

			$db = JFactory::getDbo();

			$query = "SELECT menu FROM #__modules_menu WHERE module_id='" . $old_module_data->id . "'";
			$db->setQuery($query);
			$result = $db->loadResultArray();

            if (!$result) return;

			foreach ($result as $menu_id) {
				$new = new stdObject;
				$new->module_id = $new_module_data->id;
				$new->menu_id = $menu_id;

				$db->insertObject('#__modules_menu', $new);
			}
		}

		protected function migrateModuleAssets($old_module_data, $new_module_data) {

			$db = JFactory::getDbo();
			$query = "SELECT * FROM #__assets WHERE id='" . $old_module_data->asset_id . "'";
			$db->setQuery($query);
			$old_data = $db->loadObject();

			$query = "SELECT * FROM #__assets WHERE id='" . $old_module_data->asset_id . "'";
			$db->setQuery($query);
			$new_data = $db->loadObject();

            if (!$old_data || !$new_data) return;

			$new_data->rules = $old_data->rules;
			$db->updateObject('#__assets', $new_data, 'id');

		}

		/**
		 * @param null $msg
		 * @param null $type
		 */
		public function abort($msg = null, $type = null)
		{
			if ($msg) {
				JError::raiseWarning(100, $msg);
			}
			foreach ($this->packages as $package) {
				$package['installer']->abort(null, $type);
			}
		}

		/**
		 *
		 */
		protected function cleanBogusError()
		{
			$errors = array();
			while (($error = JError::getError(true)) !== false) {
				if (!($error->get('code') == 1 && $error->get('level') == 2 && $error->get('message') == JText::_('JLIB_INSTALLER_ERROR_NOTFINDXMLSETUPFILE'))) {
					$errors[] = $error;
				}
			}
			foreach ($errors as $error) {
				JError::addToStack($error);
			}

			$app               = new RokInstallerJAdministratorWrapper(JFactory::getApplication());
			$enqueued_messages = $app->getMessageQueue();
			$other_messages    = array();
			if (!empty($enqueued_messages) && is_array($enqueued_messages)) {
				foreach ($enqueued_messages as $enqueued_message) {
					if (!($enqueued_message['message'] == JText::_('JLIB_INSTALLER_ERROR_NOTFINDXMLSETUPFILE') && $enqueued_message['type']) == 'error') {
						$other_messages[] = $enqueued_message;
					}
				}
			}
			$app->setMessageQueue($other_messages);
		}
	}

	if (!class_exists('RokInstallerJAdministratorWrapper')) {
		$jversion = new JVersion();
		if ($jversion->isCompatible('3.2')) {
			class RokInstallerJAdministratorWrapper extends JApplicationCms
			{
				protected $app;

				public function __construct(JApplicationCms $app)
				{
					$this->app =& $app;
				}

				public function getMessageQueue()
				{
					return $this->app->getMessageQueue();
				}

				public function setMessageQueue($messages)
				{
					$this->app->_messageQueue = $messages;
				}
			}
		} else {
			class RokInstallerJAdministratorWrapper extends JAdministrator
			{
				protected $app;

				public function __construct(JAdministrator $app)
				{
					$this->app =& $app;
				}

				public function getMessageQueue()
				{
					return $this->app->getMessageQueue();
				}

				public function setMessageQueue($messages)
				{
					$this->app->_messageQueue = $messages;
				}
			}
		}
	}
}
