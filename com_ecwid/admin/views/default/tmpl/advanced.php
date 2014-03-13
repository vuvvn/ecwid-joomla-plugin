<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="wrap span10">
<form class="pure-form pure-form-aligned ecwid-settings advanced-settings"
	  id="adminForm"
	  method="POST"
	  action="<?php echo JRoute::_('index.php?option=com_ecwid'); ?>"
	>
	<input type="hidden" name="task" />
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

</fieldset>
</form>

</div>
