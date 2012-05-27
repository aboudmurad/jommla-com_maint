<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ShafiPc</title>
<style>
body {
font-family: Tahoma;
	padding: 0;
	margin: 0;
	direction: rtl;
	text-align: right;
	/*width: 230mm;*/
	height: 148mm;
}
.border-small {
	padding: 1px;
	height: 1.5em;
	border: 0px solid #F1F1F1;
}

.border {
	padding: 1px;
	height: 4.8em;
	border: 0px solid #F1F1F1;
}

.box {
	width: 90mm;
	border: 1px solid;
	height: 143mm;
	padding: 1.0em;
	margin: 0mm;
	float: left;
}

#receit {
    height: 97mm;
    padding-top: 50mm;
    padding-right: 1.2em;
    background: url('components/com_maint/assets/images/receit.jpg');
}

#internal {
    margin-top: 1em;
	height: 149mm;
	padding: 0.3em;
	width: 100mm;
	margin-left: 3px;
}
</style>
</head>
<body>

	<form action="<?php echo JRoute::_('index.php?option=com_maint'); ?>"
		method="post" name="adminForm" id="adminForm">
		<div class="box" id="receit">
			<br> <br> <br>
			<div>
				<table class="displayOrder" style="font-size: 1.3em;">
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_ID');?> :</td>
						<td><?php echo $this->order->id?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NAME');?>:
						</td>
						<td><?php echo $this->order->name ?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_DATE_ENTERED');?>
							:</td>
						<td><?php echo $this->order->entered_at ?></td>
					</tr>
				</table>
			</div>
		</div>



		<div class="box" id="internal">
			<div style='text-align: center'>
				<?php echo JText::_('COM_MAINT_PPRINT_INTERNAL');?>
			</div>
			<div style="clear: both; height: 18mm; margin-bottom: 15 mm;">
				<div>
					<img
						src="<?php echo JURI::base()?>/components/com_maint/assets/images/logo.png" />
				</div>
			</div>
			<div>
				<table style="font-size: 1.0em;">
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_ID');?> :</td>
						<td><?php echo $this->order->id?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NAME');?>:
						</td>
						<td><?php echo $this->order->name ?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_PHONE')?>
						</td>
						<td><?php echo $this->order->phone ?>
						</td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_CELL')?>
						</td>
						<td><?php echo $this->order->mobile ?>
						</td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_DATE_ENTERED');?>
							:</td>
						<td><?php echo $this->order->entered_at ?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_MONEY_TOTAL')?></td>
						<td class="border-small"></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_DATE_FIXED');?> :</td>
						<td class="border-small"></td>
					</tr>

					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_EMPLOYEE_FIXER')?>
						</td>
						<td class="border-small"><?php echo $this->order->workers_fixer ?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_DEVICE_JOB')?></td>
						<td class="border"><?php echo $this->order->work_required ?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_DEVICE_WORK')?></td>
						<td class="border"><?php echo $this->order->work_done ?></td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NOTES')?>
						</td>
						<td class="border"><?php if( $this->order->extra_parts_notes!='لايوجد ') echo $this->order->extra_parts_notes; ?>
						</td>
					</tr>
					<tr>
						<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NOTES_PAIED')?>
						</td>
						<td class="border-small"></td>
					</tr>
				</table>
			</div>
		</div>



		<div>
			<input type="hidden" title="Checkbox for row 0" value="1"
				name="cid[]" id="cb0"> <input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="1" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
	<script>
  window.print();
</script>
</body>
</html>
