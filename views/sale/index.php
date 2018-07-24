<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'заказы';
?>
<div class="div">

<div class="row">
    <div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
	<div class="col-xs-12 col-md-9">
		<?php if($model) : ?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Номер</th>
						<th>Дата</th>
						<th>Комментарий</th>
						<th>Сумма</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($model->arrOrdersForCurientUser as $order): ?>
						<tr class="" onclick="window.location.href="<?=Url::to(['sale/orderdetail', 'md5' => $order['md5'],])?>">
							<td><?=$order['id']?></td>
							<td><?=$order['comment']?></td>
							<td><?=$order['comment']?></td>
							<td><?=$order['summ']?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
</div>
