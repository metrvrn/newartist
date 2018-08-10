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
    public $view;
    protected $activeLinkClass = "pagination__link";
    protected $disabledLinkClass = "pagination__link pagination__link--disabled";
    protected $currentLinkClass = "pagination__link pagination__link--current";
    protected $length = 10;

    public function getActiveLinkClass()
    {
        echo $this->activeLinkClass;
    }
    public function init()
    {
        parent::init();
        $this->curPage = $this->curPage ?: 0;
        $this->sectionID = is_numeric($this->sectionID) ? $this->sectionID : 'non';
        // printf(
        //     "Current page in paginator class: %d<br>Current sectionID in paginator class: %s<br>Total pages is pagination class%d",
        //     $this->curPage, $this->sectionID, $this->totalPage);
    }

    public function run()
    {
        $links = "";
        for($page = 0; $page < $this->totalPage; $page++) {
            if($this->curPage == $page){
                $links .= $this->getCurrentLink($page);
                continue;
            }
            if($page == 0 or $page == $this->totalPage - 1){
                $links .= $this->getLink($page);
                continue;
            }
            if($page == $this->curPage + 3 or $page == $this->curPage - 3){
                $links .= $this->getDotted();
            }
            if($page > $this->curPage + 2 or $page < $this->curPage - 2) continue;
            $links .= $this->getLink($page);
        }
        echo $this->wrapLinks($links);
    }

    protected function wrapLinks($links)
    {
        return sprintf('<div class="pagination__wrapper clearfix">%s</div>', $links);
    }

    protected function getPrev()
    {
        return $this->getLink($this->curPage-1, "<<");
    }
    
    protected function getNext()
    {
        return $this->getLink($this->curPage+1, ">>");
    }

    protected function getFirst()
    {
        return $this->getLink(0);
    }


    protected function getLast()
    {
        return $this->getLink($this->totalPage);
    }

    protected function getLink($page, $title = null)
    {
        return sprintf(
            "<a class=\"%s\" href=\"%s\">%s</a>",
            $this->activeLinkClass,
            Url::to(['catalog/index/', 'section' => $this->sectionID, 'element' => 'non', 'page' => $page, 'view' => $this->view]),
            is_null($title) ? (string)$page + 1 : (string)$title
        );
    }

    protected function getCurrentLink($page, $title = null)
    {
        return sprintf(
            "<i class=\"%s\">%s</i>",
            $this->currentLinkClass,
            is_null($title) ? (string)$page + 1 : (string)$title
        );
    }

    protected function getDotted()
    {
        return sprintf("<i class=\"%s\">...</i>", $this->disabledLinkClass);
    }
}