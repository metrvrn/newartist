<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-xs-12"><h1><?= Html::encode($this->title) ?></h1></div>	
	<div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
	<div class="col-xs-12 col-md-9">
		<?php if($model->basketArray) : ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Картинка</th>
						<th>Название</th>
						<th>Код</th>
						<th>Цена</th>
						<th>Количество</th>
						<th>Сумма</th>
						<th>Удалить</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($model->basketArray as $item) : ?>
						<tr>
							<td>
								<?php $img = isset($item['image']) ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg' ?>
								<img class="img-responsive center-block" src="<?=$img;?>" alt="">
							</td>
							<td><?=$item['name']?></td>
							<td><?=$item['code']?></td>
							<td><?=$item['price']?></td>
							<td><?=$item['quantity']?></td>
							<td><?=$item['sum']?></td>
							<td>X</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<p>
				<h4>Сумма корзины: <?=$model->basketSum;?> &#8381;</h4>
			</p>
			<a href="<?=Url::to(['sale/order',]);?>" >
				<div class="form-group">
						<?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-lg button-default', 'name' => 'contact-button']) ?>
				</div>
			</a>
		<?php else: ?>
			<div class="alert alert-danger" role="alert">Ваша корзина пуста</div>
		<?php endif; ?>
	</div>
</div>