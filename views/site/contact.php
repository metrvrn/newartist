<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-3">
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
        foreach ($catalogModel->arrSectioons as $topSection) {
        printSection($topSection,$catalogModel->section);
        };
        echo '</ul>';
    ?>
    </div>
    <div class="col-xs-9">
        <h1><?= Html::encode($this->title)?></h1>
    </div>
</div>