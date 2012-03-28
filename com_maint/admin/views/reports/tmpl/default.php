<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<style>
    @import url(components/com_maint/assets/css/admin.css);
</style>

<form action="<?php echo JRoute::_('index.php?option=com_maint&view=reports'); ?>" method="post" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_start">بداية</label>
            <input type="text" name="filter_start" id="jform_filter_start" value="<?php echo $this->escape($this->state->get('filter.start')); ?>" title="تاريخ البداية" />

            <label class="filter-search-lbl" for="filter_end">نهاية</label>
            <input type="text" name="filter_end" id="jform_filter_end" value="<?php echo $this->escape($this->state->get('filter.end')); ?>" title="تاريخ النهاية" />
        </div>
        <div class="filter-select fltrt">
            <button type="submit" class="btn">إظهار</button>
            <button type="button" onclick="document.id('jform_filter_end').value='';document.id('jform_filter_start').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
    </fieldset>
    <?php echo JHtml::_('form.token'); ?>
</form>
<div>
    <div>
        <span>عدد الأجهزة الداخلة : </span>
        <span><?php echo $this->totalDevices['in'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span>عدد الأجهزة التي تم إصلاحها : </span>
        <span><?php echo $this->totalDevices['fixed'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span>عدد الأجهزة الخارجة : </span>
        <span><?php echo $this->totalDevices['out'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span>إجمالي المبالغ التي تم توريدها :</span>
        <span><?php echo $this->totalMoney['in'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span>إجمالي المبالغ المتبقية:</span>
        <span><?php echo $this->totalMoney['left'] ?></span>
    </div>
    <div>&nbsp;</div>
    <div>
        <span>إجمالي المبالغ المخصومة : </span>
        <span><?php echo $this->totalMoney['discount'] ?></span>
    </div>
</div>