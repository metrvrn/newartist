<?php

namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Url;

class PaginatorWidget extends Widget
{
    //items per page
    public $perPage;
    //current page
    public $curPage;
    //total page in current section
    public $totalPage;
    //current section id for url
    public $sectionID;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if(!isset($this->totalPage) or ( ((int)$this->totalPage) <= 0)) return "";
        if((int)$this->totalPage == 1) return "";
        echo '<div class="pagination__wrapper clearfix">';
        for($i = 0; $i < (int)$this->totalPage; $i++){
            if($i == $this->curPage){
                echo '<i class="pagination__link pagination__link--active">'.($i+1).'</i>';
                continue;
            }
            echo '<a class="pagination__link" href='.Url::to(['catalog/index/'.$this->sectionID."/non/$i"]).'>'.($i+1).'</a>';
        }
        echo '</div>';
    }
}