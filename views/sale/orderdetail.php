<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'данные заказа';
?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<?//=CatalogMenu::widget(['model' => $catalogModel])?>
  </div>
	<div class="col-xs-12 col-md-9">
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
					<?//=$model->summ;?>
				</div>
			</div>
		</div>
	  <?
		foreach($model->basketArray as $item){
			echo $item['name'].' id ='.$item['id'].'<br>';
			echo $item['image'].' id ='.$item['id'].'<br>';
		}
	  ?>
	</div>
</div>
