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
			<?php $this->renderLabel('useSeoLinks'); ?>
        </div>
        <div class="input">
            <?php if (!JFactory::getConfig()->get('sef') || JFactory::getConfig()->get('sef_suffix')): ?>
                <?php echo JText::_('COM_ECWID_ADVANCED_SEO_LINKS_GLOBAL_SEF_NOTE'); ?>
            <?php else: ?>
			    <?php $this->renderElement('useSeoLinks'); ?>
				<?php $this->maybeEnableCheckboxIfDefault('useSeoLinks'); ?>
            <?php endif; ?>
        </div>
        <?php if (JFactory::getConfig()->get('sef')): ?>
        <div class="note">
			<?php echo JText::_('COM_ECWID_ADVANCED_SEO_LINKS_NOTE'); ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="pure-control-group">
        <div class="label">
            <?php $this->renderLabel('defaultCategory'); ?>
        </div>
        <div class="input">
            <?php $this->renderElement('defaultCategory'); ?>
        </div>
        <div class="note">
            <?php echo JText::_('COM_ECWID_ADVANCED_DEFAULT_CATEGORY_NOTE'); ?>
        </div>
    </div>

    <div class="pure-control-group">
        <div class="label">
			<?php $this->renderLabel('ssoEnabled'); ?>
        </div>
        <div class="input">
			<?php $this->renderElement('ssoEnabled'); ?>
			<?php $this->maybeSetCheckboxChecked('ssoEnabled', Ecwid::getSso()->isEnabled()); ?>
			<?php $this->maybeDisableCheckbox('ssoEnabled', Ecwid::getSso()->isEnabled() || Ecwid::getSso()->isAvailable()); ?>
        </div>
        
        <div class="note">
            <?php echo JText::_('COM_ECWID_ADVANCED_SSO_NOTE');
            ?>
        </div>
        
        <?php if (!Ecwid::isPaidAccount()): ?>
        <div class="note">
			<?php echo JText::sprintf('COM_ECWID_ADVANCED_SSO_UPSELL_NOTE', 'https://my.ecwid.com/cp/#billing:feature=sso&plan=ecwid_venture');
			?>
        </div>
        <?php endif; ?>
		
        <?php if (Ecwid::isPaidAccount() && !Ecwid::getParam('ssoKey') && !Ecwid::getSso()->isEnabled() && (!Ecwid::getApiV3()->getToken() || !Ecwid::getApiV3()->hasScope('create_customers'))): ?>
        <div class="note">
            <?php 
            echo JText::sprintf('COM_ECWID_ADVANCED_SSO_RECONNECT_NOTE', JRoute::_('index.php?option=com_ecwid&task=oauth.connect', false));
            ?>
        </div>
		<?php endif; ?>
    </div>

    <hr />
    <p class="help"><?php echo JText::_('COM_ECWID_FIND_MORE_TOOLS_APPMARKET'); ?></p>

</fieldset>

<input type="submit" style="visibility: hidden" />

</form>

</div>
