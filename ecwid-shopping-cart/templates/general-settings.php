<div class="wrap pure-form ecwid-settings general-settings">
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
				</div>

				<div class="secondary-message">
					<?php _e('Your Ecwid store is connected to Wordpress.', 'ecwid-shopping-cart'); ?>
				</div>
			</div>
			<hr />
			<div class="section">
				<div class="left">
					<span class="main-info">
						<?php _e('Store ID', 'ecwid-shopping-cart'); ?>: <strong><? echo esc_attr(get_ecwid_store_id()); ?></strong>
					</span>
				</div>
				<div class="right"">
					<a class="pure-button" target="_blank" href="//my.ecwid.com/cp?source=wporg">
						<?php _e('Control panel', 'ecwid-shopping-cart'); ?>
					</a>
					<a class="pure-button" target="_blank" href="<?php echo esc_attr(get_page_link(get_option('ecwid_store_page_id'))); ?>">
						<?php _e('Visit storefront', 'ecwid-shopping-cart'); ?>
					</a>
				</div>
			</div>

			<hr />

			<div class="section">
				<div class="left">
					<span class="main-info">
						<?php _e('Billing plan', 'ecwid-shopping-cart'); ?>:
						<strong>
							<?php
							if (ecwid_is_api_enabled()) {
								_e('Paid', 'ecwid-shopping-cart');
							} else {
								_e('Free', 'ecwid-shopping-cart');
							}
							?>
						</strong>
					</span>
					<div class="secondary-info">
						<?php
						if (ecwid_is_api_enabled())
							_e('Thank you for supporting Ecwid!', 'ecwid-shopping-cart');
						else
							_e('You can get more premium features with our paid plans.', 'ecwid-shopping-cart');
						?>
					</div>
				</div>

				<div class="right">
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

			<div class="section">
				<div class="left secondary-info">
					<span><?php _e('You want to connect another Ecwid account?', 'ecwid-shopping-cart'); ?></span><br />
					<a href="#" onClick="javascript:document.forms['settings'].submit(); return false;"><?php _e('Disconnect and change Store ID', 'ecwid-shopping-cart'); ?></a>
 				</div>
			</div>

			<hr />
			<p><?php _e('Questions? Visit <a href="http://help.ecwid.com/?source=wporg">Ecwid support center</a>.', 'ecwid-shopping-cart'); ?></p>
		</fieldset>
	</form>
</div>