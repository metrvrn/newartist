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
        printf(
            "Current page in paginator class: %d<br>Current sectionID in paginator class: %s<br>Total pages is pagination class%d",
            $this->curPage, $this->sectionID, $this->totalPage);
    }

    public function run()
    {
        $links = "";
        if($this->length < $this->totalPage){
            if($this->curPage < 2){
                if($this->totalPage > $this->length){
                    for($fi = 0; $fi < 3; $fi++){
                        if($this->curPage == $fi){
                            $links .= $this->getCurrentLink($fi);
                            continue;
                        }
                        $links .= $this->getLink($fi);
                    }
                    $links .= $this->getDotted();
                    for($li = ($this->totalPage - 2); $li <= $this->totalPage; $li++){
                        if($this->curPage == $li){
                            $links .= $this->getCurrentLink($li);
                            continue;
                        }
                        $links .= $this->getLink($li);             
                    }
                }
            }
            if($this->curPage >= 2 and $this->curPage <= $this->totalPage - 2){
                if($this->totalPage > $this->length){
                    for($fi = 0; $fi < 3; $fi++){
                        if($this->curPage == $fi){
                            $links .= $this->getCurrentLink($fi);
                            continue;
                        }
                        $links .= $this->getLink($fi);
                    }
                    if($this->curPage == 2){
                        for($mi = $this->curPage + 1; $mi <= $this->curPage + 3; $mi++){
                            if($this->curPage == $mi){
                                $links .= $this->getCurrentLink($mi);
                                continue;
                            }
                            $links .= $this->getLink($mi);     
                        }
                    }
                    elseif($this->curPage == 3){
                        for($mi = $this->curPage; $mi <= $this->curPage + 3; $mi++){
                            if($this->curPage == $mi){
                                $links .= $this->getCurrentLink($mi);
                                continue;
                            }
                            $links .= $this->getLink($mi);     
                        }
                        $links .= $this->getDotted();
                    }
                    elseif($this->curPage == 4){
                        for($mi = $this->curPage - 1; $mi <= $this->curPage + 1; $mi++){
                            if($this->curPage == $mi){
                                $links .= $this->getCurrentLink($mi);
                                continue;
                            }
                            $links .= $this->getLink($mi);     
                        }
                        $links .= $this->getDotted();
                    }
                    elseif($this->curPage == $this->totalPage - 2){
                        $links .= $this->getDotted();
                        for($li = $this->totalPage - 5; $li < $this->totalPage - 2; $li++){
                            if($this->curPage == $li){
                                $links .= $this->getCurrentLink($li);
                                continue;
                            }
                            $links .= $this->getLink($li);             
                        }
                    }
                    elseif($this->curPage == $this->totalPage - 3){
                        $links .= $this->getDotted();
                        for($li = $this->totalPage - 6; $li < $this->totalPage - 3; $li++){
                            if($this->curPage == $li){
                                $links .= $this->getCurrentLink($li);
                                continue;
                            }
                            $links .= $this->getLink($li);             
                        }
                    }
                    else{
                        $links .= $this->getDotted();
                        for($mi = $this->curPage - 1; $mi <= $this->curPage + 1; $mi++){
                            if($this->curPage == $mi){
                                $links .= $this->getCurrentLink($mi);
                                continue;
                            }
                            $links .= $this->getLink($mi);     
                        }
                        $links .= $this->getDotted();
                    }
                    for($li = ($this->totalPage - 2); $li <= $this->totalPage; $li++){
                        if($this->curPage == $li){
                            $links .= $this->getCurrentLink($li);
                            continue;
                        }
                        $links .= $this->getLink($li);             
                    }
                }
            }
            if($this->curPage > $this->totalPage - 2){
                if($this->totalPage > $this->length){
                    for($fi = 0; $fi < 3; $fi++){
                        if($this->curPage == $fi){
                            $links .= $this->getCurrentLink($fi);
                            continue;
                        }
                        $links .= $this->getLink($fi);
                    }
                    $links .= $this->getDotted();
                    for($mi = $this->curPage - 1; $mi <= $this->curPage + 1; $mi++){
                        if($this->curPage == $mi){
                            $links .= $this->getCurrentLink($mi);
                            continue;
                        }
                        $links .= $this->getLink($mi);     
                    }
                }
            }
        }
        else{
            foreach($this->totalPage as $page){
                if($this->curPage == $this->page){
                    $links .= $this->getCurrentLink($page);
                    continue;
                }
                $links .= $this->getLink($page);
            }
        }
        //wrap links into div element
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
            Url::to(['catalog/index/'.$this->sectionID."/non/$page"]),
            is_null($title) ? (string)$page + 1 : (string)$title
        );
    }

    protected function getCurrentLink($page, $title = null)
    {
        return sprintf(
            "<i class=\"%s\" href=\"%s\">%s</i>",
            $this->currentLinkClass,
            Url::to(['catalog/index/'.$this->sectionID."/non/$page"]),
            is_null($title) ? (string)$page + 1 : (string)$title
        );
    }

    protected function getDotted()
    {
        return sprintf("<i class=\"%s\">...</i>", $this->disabledLinkClass);
    }
}