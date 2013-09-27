<form class="pure-form pure-form-aligned ecwid-settings general-settings" method="POST" action="options.php">

	<?php include "settings-header.php"; ?>

	<?php settings_fields('ecwid_options_page'); ?>
	<fieldset>

		<legend><?php _e('General', 'ecwid-shopping-cart'); ?></legend>
		<div class="pure-control-group">
			<label for="store_id">
				<a href="http://kb.ecwid.com/Instruction-on-how-to-get-your-free-Store-ID-(for-WordPress)" target="_blank">
					<?php _e('Store ID', 'ecwid-shopping-cart'); ?>
				</a>
			</label>
			<input
				id="ecwid_store_id"
				name="ecwid_store_id"
				type="text"
				placeholder="<?php _e('Store ID', 'ecwid-shopping-cart'); ?>"
				value="<?php if (get_ecwid_store_id() != 1003) echo esc_attr(get_ecwid_store_id()); ?>"
			/>

			<?php if (get_ecwid_store_id() == 1003): ?>
				<img src="<?php echo ECWID_PLUGIN_URL; ?>images/ecwid_wp_attention.gif" alt="">
				<?php _e('The Store ID isn\'t set up.', 'ecwid-shopping-cart'); ?>
			<?php endif; ?>
		</div>

	</fieldset>

	<div class="pure-control-group">
		<button type="submit" class="pure-button pure-button-primary"><?php _e('Save changes', 'ecwid-shopping-cart'); ?></button>
	</div>
</form>
<?php if (get_ecwid_store_id() == '1003'): ?>
<div class="ecwid-instructions">
<?php _e('Instructions on how to get your free Store ID', 'ecwid-shopping-cart'); ?>
</div>
<?php endif; ?>