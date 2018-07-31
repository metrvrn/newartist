<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\models\CatalogMenuPresenter;
use app\widgets\CatalogMenu;
use app\widgets\PaginatorWidget;

$this->title = 'Детальная страница';
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
?>
<div class="row">
	<div class="col-xs-12">
		<h1><?= Html::encode($this->title)?></h1>
		<p>
			<?//="Page: ".$model->page;?>
			<?//="Quantity: ".$model->quantityPageForCurSection;?>
			<?//=$model->section;?>
		</p>
	</div>
</div>
<div class="row"> 
	<div class="col-xs-12 col-md-3">
	<?php
			function printSection($arrSection, $cursection)
			{
				if (!isset($arrSection['id'])) {
					return;
				};
				if ($arrSection['visible']) {
					$qv = 0;
					$q = 0;
					foreach ($arrSection['childArray'] as $k => $el) {
						if ($el[visible]) $qv = $qv + 1;
						$q = $q + 1;
					}
					$last = 'notlast';
					if ($q == 0) {
						$last = 'last';
					}
		
					echo '<li class="' . $last . '">';
					echo '<a class="catalog-menu__link clearfix" href=' . Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . '>';
					if (isset($last) and ($last === 'notlast')) {
						echo '<div class="catalog-menu__icon"><i class="fas fa-plus icon"></i></div>';
					}
					echo '<div class="catalog-menu__name">'.$arrSection['name'].'</div>';
					echo '</a>';
					if (!$qv == 0) {
						echo '<ul>';
						foreach ($arrSection['childArray'] as $key => $children) {
							printSection($children, $cursection);
						}
						echo '</ul>';
					} else {
						if ($q > 0 && $arrSection['id'] == $cursection) {
							echo '<ul>';
							foreach ($arrSection['childArray'] as $key => $children) {
								echo '<li>';
								echo '<a  href=' . Url::to(['catalog/index', 'section' => $children['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $children['name'] . '</a>';
								echo '</li>';
							}
							echo '</ul>';
						}
					}
					echo '</li>';
				}
			} 
			
			echo '<ul class="sidebar-menu__root">';
			foreach ($model->arrSectioons as $topSection) {
				printSection($topSection, $model->section);
			};
			echo '</ul>';
			?>
			
	</div>
	<div class="col-xs-12 col-md-9" >
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12">
					детальная страница
					
					
					<?echo $model->arrayDataForCurientElement; ?>
					
				</div>
				
			</div>
		</div>
	</div>		
</div>
<div id="spinner" class="spinner closed">
		<div class="bounce1"></div>
		<div class="bounce2"></div>
		<div class="bounce3"></div>
	</div>
<?php //$this->registerJsVar("addToBasketUrl", Url::to(['catalog/addtobasketajax']) , yii\web\View::POS_END); ?>
<?php //$this->registerJsFile('/js/catalog.js',  ['position' => yii\web\View::POS_END]); ?>