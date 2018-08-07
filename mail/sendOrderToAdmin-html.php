<?php
    
use yii\helpers\Html;
use app\models\LokalFileModel;
    
$orderLink = Yii::$app->urlManager->createAbsoluteUrl(['saleadmin/orderdetail', 'md5' =>  $order->orderMd5]);

$saleAdminLink = Yii::$app->urlManager->createAbsoluteUrl(['saleadmin/index',]);

$siteName = LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$siteLink = Yii::$app->urlManager->getHostInfo();
?>
    
<div class="send-order">
    <p>
       
        на сайте  <?=Html::a($siteName, $siteLink);?> создан заказ покупателем
    </p>
    <p>
         <br>
        Номер заказа: <?=$order['orderId'];?>.<br>
        Дата: <?=$order['newOrderDatetime'];?>. <br>
        <?php if(isset($order['adress'])) : ?>
        Доставка: <?=$order['adress'];?>. <br>
        <?php endif; ?>
        Наименований: <?=count($order['basketArray']);?>.<br>
        Сумма: <?=$order['basketSum'];?> &#8381;.
    </p>
    <p>
        <?=Html::a('Детальная информация о заказе', $orderLink);?>
    </p>
	
	<p>
        <?=Html::a('все заказы сайте доступны по адресу ', $saleAdminLink);?>
    </p>
	
	
</div>