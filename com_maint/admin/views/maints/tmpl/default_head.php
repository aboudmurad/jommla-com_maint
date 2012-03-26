<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$saveOrder	= $listOrder == 'a.ordering';
?>
<tr>
    <th width="6">
        <?php echo JHtml::_('grid.sort', 'الرقم', 'o.id', $listDirn, $listOrder); ?>
    </th>
    <th width="20">
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'إسم العميل', 'c.name', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'الهاتف', 'c.phone', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'خلوي', 'c.mobile', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', ' بريد الكتروني', 'c.email', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', ' نوع الجهاز', 'o.device_type', $listDirn, $listOrder); ?>
       
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', ' تم العمل', 'o.fixed', $listDirn, $listOrder); ?>
    
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', ' مبلغ كلي', 'o.total_money', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', ' مبلغ خصم', 'o.discount_money', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', ' مبلغ مدفوع', 'o.paied_money', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'مبلغ متبقي', 'o.left_money', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', ' تاريخ دخول', 'o.entered_at', $listDirn, $listOrder); ?>
       
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'تاريخ إصلاح', 'o.fixed_at', $listDirn, $listOrder); ?>
        
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'تاريخ خروج', 'o.delivered_at', $listDirn, $listOrder); ?>
    </th>


</tr>
