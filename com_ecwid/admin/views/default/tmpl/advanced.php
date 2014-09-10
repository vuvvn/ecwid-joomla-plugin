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

?>

<?php if ($this->submenu): ?>
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->submenu; ?>
    </div>
<?php endif; ?>

<div id="j-main-container" class="wrap span8">

<h2><?php echo JText::_('COM_ECWID_ADVANCED_SETTINGS'); ?></h2>
<form class="pure-form pure-form-aligned ecwid-settings advanced-settings"
  id="adminForm"
  method="POST"
  action="<?php echo JRoute::_('index.php?option=com_ecwid&layout=advanced'); ?>"
>
<input type="hidden" name="task" value="default.saveAdvanced" />
<?php echo JHtml::_('form.token'); ?>

<fieldset>

    <div class="pure-control-group">
        <div class="label">
            <?php $this->renderLabel('defaultCategory'); ?>
        </div>
        <div class="input">
            <?php $this->renderElement('defaultCategory'); ?>
        </div>
        <div class="note">
            <?php echo JText::_('COM_ECWID_ADVANCED_DEFAULT_CATEGORY_NOTE');
            ?>
        </div>
    </div>


    <div class="pure-control-group">
        <div class="label">
            <?php $this->renderLabel('ssoKey'); ?>
        </div>
        <div class="input">
            <?php $this->renderElement('ssoKey'); ?>
        </div>
        <div class="note">
            <?php echo JText::_('COM_ECWID_ADVANCED_SSO_KEY_NOTE');
            ?>
        </div>
    </div>
</fieldset>

<input type="submit" style="visibility: hidden" />

</form>

</div>
