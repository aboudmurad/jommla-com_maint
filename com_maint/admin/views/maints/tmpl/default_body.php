<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->items as $i => $item): //var_dump($item); ?>
    <tr class="row<?php echo $i % 2; ?>">
        <td>
            <a href="<?php echo JURI::current()?>?option=com_maint&task=maint.edit&id=<?php echo $item->id ?>"><?php echo $item->id; ?></a>
        </td>
        <td>
            <input onclick="isChecked(this.checked);" type="radio" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $item->id ?>" title="Checkbox for row <?php echo $i ?>">
        </td>
        <td>
            <a href="<?php echo JURI::current()?>?option=com_maint&task=maint.edit&id=<?php echo $item->id ?>"><?php echo $item->name; ?></a>
        </td>
        <td>
            <?php echo $item->phone; ?>
        </td>
        <td>
            <?php echo $item->mobile; ?>
        </td>
        <td>
            <?php echo $item->email; ?>
        </td>
        <td>
            <?php echo $item->device_type; ?>
        </td>
        <td>
            <span class="fixed_<?php echo $item->fixed; ?>"></span>
        </td>
        <td>
            <?php echo $item->total_money; ?>
        </td>
        <td>
            <?php echo $item->discount_money; ?>
        </td>
        <td>
            <?php echo $item->paied_money; ?>
        </td>
        <td <?php if (!$item->left_money): ?>class="green"<?php else: ?>class="yellow"<?php endif; ?>>
            <?php echo $item->left_money; ?>
        </td>
        <td>
            <?php echo $item->entered_at; ?>
        </td>
        <td>
            <?php echo $item->fixed_at; ?>
        </td>

        <td <?php if (strtotime($item->delivered_at) > 0): ?>class="green"<?php else: ?>class="yellow"<?php endif; ?>>
            <?php echo $item->delivered_at; ?>
        </td>
    </tr>
<?php endforeach; ?>