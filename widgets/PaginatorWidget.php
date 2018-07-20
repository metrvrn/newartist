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
    protected $length = 7;

    public function getActiveLinkClass()
    {
        echo $this->activeLinkClass;
    }
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        echo '<div class="pagination__wrapper clearfix">';
            if($this->length < $this->totalPage)
            {
                echo $this->getLong();
            }
            else
            {
                echo $this->getShort();
            }
        echo '</div>';
    }

    protected function getShort()
    {
        $links = "";
        if($this->curPage >= 1)
        {
            $links .= $this->getPrev();
        }
        for($page = 0; $page < $this->totalPage; $page++)
        {
            if($page == $this->curPage){
                $links .= $this->getCurrentLink($page);
                continue;
            }
            $links .= $this->getLink($page);
        }
        if($this->totalPage > $this->curPage)
        {
            $links .= $this->getNext();
        }
        return $links;
    }

    protected function getLong()
    {
        $links = "";
        $length = $this->totalPage > $this->lenth ? $this->length : $this->totalPage;
        if($this->curPage == 0){
            for($page = 0; $page <= $length; $page++){
                $links .= $this->getLink($page);
            }
            $links .= $this->getDotted();
            $links .= $this->getLast();
        }
        if($this->curPage == 1){
            $links .= $this->getPrev();
            //+3
            $links .= $this->getDotted();
            $links .= $this->getLast();
        }
        return $links;
    }

    protected function getMiddle()
    {
        $links = "";
        for($page = $this->curPage - 2; $page < $this->curPage + 3; $page++){
            $links .= $this->getLink($page);
        }
        return $links;
    }

    protected function getPrev()
    {
        return $this->getLink($curPage-1, "<<");
    }
    
    protected function getNext()
    {
        return $this->getLink($curPage+1, ">>");
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
            "<a class=\"%s\" href=\"%s\">%s</a>",
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