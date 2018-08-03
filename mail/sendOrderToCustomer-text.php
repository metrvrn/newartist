    <?php
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['sale/orderdetail', 'md5' => $order->orderMd5]);
    ?>
     
    Hello <?= $user->username ?>,
    Follow the link below to reset your password:
     
    <?= $resetLink ?>