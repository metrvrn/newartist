<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\models\CatalogMenuPresenter;
use app\widgets\CatalogMenu;
use app\widgets\PaginatorWidget;
use app\models\LokalFileModel;

$this->title = 'Каталог';
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
		$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($val), 'url' => [Url::to(['catalog/index', 'section' => $val, 'element' => 'non', 'page' => 0, 'view' => $model->view])]];

	};
};
$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($model->section), 'url' => [Url::to(['catalog/index', 'section' => $model->section, 'element' => 'non', 'page' => 0, 'view' => $model->view])]];
$this->params['breadcrumbs'][0] = [
	'label' => 'Каталог',
	'url' => [Url::to(['catalog/index', 'section' => 'non', 'element' => 'non', 'page' => 0, 'view' => $model->view])]
];
$showRootBreadcrumbs = LokalFileModel::getDataByKeyFromLocalfile('show_root_section') === 'true' ? true : false;
if(!$showRootBreadcrumbs){
	unset($this->params['breadcrumbs'][1]);
};
$sectionsCount = count($this->params['breadcrumbs']);
if($sectionsCount > 1){
	if($showRootBreadcrumbs){
		$sectionName = $this->params['breadcrumbs'][$sectionsCount - 1]['label'];
	}else{
		$sectionName = $this->params['breadcrumbs'][$sectionsCount]['label'];
	}
}
?>
<div class="row">
	<div class="col-xs-12">
		<h1>
			<?= Html::encode($this->title)?>
			<?php if(isset($sectionName)) : ?>
				<small> - <?=$sectionName?></small>
			<?php endif; ?>
		</h1>
	</div>
</div>
<div class="row"> 
	<div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $model])?>
  	</div>
	<div class="col-xs-12 col-md-9" >
				<div class="row">
					<div class="col-xs-12">
						<div class="pull-left">
							<?=PaginatorWidget::widget([
								'perPage' => 50,
								'curPage' => $model->page,
								'totalPage' => $model->quantityPageForCurSection,
								'sectionID' => $model->section,
								'view' => $model->view
							])?>
						</div>
						<div class="pull-right">
							<div class="clearfix">
								<a class="catalog__view-link" href="<?=Url::to(['catalog/index',
									'section' => $model->section,
									'element' => 'non',
									'page' => $model->page,
									'view' => 'cart']);?>" title="Карточка"><i class="fas fa-columns"></i></a>
								<a class="catalog__view-link" href="<?=Url::to(['catalog/index',
									'section' => $model->section,
									'element' => 'non',
									'page' => $model->page,
									'view' => 'table']);?>" title="Таблица"><i class="fas fa-table"></i></a>
								</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<?php if($model->arrElements) : ?>
						<table class="table table-bordered table-hover table-text-centered">
							<thead>
								<tr>
									<th>Картинка</th>
									<th>Название</th>
									<th class="hidden-xs hidden-sm">Код</th>
									<th>Цена</th>
									<th class="hidden-xs hidden-sm">Остатки</th>
									<th>В корзину</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($model->arrElements as $item) : ?>
									<tr>
										<td>
											<?php
												$img = ($item['image'] !== 'not') ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg';
												$bigimage = ($item['imaged'] !== 'not') ? "https://metropt.ru/upload/".$item['imaged'] : '';	
											?>
											<img data-bigimage="<?=$bigimage;?>" class="img-responsive center-block catalog-table__image" src="<?=$img;?>" alt="">
										</td>
										<td>
											<a href="<?=Url::to(['catalog/index', 'section' => $model->section, 'element' => $item['id'], 'page' => 0, 'view' => $model->view])?>">
												<span><?=$item['name'];?></span>
											</a>
										</td>
										<td class="hidden-xs hidden-sm"><?=$item['code'];?></td>
										<td><?=$item['price'];?>&#8381;</td>
										<td class="hidden-xs hidden-sm"><?=$item['quantity'];?></td>
										<td>
											<div class="catalog-table__input-group clearfix">
												<input type="hidden" class="catalog-table__available-input" value="<?=$item['quantity'];?>">
												<input data-oldValue=1 data-available="<?=$item['quantity'];?>" type="text" value=1 class="catalog__quantity-input">
												<button data-id="<?=$item['id'];?>" class="catalog-table__quantity-btn">Добавить</button>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else : ?>
					<?php endif; ?>
				</div>
		</div>
	</div>		
</div>
<div id="spinner" class="spinner closed">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
<?php $this->registerJsVar("addToBasketUrl", Url::to(['catalog/addtobasketajax']) , yii\web\View::POS_END); ?>
<?php $this->registerJsFile('/js/catalog_table.js',  ['position' => yii\web\View::POS_END]); ?>