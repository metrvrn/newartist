<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
 

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$this->title = 'заказы интернет магазина 6';

$this->params['breadcrumbs'][] = ['label' => 'администратор интернет магазина', 'url' => [Url::to(['saleadmin/index',])]];

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-xs-12">
		<h1><?= Html::encode($this->title) ?></h1>
	</div>
	<div class="col-xs-12">
		<?php if($model->arrayOrders) : ?>
			<table>
				<thead>
					<tr>
						<th>Номер</th>
						<th>Пользователь</th>
						<th>Телефон</th>
						<th>Email</th>
						<th>Адрес</th>
						<th>Комментарий</th>
						<th>Сумма</th>
						<th>Заказать в "Мэтр"</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($model->arrayOrders as $order) : ?>
						<tr>
							<td><?=Html::a(
								$order['id'],
								Html::encode(Url::to(['saleadmin/detail', 'md5' => $order['md5']])))
								?></a></td>
							<td><?=$order['name']?></td>
							<td><?=$order['phone']?></td>
							<td><?=$order['email']?></td>
							<td><?=$order['adress']?></td>
							<td><?=$order['comment']?></td>
							<td><?=$order['summ']?></td>
							<td><?=Html::a(
								'Заказать',
								Html::encode(Url::to(['saleadmin/metr-order', 'md5' => $order['md5']])),
								['class' => 'btn button-default'])
							?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
    

	
	</div>
	
</div>