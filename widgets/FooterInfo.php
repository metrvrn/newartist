<?php

namespace app\widgets;

use app\models\LokalFileModel;
use yii\helpers\Url;

class FooterInfo extends \yii\bootstrap\Widget
{

    protected $sections = [
        'phone' => [
            'link' => null,
            'text' => null,
            'name' => 'local_data_phone',
            'icon' => '<i class="fas fa-phone-square"></i>',
            'linkPrefix' => 'tel:'
        ],
        'address' => [
            'link' => null,
            'text' => null,
            'name' => 'local_data_adressComppany',
            'icon' => '<i class="fas fa-map-marked-alt"></i>',
            'permanentLink' => 'site/contact'
        ],
        'email' => [
            'link' => null,
            'text' => null,
            'name' => 'local_data_email',
            'icon' => '<i class="fas fa-envelope"></i>',
            'linkPrefix' => 'mailto:'
        ],
        'watsapp' => [
            'link' => null,
            'text' => null,
            'name' => 'watsapp_number',
            'icon' => '<i class="fab fa-whatsapp"></i>',
            'linkPrefix' => 'whatsapp://send?phone='
        ],
        'viber' => [
            'link' => null,
            'text' => null,
            'name' => 'viber_number',
            'icon' => '<i class="fab fa-viber"></i>',
            'linkPrefix' => 'viber://add?'
        ],
        // 'worktime' => [
        //     'link' => null,
        //     'text' => null,
        //     'name' => ['working_time_workday', 'working_time_saturday', 'working_time_sunday'],
        //     'icon' => '<i class="far fa-clock"></i>',
        //     'glue' => '<br>'
        // ]
    ];

    public function init()
    {
        foreach($this->sections as &$s){
            $data = null;
            // if(is_array($s['name'])){
            //     foreach($s['name'] as $name){
            //         $data[] = LokalFileModel::getDataByKeyFromLocalfile($name);
            //         if(!isset($data) or $data == '' or $data == false) continue;
            //     }
            //     $separator = isset($s['separator']) ? isset($s['separator']) : '';
            //     $data = implode($glue, $data);
            // }else{
            //     $data = LokalFileModel::getDataByKeyFromLocalfile($s['name']);
            // }
            $data = LokalFileModel::getDataByKeyFromLocalfile($s['name']);
            if(!isset($data) or $data == '' or $data == false) continue;
            $s['text'] = (string) $data;
            if(isset($s['permanentLink'])){
                $s['link'] = Url::toRoute($s['permanentLink']);
                continue;
            }  
            if(isset($s['linkPrefix'])) $s['link'] = $s['linkPrefix'];
            $s['link'] .= $data;
        }
    }

    public function run()
    {
        $content = '';
        foreach($this->sections as $s){
            $content .= $this->getItem($s['icon'], $s['link'], $s['text']);
        }
        echo "<ul>$content</ul>";
    }

    protected function getItem($icon, $link, $text)
    {
        return "<li class=\"footer-contacts__element-item\"><span class=\"footer-contacts__icon\">$icon</span><a href=\"$link\">$text</a></li>";
    }
}