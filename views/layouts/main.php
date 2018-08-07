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

AppAsset::register($this);

$watsappNum =  LokalFileModel::getDataByKeyFromLocalfile('watsapp_number');
$viberNum = LokalFileModel::getDataByKeyFromLocalfile('viber_number');
$showViberOrWatsapp = (((bool)$watsappNum) or ((bool)$viberNum));
$isViberWatsappSameNumber = $watsappNum === $viberNum;
$showOnlyViberOrWatsapp = !(((bool) $watsappNum) and ((bool) $viberNum));
//select column type of header info section
if($showViberOrWatsapp){
    if($isViberWatsappSameNumber or $showOnlyViberOrWatsapp){
        $headerInfoColumn = 'col-xs-3';
    }
    else{
        //show viber AND watsupp
        $headerInfoColumn = 'col-xs-5ths';
    }
}else{
    $headerInfoColumn = 'col-xs-4';
}
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
    <div class="header-info">
        <div class="container-fluid">
            <div class="row">
                <div class="<?=$headerInfoColumn?>">
                    <div class="header-info__item">
                        <a class="header-info__link" href="tel:<?=LokalFileModel::getDataByKeyFromLocalfile('local_data_phone')?>">
                            <span class="header-info__icon">
                                <i class="fas fa-phone-square"></i>
                            </span>
                            <span class="header-info__text">
                                <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_phone')?>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="<?=$headerInfoColumn?>">
                    <div class="header-info__item">
                        <a href="<?=Url::to(['site/contact']);?>" target="_blank" class="header-info__link">
                            <span class="header-info__icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </span>
                            <span class="header-info__text" class="ymaps-geolink">
                                <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_adressComppany')?>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="<?=$headerInfoColumn?>">
                    <div class="header-info__item">
                        <a class="header-info__link" href="mailto:<?=LokalFileModel::getDataByKeyFromLocalfile('local_data_email')?>">
                            <span class="header-info__icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <span class="header-info__text">
                                <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_email')?>
                            </span>
                        </a>
                    </div>
                </div>
                <?php if($showViberOrWatsapp) : ?>
                    <?php if($isViberWatsappSameNumber) : ?>
                        <div class="<?=$headerInfoColumn?>">
                            <div class="header-info__item">
                                <a class="header-info__link" href="tel:<?=$watsappNum?>">
                                    <span class="header-info__icon">
                                        <i class="fab fa-viber"></i>
                                        <i class="fab fa-whatsapp"></i>
                                    </span>
                                    <span class="header-info__text">
                                        <?=$watsappNum?>
                                    </span>
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php if($watsappNum) : ?>
                            <div class="<?=$headerInfoColumn?>">
                                <div class="header-info__item">
                                    <a class="header-info__link" href="whatsapp://send?phone=<?=$watsappNum?>">
                                        <span class="header-info__icon">
                                            <i class="fab fa-whatsapp"></i>
                                        </span>
                                        <span class="header-info__text">
                                            <?=$watsappNum?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($viberNum) : ?>
                            <div class="<?=$headerInfoColumn?>">
                                <div class="header-info__item">
                                    <a class="header-info__link" href="viber://add?<?=$viberNum?>">
                                        <span class="header-info__icon">
                                            <i class="fab fa-viber"></i>
                                        </span>
                                        <span class="header-info__text">
                                            <?=$viberNum?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif;?>
                <?php endif; ?>
            </div>
        </div>
    </div>
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
                <div class="col-xs-12">
                    <h3 class="footer-logo">
                        <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?>
                    </h3>
                </div>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>