<div class="wrap">

	<form class="pure-form pure-form-aligned ecwid-settings appearance-settings"
	  id="adminForm"
	  method="POST"
	  action="<?php echo JRoute::_('index.php?option=com_ecwid'); ?>"
	>
	<input type="hidden" name="task" />
<?php echo JHtml::_('form.token'); ?>

<fieldset>

<div class="pure-control-group small-input">
	<div class="input">
		<div>
			<?php $this->renderElement('displaySearch'); ?>
		</div>
	</div>
	<div class="label">
		<?php $this->renderLabel('displaySearch'); ?>
	</div>
	<div class="note">
		<?php echo JText::_(
			'Search box via module note',
			JRoute::_('index.php?option=com_modules&filter_search=ecwid%20search')
		);
		?>
	</div>
</div>

<div class="pure-control-group small-input">
	<div class="input">
		<div>
			<?php $this->renderElement('displayCategories'); ?>
		</div>
	</div>
	<div class="label">
		<?php $this->renderLabel('displayCategories'); ?>
	</div>
	<div class="note">
		<?php echo JText::_(
			'Categories via module note',
			JRoute::_('index.php?option=com_modules&filter_search=ecwid%20categories')
		);
		?>
	</div>
</div>


<div class="pure-control-group small-input">
	<div class="input">
		<div>
			<?php $this->renderElement('categoriesPerRow'); ?>
		</div>
	</div>
	<div class="label">
		<?php $this->renderLabel('categoriesPerRow'); ?>
	</div>
	<div class="note">
	</div>
</div>

<hr />


<div class="pure-control-group">
	<label class="products-per-page-label"><?php echo JText::_('Number of products per page'); ?></label>
	<div class="ecwid-pb-view-size grid active" tabindex="1">
		<div class="title"><?php echo JText::_('Grid view'); ?></div>
		<div class="main-area">
			<?php $this->embed_svg('grid'); ?>
		</div>
		<div class="right">
			<div class="ruler"></div>
			<?php $this->renderElement('gridColumns'); ?>
		</div>
		<div class="bottom">
			<div class="ruler"></div>
			<?php $this->renderElement('gridRows'); ?>
		</div>
	</div>

	<div class="ecwid-pb-view-size list" tabindex="1">
		<div class="title"><?php echo JText::_('List view'); ?></div>
		<div class="main-area">
			<?php $this->embed_svg('list'); ?>
		</div>
		<div class="right">
			<div class="ruler"></div>
			<?php $this->renderElement('list'); ?>
		</div>
	</div>


	<div class="ecwid-pb-view-size table" tabindex="1">
		<div class="title"><?php echo JText::_('Table view'); ?></div>
		<div class="main-area">
			<?php $this->embed_svg('table'); ?>
		</div>
		<div class="right">
			<div class="ruler"></div>
			<?php $this->renderElement('table'); ?>
		</div>
	</div>
	<p class="note pb-note"><?php echo JText::_('Here you can control how many products will be displayed per page. These options define maximum values. If there is not enough space to show all product columns, Ecwid will adapt the number of columns to hold all products.'); ?></p>
</div>

<hr />

<div class="pure-control-group">
	<div class="label">
		<?php $this->renderLabel('categoryView'); ?>
	</div>
	<?php $this->renderElement('categoryView'); ?>
</div>

<div class="pure-control-group">
	<div class="label">
		<?php $this->renderLabel('searchView'); ?>
	</div>
	<?php $this->renderElement('searchView'); ?>
</div>

</fieldset>
</form>

</div>
