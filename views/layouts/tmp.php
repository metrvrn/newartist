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
<div class="site-index-background"></div> 
<?php $this->beginBody() ?>
    <?php NavBar::begin([
        'brandImage' => '/images/header-logo.png'
    ]);
    $menuItems = [
        ['label' => 'Каталог', 'url' => [$url = Url::to(['catalog/index', ])]],  ////(['catalog/index', 'section' => 'main', 'element'=> 'main'])]],            // $url = Url::to(['post/view', 'id' => 100]);
        //['label' => 'Каталог', 'url' => [$url = Url::to(['catalog/index', 'section' => 'main', 'element'=> 'main' ])]], 
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'О компании', 'url' => ['/site/about']],
        ['label' => 'Контакты ', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Заказы', 'url' => [Url::to(['site/zakaz'])]];
    // $menuItems[] =['label' => 'Корзина', 'url' => [Url::to(['site/basket'])]];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
            'Выйти (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
            . Html::endForm()
            . '</li>';
    };
    $menuItems[] = ['label' => 'Корзина', 'url' => [Url::to(['site/basket'])]];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav bg-warning col'],
        'items' => $menuItems,
    ]);
    NavBar::end(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?= $content ?>
            </div>	
        </div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


