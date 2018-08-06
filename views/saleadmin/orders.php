<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
 

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$this->title = 'заказы интернет магазина 6';

$this->params['breadcrumbs'][] = ['label' => 'администратор интернет магазина', 'url' => [Url::to(['saleadmin/index',])]];

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-xs-12"><h1><?= Html::encode($this->title) ?></h1></div>
    
	
	<?		  /* 
				 $intArray['id']=$order->id;
				 $intArray['userid']=$order->userid;
				 $intArray['usersessition']=$order->usersessition;
				 $intArray['summ']=$order->summ; 
				 $intArray['datatime']=$order->datatime;
				 $intArray['md5']=$order->md5;
				  
				$intArray['md5']=$order->md5;
				$intArray['email']=$order->email;
				$intArray['phone']=$order->phone; */
	
	foreach($model->arrayOrders as $orderArray){
		
		echo $orderArray['md5'].'    '.$orderArray['email'].'<br>';
		
	}
	
	
	?>
	
	
	</div>
	
</div>