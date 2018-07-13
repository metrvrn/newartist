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
?>
<?php $this->beginPage() ?>
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

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top',
        ]
    ]);
    $menuItems = [
        ['label' => 'Админ', 'url' => [$url = Url::to(['site/adminsite'])]],
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
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end(); ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>		
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy;   <?= LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany') . date('Y') ?></p>

       
    </div>
	
	<?//echo LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');?>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>