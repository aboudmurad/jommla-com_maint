<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
?>
<form action="<?php echo JRoute::_('index.php?option=com_maint'); ?>" method="post" name="adminForm" id="adminForm">
<table class="displayOrder">
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_STATUS_FIX')?></td>
        <td class="<?php if($this->order->fixed) echo 'green';else echo 'yellow'  ?>">
            <?php echo ($this->order->fixed)? JText::_('COM_MAINT_YES') : JText::_('COM_MAINT_NO'); ?>
        </td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_ID')?> :</td>
        <td><?php echo $this->order->id?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NAME')?>: </td>
        <td><?php echo $this->order->name ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_EMAIL')?></td>
        <td><?php echo ($this->order->email) ? $this->order->email: 'لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_PHONE')?></td>
        <td><?php echo ($this->order->phone) ? $this->order->phone: 'لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_CELL')?></td>
        <td><?php echo ($this->order->mobile) ? $this->order->mobile: 'لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DEVICE_TYPE')?></td>
        <td><?php echo $this->order->device_type ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DEVICE_DESC')?></td>
        <td><?php echo ($this->order->device_desc) ? $this->order->device_desc: ' لايوجد وصف' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DEVICE_ACC')?></td>
        <td><?php echo ($this->order->device_accessories) ? $this->order->device_accessories: ' لايوجد ملحقات' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_EMPLOYEE_RECIVED')?></td>
        <td><?php echo $this->order->workers_recipient ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_EMPLOYEE_FIXER')?></td>
        <td><?php echo ($this->order->workers_fixer) ? $this->order->workers_fixer: ' غير مٌسجّل' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DEVICE_JOB')?></td>
        <td><?php echo $this->order->work_required ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DEVICE_WORK')?></td>
        <td><?php echo ($this->order->work_done) ? $this->order->work_done: ' لايوجد بعد' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NOTES')?></td>
        <td><?php echo ($this->order->extra_parts_notes) ? $this->order->extra_parts_notes: ' لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NOTES_PAIED')?></td>
        <td><?php ($this->order->extra_parts_notes_paied || !$this->order->extra_parts_notes)? JText::_('COM_MAINT_YES') : JText::_('COM_MAINT_NO'); ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_MONEY_TOTAL')?></td>
        <td><?php echo $this->order->total_money ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_MONEY_DISCOUNT')?></td>
        <td><?php echo $this->order->discount_money ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_MONEY_PAIED')?></td>
        <td><?php echo $this->order->paied_money ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_MONEY_LEFT')?></td>
        <td><?php echo $this->order->left_money ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DATE_ENTERED')?></td>
        <td><?php echo $this->order->entered_at ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DATE_FIXED')?> </td>
        <td><?php echo $this->order->fixed_at ?></td>
    </tr>
    <tr>
        <td class="title"><?php echo JText::_('COM_MAINT_DATE_EXIT')?></td>
        <td><?php echo $this->order->delivered_at ?></td>
    </tr>
</table>

    <div>
        <input type="hidden" title="Checkbox for row 0" value="1" name="cid[]" id="cb0">
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>