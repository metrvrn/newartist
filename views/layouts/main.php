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

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- <div class="site-index-background"></div> -->
<div class="wrapper">
    <?php NavBar::begin([
            'brandLabel' => LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany'),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse',
            ],
        ]);

    $menuItems = [
        ['label' => 'Каталог', 'url' => [$url = Url::to(['catalog/index', ])]],  ////(['catalog/index', 'section' => 'main', 'element'=> 'main'])]],            // $url = Url::to(['post/view', 'id' => 100]);
        //['label' => 'Каталог', 'url' => [$url = Url::to(['catalog/index', 'section' => 'main', 'element'=> 'main' ])]], 
        // ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'О компании', 'url' => ['/site/about']],
        ['label' => 'Контакты ', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
    $menuItems[] = ['label' => 'Заказы', 'url' => [Url::to(['sale/index'])]];
    // $menuItems[] =['label' => 'Корзина', 'url' => [Url::to(['sale/basket'])]];
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
        'Выйти (' . Yii::$app->user->identity->username . ')',
        ['class' => 'btn btn-link logout']
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
    <div class="header-background-wrapper image-responsive">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header-text">
                        <h1 class="text-center"><?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?></h1>
                        <h3 class="text-center">Товары для художников и твочества</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="breadcreambs-wrapper">
                    <?= Breadcrumbs::widget([
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
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p><b>Footer</b></p>
                </div>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>