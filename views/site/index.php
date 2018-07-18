<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'Художник';
?>
<div class="div">
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title">Галлерея</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
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
        foreach ($catalogModel->arrSectioons as $topSection) {
        printSection($topSection,$model->section);
        };
        echo '</ul>';
    ?>
    </div>
    <div id="links" class="col-xs-12 col-md-9">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a href="/images/store-image-small/1.jpg">
                        <img class="img-responsive" src="/images/store-image-small/1.jpg" alt="Banana">
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="/images/store-image-small/2.jpg">
                        <img class="img-responsive" src="/images/store-image-small/2.jpg" alt="Banana">
                    </a>
                </div>
            </div>
            <div class="row"><div style="height: 15px;"></div></div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="/images/store-image-small/3.jpg">
                        <img class="img-responsive" src="/images/store-image-small/2.jpg" alt="Banana">
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="/images/store-image-small/4.jpg">
                        <img class="img-responsive" src="/images/store-image-small/4.jpg" alt="Banana">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->registerJsFile("js/blueimp-gallery.min.js", ['position' =>  yii\web\View::POS_END]); ?>
<?php $this->registerJsFile("js/image-galery.js", ['position' =>  yii\web\View::POS_END]); ?>