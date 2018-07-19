<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'О компании';
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
                    }
					
					$last='notlast';
					if($q==0){$last='last';}
					
                echo '<li class="'.$last.'">';
				
				
                echo '<a  href='.Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $arrSection['name']. '</a>'; 			
                   
				    if(!$qv==0){
							echo '<ul>';
							foreach($arrSection['childArray'] as $key =>$children){printSection($children,$cursection);}
							echo '</ul>';
                    }else{ 
							if($q>0&&$arrSection['id']==$cursection){
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
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="about__yandex-map">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af3c0f4ab82bf419e9feb3355744079183b0fe2429eee26d7fb705cb11b48d007&amp;width=100%25&amp;height=618&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</div>
