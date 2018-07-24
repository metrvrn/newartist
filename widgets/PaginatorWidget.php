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
        $this->curPage = $this->curPage ?: 0;
        $this->sectionID = is_numeric($this->sectionID) ? $this->sectionID : 'non';
       /*  printf(
            "Current page in paginator class: %d<br>Current sectionID in paginator class: %s<br>Total pages is pagination class%d",
            $this->curPage, $this->sectionID, $this->totalPage); */
    }

    public function run()
    {
        $links = "";
        //set previous button if current page < 2
        if($this->curPage >= 1)
        {
            $links .= $this->getPrev();
        }
        //set middle links section
        if($this->length < $this->totalPage)
        {
            $links .= $this->getLong();
        }
        else
        {
            $links .= $this->getShort();
        }
        //set net button if current page < last page
        if($this->totalPage > $this->curPage)
        {
            $links .= $this->getNext();
        }
        //wrap links into div element
        $pagination = $this->wrapLinks($links);
        echo $pagination;
    }

    protected function getShort()
    {
        $links = "";
        for($page = 0; $page < $this->totalPage; $page++)
        {
            if($page == $this->curPage){ $links .= $this->getCurrentLink($page);
                continue;
            }
            $links .= $this->getLink($page);
        }
       return $links;
    }

    protected function getLong()
    {
        $links = "";
        if($this->curPage == 0){
            for($page = $this->curPage; $page < $this->length - 2; $page++)
            {
                if($page == $this->curPage)
                {
                    $links .= $this->getCurrentLink($page);
                    continue;
                }
                $links .= $this->getLink($page);
            }
            $links .= $this->getDotted();
            $links .= $this->getLast();
        }
        if($this->curPage == 1){
            for($page = $this->curPage - 1; $page < $this->length - 2; $page++)
            {
                if($page == $this->curPage)
                {
                    $links .= $this->getCurrentLink($page);
                    continue;
                }
                $links .= $this->getLink($page);
            }
            $links .= $this->getDotted();
            $links .= $this->getLast();
        }
        if($this->totalPage - $this->curPage == 0)
        {
            $links .= $this->getFirst();
            $links .= $this->getDotted();
            for($page = $this->totalPage - $this->length + 3; $page <= $this->totalPage; $page++)
            {
                if($page == $this->curPage)
                {
                    $links .= $this->getCurrentLink($page);
                    continue;
                }
                $links .= $this->getLink($page);
            }
        }
        if($this->totalPage - $this->curPage == 1)
        {
            $links .= $this->getFirst();
            $links .= $this->getDotted();
            for($page = $this->totalPage - $this->length + 4; $page <= $this->totalPage - 1; $page++)
            {
                if($page == $this->curPage)
                {
                    $links .= $this->getCurrentLink($page);
                    continue;
                }
                $links .= $this->getLink($page);
            }
            $links .= $this->getLast();
        }
        if($this->curPage >= 2 and $this->curPage < $this->totalPage - 1)
        {
            $links .= $this->getFirst();
            $links .= $this->getDotted();
            $links .= $this->getMiddle();
            $links .= $this->getDotted();
            $links .= $this->getLast();
            echo "MIddle";
        }
        if($this->curPage >= 2 and $this->curPage < $this->totalPage - 3)
        {
            $links .= $this->getFirst();
            $links .= $this->getDotted();
            $links .= $this->getMiddle();
            $links .= $this->getLast();
        }
        return $links;
    }

    protected function getMiddle()
    {
        $links = "";
        for($page = $this->curPage - 1; $page < $this->curPage + 2; $page++){
            if($page == $this->curPage)
            {
                $links .= $this->getCurrentLink($page);
                continue;
            }
            $links .= $this->getLink($page);
        }
        return $links;
    }

    protected function wrapLinks($links)
    {
        return sprintf('<div class="pagination__wrapper">%s</div>', $links);
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