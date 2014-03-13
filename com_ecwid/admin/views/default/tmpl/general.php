<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="wrap span10">

<form class="pure-form ecwid-settings general-settings"
		  id="adminForm"
		  method="POST"
		  action="<?php echo JRoute::_('index.php?option=com_ecwid'); ?>"
		>
		<input type="hidden" name="task" />
		<?php echo JHtml::_('form.token'); ?>
		<fieldset>

			<input type="hidden" name="settings_section" value="general" />

			<div class="greeting-box complete">
				<div class="image-container">
					<img class="greeting-image" src="<?php echo JUri::base(); ?>/components/com_ecwid/assets/images/store_ready.png" width="142" />
				</div>

				<div class="messages-container">

					<div class="main-message">
						<?php echo
							!is_null(JFactory::getApplication()->input->getWord('saved'))
							? JText::_('COM_ECWID_GENERAL_CONGRATULATIONS')
							: JText::_('COM_ECWID_GENERAL_GREETINGS');
						?>

					</div>
					<div class="secondary-message"?><?php echo JText::_('COM_ECWID_GENERAL_STORE_CONNECTED'); ?></div>
				</div>

			</div>
			<hr />
			<div class="section">
				<div class="left">
					<span class="main-info">
							<?php echo JText::_('COM_ECWID_GENERAL_STORE_ID'); ?>: <strong><? echo JComponentHelper::getParams('com_ecwid')->get('storeID'); ?></strong>
					</span>
				</div>
				<div class="right two-buttons">
					<a class="pure-button" target="_blank" href="https://my.ecwid.com/cp/?source=wporg#t1=&t2=Dashboard">
						<?php echo JText::_('COM_ECWID_GENERAL_CONTROL_PANEL'); ?>
					</a>
				</div>
			</div>

			<div class="section">
				<div class="left">
					<span class="main-info">
							<?php echo JText::_('COM_ECWID_GENERAL_ACCOUNT_STATUS'); ?>:
							<strong>
								<?php
								if ($this->isPaidAccount()) {
									echo JText::_('COM_ECWID_GENERAL_PAID');
								} else {
									echo JText::_('COM_ECWID_GENERAL_FREE');
								}
								?>
							</strong>
					</span>
					<div class="secondary-info">
						<?php
						if ($this->isPaidAccount())
							echo JText::_('COM_ECWID_GENERAL_THANKS_FOR_SUPPORTING_ECWID');
						else
							echo JText::_('COM_ECWID_GENERAL_UPGRADE_TO_GET_FEATURES');
						?>
					</div>
				</div>

				<div class="right">
					<?php if ($this->isPaidAccount()): ?>
						<a class="pure-button" target="_blank" href="https://my.ecwid.com/cp/CP.html#profile=Billing&t2=My_Profile">
							<?php echo JText::_('COM_ECWID_GENERAL_BILLING_AND_PLANS'); ?>
						</a>
					<?php else: ?>
						<a class="pure-button pure-button-primary" target="_blank" href="http://www.ecwid.com/plans-and-pricing.html">
							<?php echo JText::_('COM_ECWID_GENERAL_UPGRAGE'); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="note grayed-links">
				<?php
				echo JText::sprintf(
					'COM_ECWID_GENERAL_CHANGE_STORE_ID',
					'href="' . JRoute::_('index.php?option=com_ecwid&task=default.resetStoreID') . '"'
				);
				?>

			</div>

			<hr />
			<p><?php echo JText::_('COM_ECWID_VISIT_HELP_CENTER'); ?></p>
		</fieldset>
	</form>
</div>