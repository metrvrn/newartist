    <?php
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['saleadmin/orderdetail', 'md5' => $order->orderMd5]);
    ?>
     
    Hello <?= $user->username ?>,
   для просмотра заказа можно перейти на 
     
    <?= $resetLink ?>