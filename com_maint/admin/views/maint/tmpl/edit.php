<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>
<form action="<?php
echo
($this->order) ? JRoute::_('index.php?option=com_maint&layout=edit&id=' . (int) $this->order->id) :
        JRoute::_('index.php?option=com_maint&layout=edit&');
?>"
      method="post" name="adminForm" id="maint-form">
    <fieldset class="adminform">
        <?php if ($this->order && $this->order->id): ?>
            <legend> <?php echo JText::_('COM_MAINT_EDIT_APPLICATION'); ?> </legend><?php else: ?>
            <legend> <?php echo JText::_('COM_MAINT_ADD_APPLICATION'); ?> </legend>
            <?php endif ?>
        <ul class="adminformlist">
            <?php foreach ($this->form->getFieldset() as $field): ?>
            <?php if (false==$this->canDeliver && $field->name=='jform[delivered_at]') continue;?>
                <li><?php echo JText::_($field->label);
            echo $field->input; ?></li>
<?php endforeach; ?>
        </ul>
    </fieldset>
    <div>
        <input type="hidden" name="task" value="maint.edit" />
<?php echo JHtml::_('form.token'); ?>
    </div>
</form>
