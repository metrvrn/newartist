<?php

namespace app\widgets;

use app\models\LokalFileModel;
use yii\helpers\Url;

class HeaderInfo extends \yii\bootstrap\Widget
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
            if(is_array($s['name'])){
                foreach($s['name'] as $name){
                    $data[] = LokalFileModel::getDataByKeyFromLocalfile($name);
                    if(!isset($data) or $data == '' or $data == false) continue;
                }
                $separator = isset($s['separator']) ? isset($s['separator']) : '';
                $data = implode($glue, $data);
            }else{
                $data = LokalFileModel::getDataByKeyFromLocalfile($s['name']);
            }
            if(!isset($data) or $data == '' or $data == false) continue;
            $s['text'] = (string) $data;
            if(isset($s['permanentLink'])){
                $s['link'] = Url::to($s['permanentLink']);
                continue;
            }  
            if(isset($s['linkPrefix'])) $s['link'] = $s['linkPrefix'];
            $s['link'] .= $data;
        }
    }

    public function run()
    {
        $content = '';
        $columnClass = $this->getColumnClass(count($this->sections));
        foreach($this->sections as $s){
            $content .= $this->getColumnWrapper($columnClass, $s['icon'], $s['link'], $s['text']);
        }
        echo $this->getHeaderInfoWrapper($content);
    }

    protected function getIcon($name)
    {
        return $this->$icons[$name];
    }

    protected function getColumnWrapper($columnClass, $icon, $link, $text)
    {
        return <<<WRAPPER
        <div class="$columnClass">
                    <div class="header-info__item">
                        <a class="header-info__link" href="$link">
                            <span class="header-info__icon">
                                $icon
                            </span>
                            <span class="header-info__text">
                                $text
                            </span>
                        </a>
                    </div>
                </div>
WRAPPER;
    }

    protected function getHeaderInfoWrapper($content)
    {
        return <<<HEADERINFO
        <div class="header-info">
            <div class="container-fluid">
                <div class="row">
                    $content
                </div>
            </div>
        </div>
HEADERINFO;
    }

    protected function getColumnClass($count)
    {
        $column  = '';
        switch($count){
            case 1:
                $column = 'col-xs-12';
                break;
            case 2:
                $column = 'col-xs-6';
                break;
            case 3:
                $column = 'col-xs-4';
                break;
            case 4:
                $column = 'col-xs-3';
                break;
            case 5:
                $column = 'col-xs-5ths';
                break;
            case 6:
                $column = 'col-xs-6';
                break;
            default:
                $column = 'col-xs-12';
        }
        return $column;
    }
}