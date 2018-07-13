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
	<div class="col-xs-12 col-md-3">
			<?php
				
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
	<div class="col-xs-12 col-md-9" >
		<div class="container-fluid">
			<div class="row">
				<?php foreach($model->arrElements as $item) : ?>
					<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
						<div class="product-cart">
							<div class="product-cart__title">
								<span><?=$item['name'];?></span>
							</div>
							<div data-full="<?=$item['imaged'];?>" class="product-cart__magnifier">
								<i class="fas fa-search-plus"></i>
							</div>
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

<script>
//detect action
(function(w){
	w.addEventListener("click", function(e){
		var target = e.target;
		var inSearch = true;
		var counterUpper = 0;
		while(inSearch){
			className = target.className;
			switch (className){
				case "product-cart__btn-mns":
					minusBtn(target);
					inSearch = false;
					break;
				case  "product-cart__btn-pls":
					plusBtn(target);
					inSearch = false;
					break;
				case "product-cart__add-basket":
					addBasket(target);
					inSearch = false;
					break;
				case "product-cart__magnifier":
					showDetailImage(target);
					inSearch = false;
					break;
				case "product-cart__controll clearfix" || "product-cart__q-input":
					inSearch = false;
					return;
					break;
				default:
					counterUpper++;
					if(counterUpper > 3) inSearch = false;
					target = target.parentElement;
			}
		}
	});
	w.addEventListener('input', function(e){
		handleInput(e.target);
	});
})(window)

function showDetailImage(srcElem)
{	
	console.log(srcElem.dataset.full);
}
//return product id by control element
function getElementID(controlElem)
{
	return Number(controlElem.parentElement.id);
}
//return input element by control element
function getInput(controlElem)
{
	var id = getElementID(controlElem);
	inputID = "input-"+id;
	return document.getElementById(inputID);
}
//handle plus button
function plusBtn(controlElem)
{
	input = getInput(controlElem);
	var newVal = Number(input.value) + 1;
	if(Number(input.dataset.available) < Number(newVal)){
		return;
	}
	input.value++;
}
//handle minus button
function minusBtn(controlElem)
{
	input = getInput(controlElem);
	if(Number(input.value) === 1){
		return;
	}
	input.value--;
}
//validate 
function handleInput(input)
{
	var newVal = Number(input.value);
	var available = Number(input.dataset.available);
	var oldVal = Number(input.dataset.old);
	if(newVal == NaN){
		input.value = oldValue;
	}else if(newVal < 1){
		input.value = 1;
	}else if(newVal > available){
		input.value = available;
	}else{
		input.value = newVal;
	}
}

function addBasket(controlElem)
{
	var id = Number(getElementID(controlElem));
	var q = Number(getInput(controlElem).value);
	btn_catalog_add_to_basket(id, q)
}

function btn_catalog_add_to_basket(id, q)
{
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
