<?php

namespace app\widgets;

use app\models\CatalogModel;
use yii\helpers\Url;
use yii\base\Widget;
use Yii;

class CatalogMenu extends \yii\bootstrap\Widget
{
    public $model;

    public function init()
    {
        if(!isset($this->model)){
            throw new \Exception("Model not loaded on CatalogMenu widget");
        }
    }

    public function run()
    {
        echo '<ul class="sidebar-menu__root">';
        foreach ($this->model->arrSectioons as $topSection) {
            $this->printSection($topSection, $model->section);
        };
        echo '</ul>';
    }

    private function printSection($arrSection, $cursection)
    {
        if (!isset($arrSection['id'])) {
            return;
        };
        if ($arrSection['visible']) {
            $qv = 0;
            $q = 0;
            foreach ($arrSection['childArray'] as $k => $el) {
                if ($el[visible]) $qv = $qv + 1;
                $q = $q + 1;
            }
            $last = 'notlast';
            if ($q == 0) {
                $last = 'last';
            }

            echo '<li class="' . $last . '">';
            echo '<a class="catalog-menu__link clearfix" href=' . Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, 'view' => $this->model->view]) . '>';
            if (isset($last) and ($last === 'notlast')) {
                echo '<div class="catalog-menu__icon"><i class="fas fa-plus icon"></i></div>';
            }
            echo '<div class="catalog-menu__name">'.$arrSection['name'].'</div>';
            echo '</a>';
            if (!$qv == 0) {
                echo '<ul>';
                foreach ($arrSection['childArray'] as $key => $children) {
                    $this->printSection($children, $cursection);
                }
                echo '</ul>';
            } else {
                if ($q > 0 && $arrSection['id'] == $cursection) {
                    echo '<ul>';
                    foreach ($arrSection['childArray'] as $key => $children) {
                        echo '<li>';
                        echo '<a  href=' . Url::to(['catalog/index', 'section' => $children['id'], 'element' => 'non', 'page' => 0, 'view' => $this->model->view]) . ' >' . $children['name'] . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            }
            echo '</li>';
        }
    }
}