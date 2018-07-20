<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\models\CatalogMenuPresenter;
use app\widgets\CatalogMenu;
use app\widgets\PaginatorWidget;

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
?>
<div class="row">
	<div class="col-xs-12">
		<h1><?= Html::encode($this->title)?></h1>
		<p>
			<?="Page: ".$model->page;?>
			<?="Quantity: ".$model->quantityPageForCurSection;?>
			<?=$model->section;?>
		</p>
		<p>
			<?php echo PaginatorWidget::widget([
				'perPage' => 50,
				'curPage' => $model->page,
				'totalPage' => $model->quantityPageForCurSection,
				'sectionID' => $model->section
			]);?>
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
				<?php foreach($model->arrElements as $item) : ?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="product-cart">
							<a href="<?=Url::to(['catalog/index', 'section' => $model->section, 'element' => $item['id'], 'page' => 0, ])?>" class="product-cart__title">
								<span><?=$item['name'];?></span>
							</a>
							<?php if(isset($item['imaged']) and ($item['imaged'] !== 'not')) : ?>
								<div data-full="<?=$item['imaged'];?>" class="product-cart__magnifier">
									<i class="fas fa-search-plus"></i>
								</div>
							<?php endif; ?>
							<?php $img = ($item['image'] !== 'not') ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg' ?>
							<img class="img-responsive center-block prodcut-cart__image" src="<?=$img;?>" alt="">
							<div class="prodcut-cart__info clearfix">
								<div class="prodcut-price__quantitty">
									<span><?=$item['quantity'];?> шт.</span>
								</div>
								<div class="prodcut-cart__price">
									<span class="product-cart__price-text"><?=$item['price'];?></span>
									<span class="prodcut-cart__price-icon">&#8381;</span>
								</div>
							</div>
							<div id="<?=$item['id']?>"  class="product-cart__controll clearfix">
								<button class="product-cart__btn-mns">
									<i class="fas fa-minus"></i>
								</button>
								<input value="1" data-old="1" id="input-<?=$item['id'];?>" data-available="<?=$item['quantity'];?>" type="text" class="product-cart__q-input">
								<button class="product-cart__btn-pls">
									<i class="fas fa-plus"></i>
								</button>
								<button class="product-cart__add-basket">
									<i class="fas fa-cart-plus"></i>
								</button>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
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