<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
?>
<form action="<?php echo JRoute::_('index.php?option=com_maint'); ?>" method="post" name="adminForm" id="adminForm">
<table class="displayOrder">
    <tr>
        <td class="title">تم الإصلاح</td>
        <td class="<?php if($this->order->fixed) echo 'green';else echo 'yellow'  ?>">
            <?php if ($this->order->fixed) echo 'نعم'; else echo 'لا'; ?>
        </td>
    </tr>
    <tr>
        <td class="title">مسلسل :</td>
        <td><?php echo $this->order->id?></td>
    </tr>
    <tr>
        <td class="title">إسم العميل: </td>
        <td><?php echo $this->order->name ?></td>
    </tr>
    <tr>
        <td class="title">بريد الكتروني</td>
        <td><?php echo ($this->order->email) ? $this->order->email: 'لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title">هاتف</td>
        <td><?php echo ($this->order->phone) ? $this->order->phone: 'لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title">خلوي</td>
        <td><?php echo ($this->order->mobile) ? $this->order->mobile: 'لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title">نوع الجهاز</td>
        <td><?php echo $this->order->device_type ?></td>
    </tr>
    <tr>
        <td class="title">وصف الجهاز</td>
        <td><?php echo ($this->order->device_desc) ? $this->order->device_desc: ' لايوجد وصف' ?></td>
    </tr>
    <tr>
        <td class="title">ملحقات الجهاز</td>
        <td><?php echo ($this->order->device_accessories) ? $this->order->device_accessories: ' لايوجد ملحقات' ?></td>
    </tr>
    <tr>
        <td class="title">مٌستلم الجهاز</td>
        <td><?php echo $this->order->workers_recipient ?></td>
    </tr>
    <tr>
        <td class="title">مٌصلح الجهاز</td>
        <td><?php echo ($this->order->workers_fixer) ? $this->order->workers_fixer: ' غير مٌسجّل' ?></td>
    </tr>
    <tr>
        <td class="title">المطلوب او المشكلة</td>
        <td><?php echo $this->order->work_required ?></td>
    </tr>
    <tr>
        <td class="title">العمل</td>
        <td><?php echo ($this->order->work_done) ? $this->order->work_done: ' لايوجد بعد' ?></td>
    </tr>
    <tr>
        <td class="title">ملاحظات/ تركيبات</td>
        <td><?php echo ($this->order->extra_parts_notes) ? $this->order->extra_parts_notes: ' لايوجد' ?></td>
    </tr>
    <tr>
        <td class="title">تم دفع : ملاحظات/ تركيبات</td>
        <td><?php if ($this->order->extra_parts_notes_paied || !$this->order->extra_parts_notes) echo 'نعم'; else echo 'لا'; ?></td>
    </tr>
    <tr>
        <td class="title">المبلغ الكلّي</td>
        <td><?php echo $this->order->total_money ?></td>
    </tr>
    <tr>
        <td class="title">مبلغ الخصم</td>
        <td><?php echo $this->order->discount_money ?></td>
    </tr>
    <tr>
        <td class="title">المبلغ المدفٌوع</td>
        <td><?php echo $this->order->paied_money ?></td>
    </tr>
    <tr>
        <td class="title">المبلغ المتبقي</td>
        <td><?php echo $this->order->left_money ?></td>
    </tr>
    <tr>
        <td class="title">تاريخ الدخول </td>
        <td><?php echo $this->order->entered_at ?></td>
    </tr>
    <tr>
        <td class="title">تاريخ الإصلاح </td>
        <td><?php echo $this->order->fixed_at ?></td>
    </tr>
    <tr>
        <td class="title">تاريخ الخروج</td>
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