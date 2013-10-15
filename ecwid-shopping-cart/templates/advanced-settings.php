<form class="pure-form pure-form-aligned ecwid-settings advanced-settings" method="POST" action="options.php">

	<?php include "settings-header.php"; ?>

	<?php settings_fields('ecwid_options_page'); ?>
	<input type="hidden" name="settings_section" value="advanced" />

	<fieldset>

		<legend><?php _e('Advanced', 'ecwid-shopping-cart'); ?></legend>
		<div class="pure-control-group">

			<?php if (ecwid_is_api_enabled()): ?>
			<label for="ecwid_default_category_id">
				<?php _e('Default category', 'ecwid-shopping-cart'); ?>
			</label>

			<select name="ecwid_default_category_id" id="ecwid_default_category_id">
				<option value=""><?php _e('Store root category', 'ecwid-shopping-cart'); ?></option>
				<?php foreach ($categories as $category): ?>
				<option
					value="<?php echo esc_attr($category['id']); ?>"
					<?php if ($category['id'] == get_option('ecwid_default_category_id')): ?>
					selected="selected"
					<?php endif; ?>
				>
					<?php echo esc_html($category['path_str']); ?>
				</option>
				<?php endforeach; ?>
			</select>
			<?php else: ?>

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
			<?php endif; ?>
			<span>
				<a href="http://kb.ecwid.com/Default-category-for-product-browser" target="_blank">
					<?php _e('What is it?', 'ecwid-shopping-cart'); ?>
				</a>
			</span>
		</div>

		<hr />

		<div class="pure-control-group last">
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

			<div style="display:inline-block" class="note">
				<?php _e('This feature allows your customers to sign into your WordPress site and fully use your store without having to sign into Ecwid. I.e. if a customer is logged in to your site, he/she is logged in to your store automatically, even if he/she didn\'t have an account in your store before. In order to enable this feature you should set the secret key that can be found on the <b>"System Settings > API > Single Sign-on API"</b> page in your Ecwid control panel. Please note that this API is available only to <a href="http://www.ecwid.com/compare-plans.html" target="_blank">paid users</a>.', 'ecwid-shopping-cart'); ?>
			</div>
		</div>

	</fieldset>

	<fieldset>
		<hr />

		<div class="pure-control-group">
			<button type="submit" class="pure-button pure-button-primary">
				<?php _e('Save changes', 'ecwid-shopping-cart'); ?>
			</button>
		</div>
	</fieldset>
</form>