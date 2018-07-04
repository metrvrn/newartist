<?php

/* @var $this yii\web\View */


use yii\helpers\Html;

use yii\helpers\Url;
use app\models\LokalFileModel;

$this->title = 'My Yii Application';
?>
<div class="site-index site-index-background">

    <div class="jumbotron">
        <h1><?= LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?></h1>

        <p class="lead"> <?= LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?> </p> 

         
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                
				     <p>   <a 	href="<?=Url::to(['catalog/index',])?> ">     <h2>КАТАЛОГ </h2>  </a>          </p>
				
            </div>
            <div class="col-lg-6">
                 <p>   <a 	href="<?=Url::to(['site/about',])?> ">     <h2>О КОМПАНИИ </h2>  </a>          </p>

                 

                
            </div>
        
        </div>

    </div>
</div>
