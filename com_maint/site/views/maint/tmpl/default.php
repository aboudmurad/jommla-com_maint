<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<style>
    #orderList {
        padding-bottom: 10em;
    }
    
    #orderList > div {
        margin-top: 2em;
    }

    #orderList > div > div:hover {
        background-color: #EEE9AA;
    }

    #orderList div div div {
        border-top: 1px solid #B9D5D7;
        background-color: #E7EAED;
        width: 300px;
        float: right;
        clear: none;
        margin: 2px;
        padding: 3px;
    }

    div#orderList div div div.label {
        width: 100px;
    }

    #orderList div > div{ 
        clear: both;
        display: block; 
    }
    .fixed, .not-fixed {
        margin: 2px;
        padding: 5px;
        width: 405px;
    }
    .not-fixed {
        background-color: #C15B5B;
    }
    .fixed {
        background-color: #5BC193;
    }
</style>
<h1>الصيانة</h1>
<!--<form action="" method="POST">
    <fieldset>
        <div><label for="num"> رقم الطلب أو رقم هاتفك:</label>        <input type="input" name="num" /></div>
    </fieldset>
    <input type="submit" value="عرض">
</form>-->
<div id="orderList">
    <?php
    if (isset($this->orders) && !empty($this->orders)):
        foreach ($this->orders AS $order):
            ?>
            <div>
        <?php if ($order->fixed): ?>
                    <div class="fixed">
                        تم الإصلاح          
                    </div>
                    <div class="fixed">
            رقم الطلب :                         
                          &nbsp;&nbsp;&nbsp;<?php echo $order->id ?>
                    </div>
        <?php else: ?>
                    <div class="not-fixed">
                        لم يتم الإصلاح          
                    </div>
                    <div class="not-fixed">
            رقم الطلب :                         
                          &nbsp;&nbsp;&nbsp;<?php echo $order->id ?>
                    </div>
        <?php endif; ?>

                <div>
                    <div class="label"> الإسم : </div>
                    <div><?php echo $order->name ?></div>
                </div>
                <div>
                    <div class="label"> المبلغ الكلي : </div>
                    <div><?php echo $order->total_money ?></div>
                </div>
                <div>
                    <div class="label"> المبلغ المدفوع : </div>
                    <div><?php echo $order->paied_money ?></div>
                </div>
        <?php if ($order->left_money): ?>
                    <div>
                        <div class="label">المبلغ المتبقي : </div>
                        <div><?php echo $order->left_money ?></div>
                    </div>
        <?php endif; ?>
                <div>
                    <div class="label"> الجهاز : </div>
                    <div><?php echo $order->device_type ?></div>
                </div>

        <?php if ($order->device_desc): ?>
                    <div>
                        <div class="label"> المواصفات </div>
                        <div><?php echo $order->device_desc ?></div>
                    </div>
        <?php endif; ?>

                
        <?php if ($order->device_accessories): ?>
                    <div>
                        <div class="label"> ملحقات الجهاز  </div>
                        <div><?php echo $order->device_accessories ?></div>
                    </div>
        <?php endif; ?>
                
                <div>
                    <div class="label"> العمل المطلوب : </div>
                    <div><?php echo $order->work_required ?></div>
                </div>
                <div>
                    <div class="label"> تاريخ الدخول : </div>
                    <div> <?php echo $order->entered_at ?> </div>
                </div>

        <?php if (strtotime($order->fixed_at) > 0): ?>
                    <div>
                        <div  class="label"> تاريخ الإصلاح : </div>
                        <div><?php echo $order->fixed_at ?></div>
                    </div>
                <?php endif; ?>

        <?php if (strtotime($order->delivered_at) > 0): ?>
                    <div>
                        <div  class="label"> تاريخ خروجه : </div>
                        <div><?php echo $order->delivered_at ?></div>
                    </div>
        <?php endif; ?>

            </div>
        <?php
        endforeach;
    elseif (isset($this->orders) && empty($this->orders)):
        ?>
        <div> لم يتم العثور علي نتائج تطابق بحثك. </div>
<?php endif; ?>
</div>
