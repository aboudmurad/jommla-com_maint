<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>

<form action="<?php echo JRoute::_('index.php?option=com_maint'); ?>" method="post" name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div class="filter-search fltlft">
            <select name="filter_workerId" id="jform_filter_workerId" class="inputbox" onchange="this.form.submit()">
                <option value="">- العاملون -</option>
                <?php echo JHtml::_('select.options', $this->state->get('WorkerList'), 'value', 'text', $this->state->get('filter.workerId'));?>
            </select>
        </div>
    </fieldset>
    <div class="clr"> </div>

    <table class="adminlist">
        <thead>
            <tr>
                <th width="6">
                    الرقم
                </th>
                <th width="20">
                </th>
            
                <th>
                    إسم الخازن
                    
                </th>
                <th>
                    إسم المٌستلم
                    
                </th>
                <th width="150">
                    من
                    
                </th>
                <th width="150">
                    إلي
                    
                </th>
                <th width="50">
                    الكمية
                    
                </th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($this->get('Info') AS $i => $item):?>
        <tr>
            <td>
                <?php echo $item->id; ?>
            </td>
            <td>
                <input onclick="isChecked(this.checked);" type="radio" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $item->id ?>" title="Checkbox for row <?php echo $i ?>">
            </td>
            <td>
                <?php echo $item->worker_name; ?>
            </td>
            <td <?php if ($item->manager_name): ?>class="green"<?php else: ?>class="yellow"<?php endif; ?>>
                <?php echo $item->manager_name; ?>
            </td>
            <td>
                <?php echo $item->datetime_from; ?>
            </td>
            <td>
                <?php echo $item->datetime_to; ?>
            </td>
            <td>
                <?php echo $item->money; ?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>