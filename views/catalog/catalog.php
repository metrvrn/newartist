<?php

/* @var $this yii\web\View */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\models\CatalogMenuPresenter;

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
	</div>
</div>
<div class="row"> 
	<div class="col-sm-12 col-md-3">
			<?php
				/* $mr = new CatalogMenuPresenter();
				$mr->sArr= $model->arrSectioons;
				$mr->oSecArr = $model->TopArrCurSection;
				$mr->render(); */
				
function printSection($arrSection,$cursection)
{
	  	 
	if (!isset($arrSection['id'])) {return;};
		
	if($arrSection['visible']){

		$qv=0;
		$q=0;

		foreach($arrSection['childArray']  as $k=>$el){
			if($el[visible])$qv=$qv+1;   
			
			$q=$q+1; 
			;}


		echo '<li>';
		echo '<a  href='.Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $arrSection['name']. '</a>'; 

		
		 
		
			if(!$qv==0){

			echo '<ul>';

			foreach($arrSection['childArray'] as $key =>$children){printSection($children,$cursection);}

			echo '</ul>';

			}else{ if($q>0&&$arrSection['id']==$cursection){
				
				echo '<ul>';

				 
			     foreach($arrSection['childArray'] as $key =>$children){
					 
					 
					 echo '<li>';
					 echo '<a  href='.Url::to(['catalog/index', 'section' => $children['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $children['name']. '</a>'; 
					 echo '</li>';
					 
				 }

			     echo '</ul>';
				
				
			}
				
				
				
				
			}
			
			
			
			
		
		echo '</li>';
	
	}
	
	 
	 
};
				
				
				echo '<ul class="sidebar-menu__root">';


				foreach ($model->arrSectioons as $topSection) {
				printSection($topSection,$model->section);
				};
				
				
				echo '</ul>';
				
				
			?>
	</div>
	<div class="col-xs-12 col-sm-9" >
		<div class="container-fluid">
			<div class="row">
				<?php foreach($model->arrElements as $item) : ?>
					<div class="col-xs-3">
						<div class="product-cart">
							<div class="product-cart__title">
								<span><?=$item['name'];?></span>
							</div>
							<?php $img = ($item['image'] !== 'not') ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg' ?>
							<img class="img-responsive center-block" src="<?=$img;?>" alt="">
							<table class="product-cart__table">
								<thead>
									<tr>
										<td>Цена</td>
										<td><?=$item['price'];?></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Остатки</td>
										<td><?=$item['quantity'];?></td>
									</tr>
								</tbody>
							</table>
							<div class="product-cart__controll clearfix">
								<button class="product-cart__btn-mns">-</button>
								<input type="text" class="product-cart__q-input">
								<button class="product-cart__btn-pls">+</button>
								<button class="product-cart__add-basket">Добавить</button>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>		
</div>

<script>

(function(w){
	w.addEventListener('click', function(e){
		var t = e.target;
		while(t.className !== "basket-control__button clearfix"){
			t = t.parentElement
			if(t.className === "product-cart") return;
		}
		var itemID = Number(t.dataset.id);
		var inputID = "q"+itemID;
		var input = document.getElementById(inputID);
		var quantity = Number(input.value);
		console.log("Number: " + quantity);
		if(quantity === 0 || isNaN(quantity)){
			console.log(quantity);
			console.log("Error");
		}else{
			btn_catalog_add_to_basket(itemID, quantity);
		}
	});
})(window);

function btn_catalog_add_to_basket(id, q) {
	var xhttp = new XMLHttpRequest();
	var dataF = new FormData();
	dataF.append('elementid', id);
	dataF.append('quanty', q);
	xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		console.log("Response text:------------------");
		console.log(this.responseText);
		}
	};
  	xhttp.open("POST", "<?= Url::to(['catalog/addtobasketajax']) ?>", true);
  	xhttp.send(dataF);
}
</script>
