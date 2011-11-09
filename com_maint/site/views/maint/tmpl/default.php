<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<style>
    .label {
        float: right;
        }
.label:parent {
    clear: both;
    }
</style>
<h1>مراجعة طلب صيانة</h1>
<form action="" method="POST">
    <fieldset>
        <div><label for="id"> رقم الطلب </label>        <input type="input" name="id" /></div>
        <div><label for="phone"> رقم هاتفك  المٌسجّل </label> <input type="input" name="phone" /></div>
    </fieldset>
    <input type="submit" value="فحص">
</form>

<?php if (isset($this->order) && !empty($this->order) ): ?>
    <?php if($this->order->fixed_at): ?>
        <div class="fixed">تم الإصلاح</div>
    <?php else: ?>
        <div class="not-fixed">لم يتم الإصلاح</div>
    <?php endif; ?>
    <div>
        <div>
            <div class="label"> الإسم : </div>
            <div><?php echo $this->order->name ?></div>
        </div>
        <div>
            <div class="label">الهاتف : </div>
            <div><?php echo $this->order->phone ?></div>
        </div>
        <div>
            <div class="label"> البريد الإلكتروني : </div>
            <div><?php echo $this->order->email ?></div>
        </div>
        <div>
            <div class="label"> المبلغ المدفوع : </div>
            <div><?php echo $this->order->paied_money ?></div>
        </div>
        <div>
            <div class="label">المبلغ المتبقي : </div>
            <div><?php echo $this->order->left_money ?></div>
        </div>
        <div>
            <div class="label"> رقم الطلب : </div>
            <div><?php echo $this->order->id ?></div>
        </div>
        <div>
            <div class="label"> الجهاز : </div>
            <div><?php echo $this->order->type ?></div>
        </div>
        <div>
            <div class="label"> الحالة : </div>
            <div><?php echo $this->order->stat ?></div>
        </div>
        <div>
            <div class="label"> تاريخ استلام الطلب : </div>
            <div> <?php echo $this->order->entered_at ?>
        </div>
        <?php if($this->order->fixed_at): ?><div><div> تاريخ الإصلاح : </div> <div><?php echo $this->order->fixed_at ?></div></div><?php endif; ?>
    </div>
<?php endif; ?>
