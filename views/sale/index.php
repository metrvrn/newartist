<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-xs-12"><h1><?= Html::encode($this->title) ?></h1></div>
    <div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
	<div class="col-xs-12 col-md-9">
		<?php if($model->arrOrdersForCurientUser ) : ?>
			<div class="container-fluid">
				<div class="row order-index__row order-index__row-title">
					<div class="col-xs-3 order-index__col">Номер</div>
					<div class="col-xs-3 hidden-xs hidden-md order-index__col">Дата</div>
					<div class="col-xs-3 hidden-xs hidden-md order-index__col">Комментарий</div>
					<div class="col-xs-3 order-index__col">Сумма</div>
				</div>
				<?php foreach($model->arrOrdersForCurientUser as $order) : ?>
					<a href="<?=Url::to(['sale/orderdetail', 'md5' => $order['md5'],])?>" class="order-index__link">
						<div class="row order-index__row">
							<div class="col-xs-3 order-index__col"><?=$order['id']?></div>
							<div class="col-xs-3 hidden-xs hidden-md order-index__col"><?=$order['datatime']?></div>
							<div class="col-xs-3 hidden-xs hidden-md order-index__col"><?=$order['comment']?></div>
							<div class="col-xs-3 order-index__col"><?=$order['summ']?></div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">У вас нет заказов</div>
		<?php endif; ?>
	</div>
</div>