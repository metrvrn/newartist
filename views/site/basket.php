<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row"> 
	<div class="col-xs-12">
		<h1><?= Html::encode($this->title) ?></h1>
	</div>		
</div>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Картинка</th>
					<th>Название</th>
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
						<td><?=$item['price']?></td>
						<td><?=$item['quantity']?></td>
						<td><?=$item['sum']?></td>
						<td>X</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row"> 
	<div class="col-xs-12">
		<?php if ( count($model->basketArray)>0   ): ?>
			<?php $form = ActiveForm::begin(['id' => 'zakaz-form']); ?>
			<?= $form->field($modelForm, 'name')->label('Имя')->textInput() ?>
			<?= $form->field($modelForm, 'email')->label('электронный адрес') ?>
			<?= $form->field($modelForm, 'phone')->label('телефон') ?>
			<?= $form->field($modelForm, 'adress')->textarea(['rows' => 6])->label('Адрес')  ?>
			<div class="form-group">
				<?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		<?php endif; ?>
	</div>
</div>