<?php

namespace app\widgets;

use app\models\CatalogModel;
use yii\helpers\Url;
use yii\base\Widget;
use Yii;

class CatalogMenu extends \yii\bootstrap\Widget
{
    private $model;

    public function __construct()
    {
        $this->model = new CatalogModel();
        $this->model->elementPerPage = 50;
        $this->model->load(Yii::$app->request->get(), '');
        $this->model->fillarrSectioons();
        $this->model->fillTopArrCurSection();
        $this->model->fillElementIdArray();
        $this->model->fillBottomArrCurSection();
        $this->model->fillQuantitypageforqurientsection();
        $this->model->fillarrElements();
        $this->model->fillImageForElementArray();
        $this->model->fillPriceForElementArray();
        $this->model->fillQuantityForElementArray();
        $this->model->setVisibleForCurienSection();
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
            echo '<a href=' . Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . '>';
            if (isset($last) and ($last === 'notlast')) {
                echo '<i class="fas fa-plus icon"></i>';
                echo $cursection;
            }
            echo $arrSection['name'];
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
                        echo '<a  href=' . Url::to(['catalog/index', 'section' => $children['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $children['name'] . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                }
            }
            echo '</li>';
        }
    }
}