<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_maint&view=reports'); ?>" method="post" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_start"><?php echo JText::_('COM_MAINT_FROM')?></label>
            <input type="text" name="filter_start" id="jform_filter_start" value="<?php echo $this->escape($this->state->get('filter.start')); ?>" title="<?php echo JText::_('COM_MAINT_DATE_START')?>" />

            <label class="filter-search-lbl" for="filter_end"><?php echo JText::_('COM_MAINT_TO')?></label>
            <input type="text" name="filter_end" id="jform_filter_end" value="<?php echo $this->escape($this->state->get('filter.end')); ?>" title="<?php echo JText::_('COM_MAINT_DATE_END')?>" />
        </div>
        <div class="filter-select fltrt">
            <button type="submit" class="btn"><?php echo JText::_('COM_MAINT_SHOW')?></button>
            <button type="button" onclick="document.id('jform_filter_end').value='';document.id('jform_filter_start').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
    </fieldset>
    <?php echo JHtml::_('form.token'); ?>
</form>
<div>
    <div>
        <span><?php echo JText::_('COM_MAINT_DEVICE_NUM_IN')?>: </span>
        <span><?php echo $this->totalDevices['in'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span> <?php echo JText::_('COM_MAINT_DEVICE_NUM_FIXED')?>: </span>
        <span><?php echo $this->totalDevices['fixed'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span><?php echo JText::_('COM_MAINT_DEVICE_NUM_OUT')?> : </span>
        <span><?php echo $this->totalDevices['out'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span><?php echo JText::_('COM_MAINT_MONEY_TOTAL_IN');?> :</span>
        <span><?php echo $this->totalMoney['in'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span><?php echo JText::_('COM_MAINT_MONEY_TOTAL_LEFT')?>:</span>
        <span><?php echo $this->totalMoney['left'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span><?php echo JText::_('COM_MAINT_MONEY_TOTAL_DISCOUNT')?> : </span>
        <span><?php echo $this->totalMoney['discount'] ?></span>
    </div>
</div>