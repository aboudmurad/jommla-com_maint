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
	font-family: Arial;
	font-weight: bolder;
	padding: 0;
	margin: 0;
	direction: rtl;
	text-align: right;
	width: 105mm;
	height: 148mm;
}

.title {
    width:130px;
}

.border-small {
	padding: 1px;
	height: 1.5em;
	border: 0px solid #F1F1F1;
}

.border {
	padding: 3px;
	height: 4.8em;
	border: 0px solid #F1F1F1;
}

.box { 
	border: 0px solid;
	padding: 3px;
	margin: 0mm;
}

.even td {
    background: #E4E4E4;
}

</style>
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "even";
			}else{
				rows[i].className = "odd";
			}      
		}
	}
}

window.onload=function(){
	altRows('altrows');
}
</script>

</head>
<body>
	<?php if ( isset($_GET['show']) && $_GET['show']=='outrecit' ): ?>
	<div class="box" id="receit">
		<div>
			<img
				src="<?php echo JURI::base()?>/components/com_maint/assets/images/Shafi_top.jpg">
		</div>
		<br>
		<br>
		<br>
		<div>
			<table class="displayOrder" style="font-size: 1.5em;width: 100%">
				<tr>
					<td><?php echo JText::_('COM_MAINT_ID');?> </td>
					<td> :   <?php echo $this->order->id?></td>
				</tr>
				<!--<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NAME');?>:
					</td>
					<td>  :   <?php echo $this->order->name ?></td>
				</tr> -->
				<tr>
					<td><?php echo JText::_('COM_MAINT_DATE_ENTERED');?>
						</td>
					<td> :    <?php echo $this->order->entered_at ?></td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<div>
				<img
					src="<?php echo JURI::base()?>/components/com_maint/assets/images/Shafi_bottom.jpg">
			</div>
		</div>
	</div>
	<?php else: ?>
	<div class="box" id="internal">
		<div style='text-align: center'>
			<?php echo JText::_('COM_MAINT_PPRINT_INTERNAL');?>
		</div>
		<div style="clear: both; height: 18mm; margin-bottom: 10 mm;">
			<div>
				<img
					src="<?php echo JURI::base()?>/components/com_maint/assets/images/logo.png" />
			</div>
		</div>
		<div>
			<table style="font-size: 1em;" id="altrows">
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_ID');?></td>
					<td> : <?php echo $this->order->id?></td>
				</tr>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NAME');?>
					</td>
					<td> : <?php echo $this->order->name ?></td>
				</tr>
				
				<?php if($this->order->phone): ?>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_PHONE')?>
					</td>
					<td> : <?php echo $this->order->phone ?>
					</td>
				</tr>
				<?php endif;?>
				
				<?php if($this->order->mobile):?>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_CELL')?>
					</td>
					<td> : <?php echo $this->order->mobile ?>
					</td>
				</tr>
				<?php endif;?>
				
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_DATE_ENTERED');?></td>
					<td> : <?php echo $this->order->entered_at ?></td>
				</tr>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_MONEY_TOTAL')?></td>
					<td class="border-small"> : </td>
				</tr>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_DATE_FIXED');?></td>
					<td class="border-small"> : </td>
				</tr>

				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_EMPLOYEE_FIXER')?>
					</td>
					<td class="border-small"> : <?php echo $this->order->workers_fixer ?>
					</td>
				</tr>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_DEVICE_JOB')?></td>
					<td class="border"> : <?php echo $this->order->work_required ?></td>
				</tr>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_DEVICE_WORK')?></td>
					<td class="border"> : <?php echo $this->order->work_done ?></td>
				</tr>
				<tr>
					<td class="title"><?php echo JText::_('COM_MAINT_CUSTOMER_NOTES')?>
					</td>
					<td class="border"> : <?php if( $this->order->extra_parts_notes!='لايوجد ') echo $this->order->extra_parts_notes; ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php endif;?>
	<script>
  window.print();
</script>
</body>
</html>
