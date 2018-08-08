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
		$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($val), 'url' => [Url::to(['catalog/index', 'section' => $val, 'element' => 'non', 'page' => 0, ])]];

	};
};
$this->params['breadcrumbs'][] = ['label' => $model->getSectionNameById($model->section), 'url' => [Url::to(['catalog/index', 'section' => $model->section, 'element' => 'non', 'page' => 0, ])]];
$this->params['breadcrumbs'][0] = [
	'label' => 'Каталог',
	'url' => [Url::to(['catalog/index', 'section' => 'non', 'element' => 'non', 'page' => 0, ])]
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
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					<?=PaginatorWidget::widget([
						'perPage' => 50,
						'curPage' => $model->page,
						'totalPage' => $model->quantityPageForCurSection,
						'sectionID' => $model->section
					])?>
				</div>
					<?php
						$productsView = '';
						switch($model->viewType){
							case 'cart':
								$productsView = 'catalog-cart';
								break;
							case 'table':
								$productsView = 'catalog-table';
								break;
							default:
								$productsView = 'catalog-cart';
						}
						echo $this->render('catalog-cart', ['items' => $model->arrElements]);
					?>
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
<?php $this->registerJsFile('/js/catalog.js',  ['position' => yii\web\View::POS_END]); ?>