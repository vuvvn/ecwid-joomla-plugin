<div id="j-sidebar-container" class="span2">
	<?php echo $this->sidebar; ?>
</div>
<div id="j-main-container" class="wrap span10">

<form class="pure-form ecwid-settings general-settings"
		  id="adminForm"
		  method="POST"
		  action="<?php echo JRoute::_('index.php?option=com_ecwid'); ?>"
		>
		<input type="hidden" name="task" value="default.saveDefault" />
		<?php echo JHtml::_('form.token'); ?>
		<fieldset>

			<div class="greeting-box">

				<div class="image-container">
					<img class="greeting-image" src="<?php echo $this->baseurl; ?>/components/com_ecwid/assets/images/store_inprogress.png" width="142" />
				</div>

				<div class="messages-container">
					<div class="main-message">

						<?php echo JText::_('Thank you for choosing Ecwid to build your online store.'); ?>
					</div>
					<div class="secondary-message">
						<?php echo JText::_('The first step towards opening your online business: <br />Let’s get started and add a store to your WordPress website in <strong>3</strong> simple steps.'); ?>
					</div>
				</div>

			</div>
			<hr />

			<ol>
				<li>
					<h4><?php echo JText::_('Register at Ecwid'); ?></h4>
					<div>
						<?php echo JText::_('Create a new Ecwid account which you will use to manage your store and inventory. The registration is free.'); ?>
					</div>
					<div class="ecwid-account-buttons">
						<a class="pure-button pure-button-secondary" target="_blank" href="https://my.ecwid.com/cp/?source=wporg#register">
							<?php echo JText::_('Create new Ecwid account'); ?>
						</a>
						<a class="pure-button pure-button-secondary" target="_blank" href="https://my.ecwid.com/cp/?source=wporg#t1=&t2=Dashboard">
							<?php echo JText::_('I already have Ecwid account, sign in'); ?>
						</a>
					</div>
					<div class="note">
						<?php echo JText::_('You will be able to sign up through your existing Google, Facebook or PayPal profiles as well.'); ?>
					</div>
				</li>
				<li>
					<h4><?php echo JText::_('Find your Store ID'); ?></h4>
					<div>
						<?php echo JText::_('Store ID is a unique identifier of any Ecwid store, it consists of several digits. You can find it on the "Dashboard" page of Ecwid control panel. Also the Store ID will be sent in the Welcome email after the registration.'); ?>
					</div>
				</li>
				<li>
					<h4>
						<?php echo JText::_('Enter your Store ID'); ?>
					</h4>
					<div><label for="ecwid_store_id"><?php echo JText::_('Enter your Store ID here:'); ?></label></div>
					<div class="pure-control-group store-id">
						<?php $this->renderElement('storeID'); ?>
						<button type="submit" class="<?php echo ECWID_MAIN_BUTTON_CLASS; ?>"><?php echo JText::_('Save and connect your Ecwid store to the site'); ?></button>
					</div>

				</li>
			</ol>
			<hr />
			<p><?php echo JText::_('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>.'); ?></p>
		</fieldset>
	</form>
</div>
