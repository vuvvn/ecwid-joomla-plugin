<div class="pure-form ecwid-settings general-settings">
	<?php include "settings-header.php"; ?>

	<form method="POST" action="options.php">
		<fieldset>

			<legend><?php _e('General', 'ecwid-shopping-cart'); ?></legend>
			<input type="hidden" name="settings_section" value="general" />

			<div class="greeting-box">
				<div class="main-message">
					<?php _e('You are almost finished connecting your store to Wordpress.', 'ecwid-shopping-cart'); ?>
				</div>
				<div class="secondary-message">
					<?php _e('Just 3 little steps left.', 'ecwid-shopping-cart'); ?>
				</div>
			</div>
			<hr />

			<?php settings_fields('ecwid_options_page'); ?>
			<ol>
				<li>
					<h4><?php _e('Register at Ecwid', 'ecwid-shopping-cart'); ?></h4>
					<div>
						<?php _e('The registration is free. The login might take several seconds. Please, be patient.', 'ecwid-shopping-cart'); ?>
					</div>
					<div class="ecwid-account-buttons">
						<a class="pure-button" target="_blank" href="//my.ecwid.com/cp#register">
							<?php _e('Create new Ecwid account'); ?>
						</a>
						<a class="pure-button">
							<?php _e("I already have Ecwid account, sign in"); ?>
						</a>
					</div>
					<div class="note">
						<?php _e('Or you can log in using your account at Gmail, Facebook, or PayPal. Choose one from the list of the providers. Click on the provider logo, you will be redirected to the account login page. Submit your username/password there to login to your Ecwid. And proceed to second step.', 'ecwid-shopping-cart'); ?>
					</div>
				</li>
				<li>
					<h4><?php _e('Find your store id', 'ecwid-shopping-cart'); ?></h4>
					<div class="find-store-id-in-cp">
						<?php _e('You are already have Ecwid account, look at the right bottom corner of the Ecwid control panel page. You will see the "<em>Store ID: NNNNNN</em>" text, where <em>NNNNNN</em> is your Store ID. For example if the text is <em>Store ID: 18240</em>, Your Store ID is <em>18240</em>.', 'ecwid-shopping-cart'); ?>
					</div>
					<div><?php _e('You will also get your Store ID by email.', 'ecwid-shopping-cart'); ?></div>
				</li>
				<li>
					<h4>
						<?php _e('Enter your store ID', 'ecwid-shopping-cart'); ?>
					</h4>
					<div><label for="ecwid_store_id"><?php _e('Enter your store ID here:', 'ecwid-shopping-cart'); ?></label></div>
					<div class="pure-control-group store-id">
						<input
							id="ecwid_store_id"
							name="ecwid_store_id"
							type="text"
							placeholder="<?php _e('Store ID', 'ecwid-shopping-cart'); ?>"
							value="<?php if (get_ecwid_store_id() != 1003) echo esc_attr(get_ecwid_store_id()); ?>"
							/>
						<button type="submit" class="pure-button pure-button-primary"><?php _e('Save changes', 'ecwid-shopping-cart'); ?></button>
					</div>

				</li>
			</ol>
			<hr />
			<p><?php _e('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>.', 'ecwid-shopping-cart'); ?></p>
		</fieldset>
	</form>
</div>