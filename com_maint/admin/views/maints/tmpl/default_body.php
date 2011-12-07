<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): //var_dump($item);?>
	<tr class="row<?php echo $i % 2; ?>">
		<td>
			<?php echo $item->id; ?>
		</td>
		<td>
          <input onclick="isChecked(this.checked);" type="radio" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $item->id ?>" title="Checkbox for row <?php echo $i ?>">
		</td>
		<td>
			<?php echo $item->name; ?>
		</td>
		<td>
			<?php echo $item->phone; ?>
		</td>
		<td>
			<?php echo $item->email; ?>
		</td>
    <td>
			<?php echo $item->type; ?>
		</td>
    <td>
			<?php echo $item->stat; ?>
		</td>
    <td>
			<?php echo $item->serial; ?>
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
		<td>
			<?php echo $item->left_money; ?>
		</td>
		<td>
			<?php echo $item->entered_at; ?>
		</td>

    <td>
			<?php echo $item->work_done; ?>
		</td>

		<td>
			<?php echo $item->fixed_at; ?>
		</td>

    <td>
			<?php echo $item->delivered_at; ?>
		</td>
	</tr>
<?php endforeach; ?>
