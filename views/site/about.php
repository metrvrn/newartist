<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\CatalogMenu;

$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div class="col-xs-12 col-md-9">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="about__yandex-map">
            <script id="yandeMap" type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af3c0f4ab82bf419e9feb3355744079183b0fe2429eee26d7fb705cb11b48d007&amp;width=100%25&amp;height=618&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</div>
<div id="spinner" class="spinner closed">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<?php $this->registerJsFile("/js/about.js"); ?>