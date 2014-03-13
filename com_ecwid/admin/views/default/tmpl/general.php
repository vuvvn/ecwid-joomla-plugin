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

					<div class="main-message"><?php echo JText::_('Greetings!'); ?></div>
					<div class="secondary-message"?><?php echo JText::_('Your Ecwid store is connected to your WordPress website.'); ?></div>
				</div>

			</div>
			<hr />
			<div class="section">
				<div class="left">
					<span class="main-info">
							<?php echo JText::_('Store ID'); ?>: <strong><? echo JComponentHelper::getParams('com_ecwid')->get('storeID'); ?></strong>
					</span>
				</div>
				<div class="right two-buttons">
					<a class="pure-button" target="_blank" href="https://my.ecwid.com/cp/?source=wporg#t1=&t2=Dashboard">
						<?php echo JText::_('Control panel'); ?>
					</a>
				</div>
			</div>

			<div class="section">
				<div class="left">
					<span class="main-info">
							<?php echo JText::_('Account status'); ?>:
							<strong>
								<?php
								if ($this->isPaidAccount()) {
									echo JText::_('Paid');
								} else {
									echo JText::_('Free');
								}
								?>
							</strong>
					</span>
					<div class="secondary-info">
						<?php
						if ($this->isPaidAccount())
							echo JText::_('Thank you for supporting Ecwid!');
						else
							echo JText::_('Upgrade to get access to cool premium features.');
						?>
					</div>
				</div>

				<div class="right">
					<?php if ($this->isPaidAccount()): ?>
						<a class="pure-button" target="_blank" href="https://my.ecwid.com/cp/CP.html#profile=Billing&t2=My_Profile">
							<?php echo JText::_('Billing and plans'); ?>
						</a>
					<?php else: ?>
						<a class="<?php echo ECWID_MAIN_BUTTON_CLASS; ?>" target="_blank" href="http://www.ecwid.com/plans-and-pricing.html">
							<?php echo JText::_('Upgrade'); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="note grayed-links">
				<?php
				echo JText::sprintf(
					'If you want to connect another Ecwid store, you can <a %s>disconnect the current one and change Store ID</a>.',
					'href="' . JRoute::_('index.php?option=com_ecwid&task=default.resetStoreID') . '"'
				);
				?>

			</div>

			<hr />
			<p><?php echo JText::_('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>.'); ?></p>
		</fieldset>
	</form>
</div>