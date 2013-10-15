<div class="pure-form ecwid-settings general-settings">

	<form method="POST" action="options.php">

		<?php include "settings-header.php"; ?>
		<input type="hidden" name="settings_section" value="general" />

		<?php settings_fields('ecwid_options_page'); ?>
		<fieldset>

			<legend><?php _e('General', 'ecwid-shopping-cart'); ?></legend>
			<div class="pure-control-group store-id">
				<label for="store_id">
					<?php _e('Store ID', 'ecwid-shopping-cart'); ?>
				</label>
				<input
					id="ecwid_store_id"
					name="ecwid_store_id"
					type="text"
					placeholder="<?php _e('Store ID', 'ecwid-shopping-cart'); ?>"
					value="<?php if (get_ecwid_store_id() != 1003) echo esc_attr(get_ecwid_store_id()); ?>"
				/>
				<button type="submit" class="pure-button pure-button-primary"><?php _e('Save changes', 'ecwid-shopping-cart'); ?></button>
			</div>

			<?php if (get_ecwid_store_id() == 1003): ?>
				<div class="warning">
					<?php _e("The Store ID isn't set up. Please enter your Store ID to assign your site with your Ecwid store and show your products. <a target=\"_blank\" href=\"http://kb.ecwid.com/w/page/21530844/Instruction%20on%20how%20to%20get%20your%20free%20Store%20ID%20%28for%20WordPress%29\">How to get this free ID</a>", 'ecwid-shopping-cart'); ?>
				</div>
			<?php endif; ?>

		</fieldset>

		<div class="pure-control-group">
		</div>
	</form>

	<div class="ecwid-instructions">

		<h3><?php _e('Instructions on how to get your free Store ID:', 'ecwid-shopping-cart'); ?></h3>
		<hr />
		<ol>
			<li>
				<h4><?php _e('Go to Ecwid control panel.', 'ecwid-shopping-cart'); ?></h4>
				<p>
					<?php _e('Open this URL: <a target="_blank" href="https://my.ecwid.com/cp/?source=wporg#register">https://my.ecwid.com/cp?source=wporg#register</a>. You will get to "Sign In or Register" form.', 'ecwid-shopping-cart'); ?>
				</p>
			</li>
			<li>
				<h4><?php _e('Register an account at Ecwid.', 'ecwid-shopping-cart'); ?></h4>
				<p><?php _e('Use section "Using Ecwid account" for that. The registration is free.', 'ecwid-shopping-cart'); ?></p>
				<p class="note"><?php _e('Note: the login may take several seconds. Please, be patient.', 'ecwid-shopping-cart'); ?></p>
				<p class="note2"><?php _e('Or you can log in using your account at Gmail, Facebook, Twitter, Yahoo, or another provider. Choose one from the list of the providers (click on "More providers" if you don\'t see your provider there). Click on the provider logo, you will be redirected to the account login page. Submit your username/password there to login to your Ecwid.', 'ecwid-shopping-cart'); ?></p>
			</li>
			<li class="find-id-in-ecwid-cp">
				<h4><?php _e('Look at the right bottom corner of the page.', 'ecwid-shopping-cart'); ?></h4>
				<p><?php _e('You will see the <b>"Store ID: NNNNNN"</b> text, where <b>NNNNNN</b> is your <b>Store ID</b>.<br> For example if the text is <b>Store ID: 1003</b>, your Store ID is <b>1003</b>.', 'ecwid-shopping-cart'); ?></p>
				<p class="note"><?php _e('You will also get your Store ID by email.', 'ecwid-shopping-cart'); ?></p>
			</li>
		</ol>
		<hr />
		<p><?php _e('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>.', 'ecwid-shopping-cart'); ?></p>
	</div>
</div>