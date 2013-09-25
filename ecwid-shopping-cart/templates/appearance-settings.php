<h1>Ecwid shopping cart settings</h1>
<?php if ($ecwid_settings_message): ?>
	<div id="" class="updated fade">
		<p><strong><?php _e('Error'); ?>:</strong> <?php echo $ecwid_settings_message; ?></p>
	</div>
<?php endif; ?>

<form class="pure-form pure-form-aligned ecwid-settings appearance-settings" method="POST" action="options.php">
	<?php settings_fields('ecwid_options_page'); ?>
	<fieldset>

		<legend><?php _e('Appearance', 'ecwid-shopping-cart'); ?></legend>

		<div class="pure-control-group">
			<label for="ecwid_show_categories">
				<?php _e('Show horizontal categories?', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_show_categories"
				name="ecwid_show_categories"
				type="checkbox"
				<?php if (get_option('ecwid_show_categories')): ?>
					checked="checked"
				<?php endif; ?>
				$disabled_str
				/>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_show_search_box">
				<?php _e('Show search box?', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_show_search_box"
				name="ecwid_show_search_box"
				type="checkbox"
				<?php if (get_option('ecwid_show_search_box')): ?>
				checked="checked"
				<?php endif; ?>
				$disabled_str
			/>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_categoriesperrow">
				<?php _e('Categories per row', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_pb_categoriesperrow"
				name="ecwid_pb_categoriesperrow"
				type="text"
				value="<?php echo esc_attr(get_option('ecwid_pb_categoriesperrow')); ?>"
				$disabled_str
			/>
		</div>


		<div class="pure-control-group">
			<label for="ecwid_pb_productspercolumn_grid">
				<?php _e('Products per column in grid mode', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_pb_productspercolumn_grid"
				name="ecwid_pb_productspercolumn_grid"
				type="text"
				value="<?php echo esc_attr(get_option('ecwid_pb_productspercolumn_grid')); ?>"
			$disabled_str
			/>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_productsperrow_grid">
				<?php _e('Products per row in grid mode', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_pb_productsperrow_grid"
				name="ecwid_pb_productsperrow_grid"
				type="text"
				value="<?php echo esc_attr(get_option('ecwid_pb_productsperrow_grid')); ?>"
				$disabled_str
			/>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_productsperpage_list">
				<?php _e('Products per page in list mode', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_pb_productsperpage_list"
				name="ecwid_pb_productsperpage_list"
				type="text"
				value="<?php echo esc_attr(get_option('ecwid_pb_productsperpage_list')); ?>"
			$disabled_str
			/>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_productsperpage_table">
				<?php _e('Products per page in table mode', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_pb_productsperpage_table"
				name="ecwid_pb_productsperpage_table"
				type="text"
				value="<?php echo esc_attr(get_option('ecwid_pb_productsperpage_table')); ?>"
			$disabled_str
			/>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_defaultview">
				<?php _e('Default view mode on product pages', 'ecwid-shopping-cart'); ?>
			</label>

			<select	id="ecwid_pb_defaultview" name="ecwid_pb_defaultview" $disabled_str>
				<option value="grid" <?php if($ecwid_pb_defaultview == 'grid') echo 'selected="selected"' ?> >
					<?php _e('Grid mode', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="list" <?php if($ecwid_pb_defaultview == 'list') echo 'selected="selected"' ?> >
					<?php _e('List mode', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="table" <?php if($ecwid_pb_defaultview == 'table') echo 'selected="selected"' ?> >
					<?php _e('Table mode', 'ecwid-shopping-cart'); ?>
				</option>
			</select>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_searchview">
				<?php _e('Default view mode on search results', 'ecwid-shopping-cart'); ?>
			</label>

			<select	id="ecwid_pb_searchview" name="ecwid_pb_searchview" $disabled_str>
				<option value="grid" <?php if($ecwid_pb_searchview == 'grid') echo 'selected="selected"' ?> >
					<?php _e('Grid mode', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="list" <?php if($ecwid_pb_searchview == 'list') echo 'selected="selected"' ?> >
					<?php _e('List mode', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="table" <?php if($ecwid_pb_searchview == 'table') echo 'selected="selected"' ?> >
					<?php _e('Table mode', 'ecwid-shopping-cart'); ?>
				</option>
			</select>
		</div>

		<tr><th scope="row">
				<label for="ecwid_enable_minicart">Enable minicart attached to horizontal categories?</label></th>
			<td><input type="checkbox" name="ecwid_enable_minicart" id="ecwid_enable_minicart" <?php if (!empty($ecwid_enable_minicart) && !empty($ecwid_show_categories)) echo "checked=\"checked\"";?>
					<?php if (empty($ecwid_show_categories)) {
						echo 'disabled = "disabled"';
					}
					else {
						echo $disabled_str;
					} ?> />
				&nbsp;&nbsp;&nbsp;&nbsp;<img src="//www.ecwid.com/wp-content/uploads/ecwid_wp_attention.gif" alt="">&nbsp;If you added minicart to your blog's sidebar, please disable this option.

			</td>
		</tr>
	</fieldset>

	<fieldset>
		<div class="pure-control-group">
			<button type="submit" class="pure-button pure-button-primary"><?php _e('Save'); ?></button>
		</div>
	</fieldset>
</form>