<?php
/* @var $this \yii\web\View */
/* @var $content string */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\HeaderInfo;
use app\widgets\FooterInfo;

AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="<?=LokalFileModel::getDataByKeyFromLocalfile('local_data_yandexMeta')?>"/>
    <?= Html::csrfMetaTags() ?>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&load=Geolink" type="text/javascript"></script>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper">
    <?=HeaderInfo::widget()?>
    <div class="header-background-wrapper image-responsive">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header-text">
                        <h1 class="header-title"><?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?></h1>
                        <h3 class="header-description"><span><?=LokalFileModel::getDataByKeyFromLocalfile('local_data_titleName')?></span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php NavBar::begin([
            'brandLabel' => LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany'),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => ''
            ],
            'innerContainerOptions' => [
                'class' => 'container-fluid'
            ]
        ]);

    $menuItems = [
        ['label' => 'Каталог', 'url' => [$url = Url::to(['catalog/index', ])]],
        ['label' => 'Контакты ', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
    $menuItems[] = ['label' => 'Заказы', 'url' => [Url::to(['sale/index'])]];
	$menuItems[] = ['label' => 'Профиль', 'url' => [Url::to(['site/profile'])]];
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
        'Выйти (' . Yii::$app->user->identity->username . ')',
        ['class' => 'btn btn-link logout header-logout-btn']
    )
        . Html::endForm()
        . '</li>';
    };
    $menuItems[] = ['label' => 'Корзина', 'url' => [Url::to(['sale/basket'])]];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="breadcreambs-wrapper">
                    <?= Breadcrumbs::widget([
                            'homeLink' => ['label' => LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany'),  // required
                                            'url' => Yii::$app->homeUrl,
                    ],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    <?= Alert::widget() ?>
                </div>
            </div>
        </div>
        <?= $content ?>
        </div>
</div>
<footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <h3 class="footer-logo">
                        <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?>
                    </h3>
                </div>
                <div class="col-xs-6 col-md-3">
                    <h4>Меню:</h4>
                        <ul>
                            <li><a href="<?=Url::to(['/catalog/index'])?>">Каталог</a></li>
                            <li><a href="<?=Url::to(['/site/contact'])?>">Контакты</a></li>
                            <?php if(Yii::$app->user->isGuest) : ?>
                                <li><a href="<?=Url::to('/site/signup')?>">Регистрация</a></li>
                                <li><a href="<?=Url::to('/site/login')?>">Войти</a></li>
                            <?php else : ?>
                                <li>
                                    <a href="<?=Url::to('/sale/index')?>">Заказы</a>
                                </li>
                                <li><a href="<?=Url::to('/site/profile')?>">Профиль</a></li>
                                <li>
                                    <?=Html::beginForm(Url::to('/site/logout'), 'post')?>
                                        <input class="footer-logout-btn" type="submit" value="Выйти(<?=Yii::$app->user->identity->username?>)">
                                    <?=Html::endForm() ?>
                                </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?=Url::to('/sale/basket')?>">Корзина</a>
                            </li>
                        </ul>
                </div>
                <div class="col-xs-6 col-md-3">
                    <h4>Контакты:</h4>
                        <?=FooterInfo::widget();?>
                </div>
                <div class="col-xs-6 col-md-3">
                    <?php
                        $workday = LokalFileModel::getDataByKeyFromLocalfile('working_time_workday');
                        $saturday = LokalFileModel::getDataByKeyFromLocalfile('working_time_saturday');
                        $sunday = LokalFileModel::getDataByKeyFromLocalfile('working_time_sunday');
                    ?>
                    <?php if($workday or $saturday or $sunday) :?>
                        <h4>Время работы:</h4>
                            <ul>
                                <?=$workday ? "<li>Пн-Пт: $workday</li>" : false?>
                                <?=$saturday ? "<li>Сб: $saturday</li>" : false?>
                                <?=$sunday ? "<li>Вс: $workday</li>" : false?>
                            </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>