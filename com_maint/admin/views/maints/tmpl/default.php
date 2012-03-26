<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';
?>

<style>
    @import url(components/com_maint/assets/css/admin.css);
</style>

<form action="<?php echo JRoute::_('index.php?option=com_maint'); ?>" method="post" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
            <input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />

            <button type="submit" class="btn"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
            <button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
        </div>
        <div class="filter-select fltrt">
            <select name="filter_fixed" class="inputbox" onchange="this.form.submit()">
                <option value="">- حالة الإصلاح -</option>
                <option value="1" <?php if (is_numeric($this->state->get('filter.fixed')) && $this->state->get('filter.fixed')==1) echo 'selected="selected"' ?>>تم الإصلاح</option>
                <option value="0" <?php if (is_numeric($this->state->get('filter.fixed')) && $this->state->get('filter.fixed')==0) echo 'selected="selected"' ?>>لم يتم الإصلاح</option>
            </select>
            
            <select name="filter_left_money" class="inputbox" onchange="this.form.submit()">
                <option value="">- حالة الدفع -</option>
                <option value="0" <?php if (is_numeric($this->state->get('filter.left_money')) && $this->state->get('filter.left_money')==0) echo 'selected="selected"' ?>>تم الدفع</option>
                <option value="1" <?php if (is_numeric($this->state->get('filter.left_money')) && $this->state->get('filter.left_money')==1) echo 'selected="selected"' ?>>متبقي</option>
            </select>
            
            <select name="filter_delivered" class="inputbox" onchange="this.form.submit()">
                <option value="">- حالة التسليم -</option>
                <option value="1" <?php if (is_numeric($this->state->get('filter.delivered')) && $this->state->get('filter.delivered')==1) echo 'selected="selected"' ?> >تم التسليم للعميل</option>
                <option value="0" <?php if (is_numeric($this->state->get('filter.delivered')) && $this->state->get('filter.delivered')==0) echo 'selected="selected"' ?> >لم يتم التسليم للعميل</option>
            </select>
            
            <select name="filter_deviceType" class="inputbox" onchange="this.form.submit()">
                <option value="">- أنواع الأجهزة -</option>
                <?php echo JHtml::_('select.options', $this->state->get('deviceTypesList'), 'value', 'text',$this->state->get('filter.deviceType') );?>
            </select>
            
            <select name="filter_clientId" class="inputbox" onchange="this.form.submit()">
                <option value="">- العملاء -</option>
                <?php echo JHtml::_('select.options', $this->state->get('clientIdsList'), 'value', 'text', $this->state->get('filter.clientId'));?>
            </select>
        </div>
    </fieldset>
    <div class="clr"> </div>

    <table class="adminlist">
        <thead><?php echo $this->loadTemplate('head'); ?></thead>
        <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
        <tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
    </table>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
