<div class="pure-form ecwid-settings general-settings">
	<?php include "settings-header.php"; ?>

	<form method="POST" action="options.php" name="settings">
		<?php settings_fields('ecwid_options_page'); ?>
		<fieldset>

			<legend><?php _e('General', 'ecwid-shopping-cart'); ?></legend>
			<input type="hidden" name="settings_section" value="general" />

			<div class="greeting-box complete">
				<div class="main-message">
					<?php if ($_GET['settings-updated']): ?>
						<?php _e('Congratulations!', 'ecwid-shopping-cart'); ?>
					<?php else: ?>
						<?php _e('Greetings!', 'ecwid-shopping-cart'); ?>
					<?php endif; ?>
					<br />
					<?php _e('Your Ecwid store is connected to Wordpress.', 'ecwid-shopping-cart'); ?>
				</div>
				<div class="secondary-message">
					<?php _e('Just 3 little steps left.', 'ecwid-shopping-cart'); ?>
				</div>
			</div>
			<hr />
			<div class="section">
				<div class="info">
					<?php _e('Store ID', 'ecwid-shopping-cart'); ?>: <strong><? echo esc_attr(get_ecwid_store_id()); ?></strong>
				</div>
				<div class="buttons">
					<a class="pure-button" target="_blank" href="//my.ecwid.com/cp">
						<?php _e('Control panel', 'ecwid-shopping-cart'); ?>
					</a>
					<a class="pure-button" target="_blank" href="<?php echo esc_attr(get_page_link(get_option('ecwid_store_page_id'))); ?>">
						<?php _e('Visit storefront', 'ecwid-shopping-cart'); ?>
					</a>
				</div>
			</div>

			<hr />

			<div class="section">
				<div class="info">
					<?php _e('Billing plan', 'ecwid-shopping-cart'); ?>:
					<strong>
					<?php if (ecwid_is_api_enabled()):?>
						<?php _e('Paid', 'ecwid_shopping_cart'); ?>
					<?php else: ?>
						<?php _e('Free', 'ecwid-shopping-cart'); ?>
					<?php endif; ?>
					</strong>
				</div>
				<div class="buttons">
					<?php if (ecwid_is_api_enabled()): ?>
						<a class="pure-button" target="_blank" href="https://my.ecwid.com/cp/CP.html#profile=Billing&t2=My_Profile">
							<?php _e('Billing and plans', 'ecwid-shopping-cart'); ?>
						</a>
					<?php else: ?>
						<a class="pure-button pure-button-primary" target="_blank" href="http://www.ecwid.com/plans-and-pricing.html">
							<?php _e('Upgrade', 'ecwid-shopping-cart'); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<hr />

			<div class="section small-text">
				<span><?php _e('You want to connect another Ecwid account?', 'ecwid-shopping-cart'); ?></span><br />
				<a href="#" onClick="javascript:document.forms['settings'].submit(); return false;"><?php _e('Disconnect and change Store ID', 'ecwid-shopping-cart'); ?></a>
 			</div>

			<hr />
			<p><?php _e('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>.', 'ecwid-shopping-cart'); ?></p>
		</fieldset>
	</form>
</div>