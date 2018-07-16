<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'заказы';
?>
<div class="div">

<div class="row">
    <div class="col-xs-12 col-md-3">
	
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


				foreach ($catalogModel->arrSectioons as $topSection) {
				printSection($topSection,$catalogModel->section);
				};
				
				
				echo '</ul>';
				
				
			?>
	
     
    </div>
    <div id="links" class="col-xs-12 col-md-9">
        
		
		<?foreach($model->arrOrdersForCurientUser as $order){
			
			
			
			echo '<div>';
			echo 'заказ номер '.$order['id'].'  сумма '.$order['summ'].'<br>';
			echo '</div>';
			
			
			
			
			
		}?>
		
		
    </div>
</div>
</div>
