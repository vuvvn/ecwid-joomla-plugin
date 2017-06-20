<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Script file of Ecwid component.
 */
class com_ecwidInstallerScript
{
	public function update($parent)
	{
		JLoader::register(
			'EcwidCommon',
			JPATH_SITE . DIRECTORY_SEPARATOR .
			'components' . DIRECTORY_SEPARATOR .
			'com_ecwid' . DIRECTORY_SEPARATOR .
			'helpers' . DIRECTORY_SEPARATOR .
			'common.php'
		);

		EcwidCommon::setParam('enableChameleon', 0);
		EcwidCommon::setParam('apiV3Token', '');
	}
}