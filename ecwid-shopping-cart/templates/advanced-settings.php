<form class="pure-form pure-form-aligned ecwid-settings advanced-settings" method="POST" action="options.php">

	<h1 style="background:url('<?php echo ECWID_PLUGIN_URL; ?>images/ecwid-menu-icon.png') no-repeat 0% 115%; padding-left: 30px;line-height: 30px">Ecwid shopping cart settings</h1>
	<?php if ($ecwid_settings_message): ?>
		<div id="" class="updated fade">
			<p><strong><?php _e('Error'); ?>:</strong> <?php echo $ecwid_settings_message; ?></p>
		</div>
	<?php endif; ?>


	<?php settings_fields('ecwid_options_page'); ?>
	<fieldset>

		<legend><?php _e('Advanced settings', 'ecwid-shopping-cart'); ?></legend>
		<div class="pure-control-group">
			<label for="ecwid_default_category_id">
				<?php _e('Default category ID', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_default_category_id"
				name="ecwid_default_category_id"
				type="text"
				placeholder="<?php _e('Default category ID', 'ecwid-shopping-cart'); ?>"
				value="<?php echo esc_attr(get_option('ecwid_default_category_id')) ?>"
				/>

			<span>
				<img src="<?php echo ECWID_PLUGIN_URL; ?>images/ecwid_wp_attention.gif" alt="" />
				<a href="http://kb.ecwid.com/Default-category-for-product-browser" target="_blank"><?php _e('What is it?', 'ecwid-shopping-cart'); ?></a>
			</span>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_sso_secret_key">
				<?php _e('Single Sign-on Secret Key'); ?>
			</label>

			<input
				id="ecwid_sso_secret_key"
				type="text"
				name="ecwid_sso_secret_key"
				placeholder="<?php _e('Single Sign-on Secret Key'); ?>"
				value="<?php echo esc_attr(get_option('ecwid_sso_secret_key')); ?>"
				/>

			<div style="display:inline-block">
				<img src="<?php echo ECWID_PLUGIN_URL; ?>images/ecwid_wp_attention.gif" alt="" />
				<?php _e('This feature allows your customers to sign into your WordPress site and fully use your store without having to sign into Ecwid. I.e. if a customer is logged in to your site, he/she is logged in to your store automatically, even if he/she didn\'t have an account in your store before. In order to enable this feature you should set the secret key that can be found on the "System Settings > API > Single Sign-on API" page in your Ecwid control panel. Please note that this API is available only to <a href="http://www.ecwid.com/compare-plans.html">paid users</a>.', 'ecwid-shopping-cart'); ?>
			</div>
		</div>

	</fieldset>

	<fieldset>
		<div class="pure-control-group">
			<button type="submit" class="pure-button pure-button-primary"><?php _e('Save changes', 'ecwid-shopping-cart'); ?></button>
		</div>
	</fieldset>
</form>