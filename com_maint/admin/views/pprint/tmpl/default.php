<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
   <head>
      <title>ShafiPc </title>
      <style>
          body {
              padding: 3mm;
              direction: rtl;
              text-align: right;
              border: 1px solid;
              width: 200mm;
              height: 70mm;
          }
      </style>
   </head>
   <body>

<form action="<?php echo JRoute::_('index.php?option=com_maint'); ?>" method="post" name="adminForm" id="adminForm">
<div style='text-align: center'>
    <h2> إيصال استلام </h2>
</div>
<div style="clear: both; height: 20mm;">
    <div style='width: 120mm; float: right;'>
        <img src="<?php echo JURI::base()?>/components/com_maint/assets/images/logo.png" />
        
    </div>
    <div style="padding-right: 50mm;font-size: 1.3em;">
            
            10 شارع ورا القمر
            <br >
            هاتف : 999 999 999 99+
     </div>
    
</div>
<div>
<table class="displayOrder" style="font-size: 1.3em;">
    <tr>
        <td class="title">مسلسل :</td>
        <td><?php echo $this->order->id?></td>
    </tr>
    <tr>
        <td class="title">إسم العميل: </td>
        <td><?php echo $this->order->name ?></td>
    </tr>
    <tr>
        <td class="title">تاريخ الدخول :</td>
        <td><?php echo $this->order->entered_at ?></td>
    </tr>
</table>
</div>


    <div>
        <input type="hidden" title="Checkbox for row 0" value="1" name="cid[]" id="cb0">
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="1" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
<script>
  window.print();
</script>
</body>
</html>