<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\models\CatalogMenuPresenter;
use app\widgets\CatalogMenu;
use app\widgets\PaginatorWidget;


$this->params['breadcrumbs'][] = $this->title;


$session = Yii::$app->session;
$session->open();
/// we have to delete lasta element form  $model->TopArrCurSection
$countTopArray = count($model->TopArrCurSection);

if ($countTopArray > 0) {

	unset($model->TopArrCurSection[array_search($model->section, $model->TopArrCurSection)]);
}; 
//add all of top sections 

if (isset($model->TopArrCurSection) && $countTopArray > 0) {
	$reverseArray = array_reverse($model->TopArrCurSection);
	foreach ($reverseArray as $val) {
		$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($val), 'url' => [Url::to(['catalog/index', 'section' => $val, 'element' => 'non', 'page' => 0, ])]];

	};
};
$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($model->section), 'url' => [Url::to(['catalog/index', 'section' => $model->section, 'element' => 'non', 'page' => 0, ])]];
$this->params['breadcrumbs'][0] = [
	'label' => 'Каталог',
	'url' => [Url::to(['catalog/index', 'section' => 'non', 'element' => 'non', 'page' => 0, ])]
];
unset($this->params['breadcrumbs'][1]);
$this->params['breadcrumbs'][] = trim($model->arrElements[0]['name']);
//current product
$item = $model->arrElements[0];
$this->title = $item['name'];
?>
<div class="row"> 
	<div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $model])?>
  	</div>
		<div class="product-detail__wrapper">
		<div class="col-xs-12 col-md-9">
		<div class="container-flud">
			<div class="row">
				<?php if($item) :?>
					<div class="col-md-9">
						<h3><?= Html::encode($item['name'])?></h3>
					</div>
					<div class="col-md-6">
						<div class="detail-product" id="productCart" data-id="<?=$item['id'];?>">
							<div class="detail-image">
								<?php
									if($item['imaged'] !== 'not'){
										$image = 'https://metropt.ru/upload/'.$item['imaged'];
									}
									else{
										$image = $_SERVER['HOSTNAME'].'/images/no-image-bg.jpg';
									}
								?>
							<img src="<?=$image?>" alt="" class="image-responsive">
						</div>
					</div>
					</div>
					<div class="col-md-6">
						<?php if($model->arrayDataForCurientElement) : ?>
							<table class="table table-bordered">
								<tbody>
									<?php foreach($model->arrayDataForCurientElement as $prop) : ?>
										<?php if($prop['PROPERTY_ID'] == '178') continue; ?>
										<tr>
											<td><?=$prop['NAME_PROPERTY']?></td>
											<td><?=$prop['VALUE']?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
						<div class="detail-bottom">
							<div class="detail-quantity">
								<b>Остатки: <span id="available"><?=$item['quantity']?></span></b>
							</div>
							<div id="detailControl" class="detail-control">
								<div class="detail-control__btn-wrapper clearfix">
									<button id="minusBtn" class="detail-control_btn detail-control__btn-minus"><i class="fas fa-minus"></i></button>
									<input id="quantityInput" class="detail__quantity-input" type="text" value=1 data-oldValue="1">
									<button id="plusBtn" class="detail-control_btn detail-control__btn-plus"><i class="fas fa-plus"></i></button>
								</div>
								<div class="detail-controll__basket-wrappper">
									<button id="addBasketBtn" class="detail-control__basket-btn">Добавить в корзину</button>
								</div>
							</div>
						</div>
					</div>
					<?php endif; ?>	
				</div>
		</div>
		</div>
	</div>
</div>
<?php $this->registerJsVar("addToBasketUrl", Url::to(['catalog/addtobasketajax']) , yii\web\View::POS_END); ?>
<?php $this->registerJsFile("/js/detail-catalog.js",  ['position' => yii\web\View::POS_END]); ?>

