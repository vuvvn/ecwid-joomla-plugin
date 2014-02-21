<?php
/**
 * @version    $Id: default.php 10741 2013-05-28 17:02:09Z steph $
 * @author     RocketTheme http://www.rockettheme.com
 * @copyright  Copyright (C) 2007 - 2013 RocketTheme, LLC
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Based on work by
 * @author     Rick Blalock
 * @package    Joomla
 * @subpackage ecwid
 * @license    GNU/GPL
 *
 * ECWID.com e-commerce wrapper
 */
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$model = $this->getModel();

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'rokbridge.cancel' || document.formvalidator.isValid(document.id('ecwid-form'))) {
			Joomla.submitform(task, document.getElementById('ecwid-form'));
		}
		else {
			alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED'));?>');
		}
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_ecwid&controller=default&layout=default'); ?>" method="post" name="adminForm" id="ecwid-form" class="form-validate">
	<table class="noshow">
		<tr valign="top">
			<td width="60%">
				<div id="ecwid-guide">
					<h2>Guide</h2>

					<div id="ecwid-wrapper">
						<div id="ecwid-content">
							<?php echo $this->loadTemplate('guide'); ?>
						</div>
					</div>
				</div>
			</td>
			<td width="40%">
				<div id="ecwid-config">
					<h2>Configuration</h2>
					<?php echo $this->render(); ;?>

					<div class="clear"></div>
					<div class="copyright">
                                               Thanks to Rick Blalock and <a target="_blank" href="http://www.rockettheme.com/">RocketTheme</a> for their contribution to this plugin
					</div>
				</div>
			</td>
		</tr>
	</table>
    <input type="hidden" name="controller" value="default" />
    <input type="hidden" name="option" value="com_ecwid" />
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>

<?php echo JHtml::_('behavior.keepalive'); ?>
