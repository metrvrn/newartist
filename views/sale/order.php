<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = 'Заказ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row"> 
	<div class="col-xs-12">
		<h1><?= Html::encode($this->title) ?></h1>
	</div>		
</div>
<div class="row">
	<div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
	<div class="col-xs-12 col-md-9">
		<table class="table table-bordered align-table">
			<thead>
				<tr>
					<th>Картинка</th>
					<th>Название</th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Сумма</th>
					 
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
						<td><?=$item['price']?> &#8381;</td>
						<td><?=$item['quantity']?></td>
						<td><?=$item['sum']?> &#8381;</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
			<h4>Сумма <?=$model->basketSum;?> &#8381;</h4>
		<?php if ( count($model->basketArray)>0   ): ?>
			<?php $form = ActiveForm::begin(['id' => 'zakaz-form' ,'action'=>Url::to(['sale/order',]),]);?>
			<?= $form->field($modelForm, 'name')->label('Имя')->textInput();?>
			<?= $form->field($modelForm, 'email')->label('Email');?>
			<?= $form->field($modelForm, 'phone')->label('Телефон');?>
			<?= $form->field($modelForm, 'adress')->textarea(['rows' => 6])->label('Адрес');?>
			<?= $form->field($modelForm, 'comment')->textarea(['rows' => 6])->label('Комментарий');?>
			<div class="form-group">
			<?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-lg button-default', 'name' => 'contact-button',]) ?>
			</div>
			<?php ActiveForm::end(); ?>
		<?php endif; ?>
	</div>
</div>