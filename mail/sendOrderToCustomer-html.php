    <?php
     
    use yii\helpers\Html;
     
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['sale/orderdetail', 'md5' =>  $order->orderMd5]);
    ?>
     
    <div class="send-order">
        <p>День добрый  <?= Html::encode($order->name) ?>,</p>
        <p>Вами созда заказ на сайте </p>
        <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    </div>