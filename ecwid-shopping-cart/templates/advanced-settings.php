<form class="pure-form pure-form-aligned ecwid-settings advanced-settings" method="POST" action="options.php">

	<?php include "settings-header.php"; ?>

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
				<a href="http://kb.ecwid.com/Default-category-for-product-browser" target="_blank">
					<?php _e('What is it?', 'ecwid-shopping-cart'); ?>
				</a>
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
				<?php _e('SSO secret key description', 'ecwid-shopping-cart'); ?>
			</div>
		</div>

	</fieldset>

	<fieldset>
		<div class="pure-control-group">
			<button type="submit" class="pure-button pure-button-primary">
				<?php _e('Save changes', 'ecwid-shopping-cart'); ?>
			</button>
		</div>
	</fieldset>
</form>