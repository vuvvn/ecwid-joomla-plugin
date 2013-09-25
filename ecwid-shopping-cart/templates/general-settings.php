<form class="pure-form pure-form-aligned ecwid-settings general-settings" method="POST" action="options.php">

	<h1 style="background:url('<?php echo ECWID_PLUGIN_URL; ?>images/ecwid-menu-icon.png') no-repeat 0% 115%; padding-left: 30px;line-height: 30px">Ecwid shopping cart settings</h1>
	<?php if ($ecwid_settings_message): ?>
		<div id="" class="updated fade">
			<p><strong><?php _e('Error'); ?>:</strong> <?php echo $ecwid_settings_message; ?></p>
		</div>
	<?php endif; ?>


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
				<?php _e('The Store ID isn\'t set up. Please enter your Store ID to assign your site with your Ecwid store and show your products. <a href="http://kb.ecwid.com/Instruction-on-how-to-get-your-free-Store-ID-(for-WordPress)" target="_blank">How to get this free ID</a>', 'ecwid-shopping-cart'); ?>
			<?php endif; ?>
		</div>

	</fieldset>

	<div class="pure-control-group">
		<button type="submit" class="pure-button pure-button-primary"><?php _e('Save changes', 'ecwid-shopping-cart'); ?></button>
	</div>
</form>