<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_maint&layout=edit&id='.(int) $this->order->id); ?>"
      method="post" name="adminForm" id="maint-form">
	<fieldset class="adminform">
		<?php if ($this->order->id): ?><legend> تغيير طلب صيانة </legend><?php else: ?>
    <legend> إضافة طلب صيانة </legend>
    <?php endif?>
		<ul class="adminformlist">
<?php foreach($this->form->getFieldset() as $field): ?>
			<li><?php echo $field->label;echo $field->input;?></li>
<?php endforeach; ?>
		</ul>
	</fieldset>
	<div>
		<input type="hidden" name="task" value="helloworld.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
