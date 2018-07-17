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
	<div class="col-sm-4">
	 fdfffgrdgefdgasdsdfgsdfdsdfsfgsfg
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


							echo '<li t='.$qv.'>';
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


			echo '<ul>';


			foreach ($model->arrSectioons as $topSection) {
				echo 'df';
				
			printSection($topSection,$model->section);	
			};


			echo '</ul>';


			?>
	</div>
	<div class="col-sm-8" >
		<table class="table-bordered catalog-table">
			<thead>
				<tr>
					<th>Изображение</th>
					<th>Название</th>
					<th>Остатки</th>
					<th>Цена</th>
					<th>В корзину</th>
				</tr>
			</thead>
				<?php foreach($model->arrElements as $item) : ?>
				<tr>
				<td>
					<?php $img = ($item['image'] !== 'not') ? "https://metropt.ru/upload/".$item['image'] : '/images/no-image.jpg' ?>
					<img class="img-responsive center-block" src="<?=$img;?>" alt="">
				</td>
				<td><?=$item['name'];?></td>
				<td><?=$item['id'];?></td>
				<td><?=$item['price'];?></td>
				<td>
					<div class="basket-control clearfix">
						<input id="q<?=$item['id'];?>" data-ov="1" type="text" class="basket-control__input" placeholder="1" value="1">
						<button data-id="<?=$item['id'];?>" class="basket-control__button">Добавить</button>
					</div>
				</td>
				</tr>
				<?php endforeach; ?>
		</table>
	</div>		
</div>

<script>

(function(w){
	w.addEventListener('click', function(e){
		var t = e.target;
		if(t.className === "basket-control__button"){
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
		console.log(this.responseText);
		}
	};
  	xhttp.open("POST", "<?= Url::to(['catalog/addtobasketajax']) ?>", true);
  	xhttp.send(dataF);
}
</script>
