<form class="wrap pure-form pure-form-aligned ecwid-settings appearance-settings" method="POST" action="options.php">
	<?php include "settings-header.php"; ?>

	<?php settings_fields('ecwid_options_page'); ?>
	<input type="hidden" name="settings_section" value="appearance" />

	<fieldset>

		<legend><?php _e('Appearance', 'ecwid-shopping-cart'); ?></legend>

		<div class="pure-control-group">
			<label for="ecwid_show_search_box">
				<?php _e('Display search box', 'ecwid-shopping-cart'); ?>
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
			<label for="ecwid_show_categories">
				<?php _e('Display horizontal categories', 'ecwid-shopping-cart'); ?>
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
			<label for="ecwid_enable_minicart">
				<?php _e('Enable minicart attached to horizontal categories', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_enable_minicart"
				name="ecwid_enable_minicart"
				type="checkbox"
				<?php if (get_option('ecwid_enable_minicart')): ?>
				checked="checked"
			<?php endif; ?>
			$disabled_str
			/>
			<span class="note inline-note">
				<?php _e("If you added minicart to your blog's sidebar, please disable this option.", 'ecwid-shopping-cart'); ?>
			</span>
		</div>
		
		<div class="pure-control-group">
			<label for="ecwid_pb_categoriesperrow">
				<?php _e('Categories per row', 'ecwid-shopping-cart'); ?>
			</label>

			<input
				id="ecwid_pb_categoriesperrow"
				name="ecwid_pb_categoriesperrow"
				type="text"
				class="number"
				value="<?php echo esc_attr(get_option('ecwid_pb_categoriesperrow')); ?>"
				$disabled_str
			/>
		</div>

		<hr />



		<div class="pure-control-group">
			<div class="ecwid-pb-view-size grid active" tabindex="1">
				<div class="title"><?php _e('Grid view', 'ecwid-shopping-cart'); ?></div>
				<div class="main-area"></div>
				<div class="right">
					<div class="ruler"></div>
					<input
						type="text"
						size="2"
						name="ecwid_pb_productsperrow_grid"
						class="number"
						value="<?php echo esc_attr(get_option('ecwid_pb_productsperrow_grid')); ?>"
						/>
				</div>
				<div class="bottom">
					<div class="ruler"></div>
					<input
						type="text"
						size="2"
						name="ecwid_pb_productspercolumn_grid"
						class="number"
						value="<?php echo esc_attr(get_option('ecwid_pb_productspercolumn_grid')); ?>"
						/>
				</div>
			</div>

			<div class="ecwid-pb-view-size list" tabindex="1">
				<div class="title"><?php _e('List view', 'ecwid-shopping-cart'); ?></div>
				<div class="main-area"></div>
				<div class="right">
					<div class="ruler"></div>
					<input
						type="text"
						size="2"
						name="ecwid_pb_productsperpage_list"
						class="number"
						value="<?php echo esc_attr(get_option('ecwid_pb_productsperpage_list')); ?>" />
				</div>
			</div>


			<div class="ecwid-pb-view-size table" tabindex="1">
				<div class="title"><?php _e('Table view', 'ecwid-shopping-cart'); ?></div>
				<div class="main-area"></div>
				<div class="right">
					<div class="ruler"></div>
					<input
						type="text"
						size="2"
						name="ecwid_pb_productsperpage_table"
						class="number"
						value="<?php echo esc_attr(get_option('ecwid_pb_productsperpage_table')); ?>"
						/>
				</div>
			</div>
			<p class="note pb-note"><?php _e('Here you can manage your store look and control how many rows and columns will be in every view for comfort use. Numbers define maximum values, there may be shown less columns, depending on your browser width. Categories view is similar to grid, you can control their look separately.', 'ecwid-shopping-cart'); ?></p>
		</div>

		<hr />

		<div class="pure-control-group">
			<label for="ecwid_pb_defaultview">
				<?php _e('Default view mode on product pages', 'ecwid-shopping-cart'); ?>
			</label>

			<select	id="ecwid_pb_defaultview" name="ecwid_pb_defaultview" $disabled_str>
				<option value="grid" <?php if(get_option('ecwid_pb_defaultview') == 'grid') echo 'selected="selected"' ?> >
					<?php _e('Grid view', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="list" <?php if(get_option('ecwid_pb_defaultview') == 'list') echo 'selected="selected"' ?> >
					<?php _e('List view', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="table" <?php if(get_option('ecwid_pb_defaultview') == 'table') echo 'selected="selected"' ?> >
					<?php _e('Table view', 'ecwid-shopping-cart'); ?>
				</option>
			</select>
		</div>

		<div class="pure-control-group">
			<label for="ecwid_pb_searchview">
				<?php _e('Default view mode on search results', 'ecwid-shopping-cart'); ?>
			</label>

			<select	id="ecwid_pb_searchview" name="ecwid_pb_searchview" $disabled_str>
				<option value="grid" <?php if(get_option('ecwid_pb_searchview') == 'grid') echo 'selected="selected"' ?> >
					<?php _e('Grid view', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="list" <?php if(get_option('ecwid_pb_searchview') == 'list') echo 'selected="selected"' ?> >
					<?php _e('List view', 'ecwid-shopping-cart'); ?>
				</option>
				<option value="table" <?php if(get_option('ecwid_pb_searchview') == 'table') echo 'selected="selected"' ?> >
					<?php _e('Table view', 'ecwid-shopping-cart'); ?>
				</option>
			</select>
		</div>

	</fieldset>

	<fieldset>
		<hr />
		<div class="pure-control-group">
			<button type="submit" class="pure-button pure-button-primary"><?php _e('Save'); ?></button>
		</div>
	</fieldset>
</form>