<?php
     
namespace app\models;
     
use Yii;
use yii\base\Model;
use yii\helpers\Url;

class CatalogMenuPresenter{

    public $sArr;
    public $oSecArr;

    public function render()
    {
        echo '<ul>';
		foreach ($this->sArr as $key => $topSection) {
			$this->printSection($topSection);
		};
		echo '</ul>';
    }

    public function printSection($arrSection)
    {
        if (!isset($arrSection['id'])) {
            return;
        };
        $isOpen = ((bool)array_search($arrSection['id'], $this->oSecArr)) ? "catalog-node__close" : "catalog-node__close";
        echo "<li>";
        echo '<a  href=' . Url::to(['catalog/index', 'section' => $arrSection['id'], 'element' => 'non', 'page' => 0, ]) . ' >' . $arrSection['name'] . '</a>'; 
    //echo 'top sections'.$arrSection;
        if (isset($arrSection['childArray']) && count($arrSection['childArray']) > 0) {
            echo "<ul class='$isOpen'>";
            foreach ($arrSection['childArray'] as $andertopsection) {
                    $this->printSection($andertopsection);
            };
            echo '</ul>';
        }
        echo '</li>';
    }
    
}