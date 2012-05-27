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
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_ID', 'o.id', $listDirn, $listOrder); ?>
    </th>
    <th width="20">
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_CUSTOMER_NAME', 'c.name', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_CUSTOMER_PHONE', 'c.phone', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_CUSTOMER_CELL', 'c.mobile', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_CUSTOMER_EMAIL', 'c.email', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_DEVICE_TYPE', 'o.device_type', $listDirn, $listOrder); ?>
       
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_WORK_DONE', 'o.fixed', $listDirn, $listOrder); ?>
    
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_MONEY_TOTAL', 'o.total_money', $listDirn, $listOrder); ?>
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_MONEY_DISCOUNT', 'o.discount_money', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_MONEY_PAIED', 'o.paied_money', $listDirn, $listOrder); ?>
       
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_MONEY_LEFT', 'o.left_money', $listDirn, $listOrder); ?>
        
    </th>
    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_DATE_ENTERED', 'o.entered_at', $listDirn, $listOrder); ?>
       
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_DATE_FIXED', 'o.fixed_at', $listDirn, $listOrder); ?>
        
    </th>

    <th>
        <?php echo JHtml::_('grid.sort', 'COM_MAINT_DATE_EXIT', 'o.delivered_at', $listDirn, $listOrder); ?>
    </th>


</tr>
