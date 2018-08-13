<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'Данные заказа';
$this->params['breadcrumbs'][] = ['label' => 'Администратор интернет магазина', 'url' => [Url::to(['saleadmin/index',])]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<span class="order-detail__order-number">
					Заказ № <?=$model->orderId;?>
				</span>
			</div>
			<div class="panel-body">
				<div class="order-detail__order-address">
					<?=$model->adress;?>
				</div>
				<?php if(isset($model->comment)) : ?>
					<div class="order-detail__order-comment">
						<span>Комментарий: <?=$model->comment;?></span>
					</div>
				<?php endif; ?>
				<div class="order-detail__order-sum">
					<b>
						Сумма: <?=$model->basketSum;?> &#8381;
					</b>
				</div>
			</div>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Картинка</th>
					<th>Название</th>
					<th>Код</th>
					<th>Цена</th>
					<th>Колличество</th>
					<th>Сумма</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($model->basketArray as $item) : ?>
					<tr>
						<td class="order-detail__picture-td">
							<img src="https://metropt.ru/upload/<?=$item['image']?>" alt="Картинка товара" class="order-detail__picture"></td>
						<td>
							<?=$item['name']?>
						</td>
						<td>
							<?=$item['code']?>
						</td>
						<td>
							<?=$item['price'];?> &#8381;
						</td>
						<td>
							<?=$item['quantity'];?>
						</td>
						<td>
							<?=$item['sum'];?> &#8381;
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>