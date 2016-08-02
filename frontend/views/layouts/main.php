<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
 $mainMenuItems = [
        ['label' => '<span class="glyphicon glyphicon-home"></span>', 'url' => ['/site/index']],
        ['label' => 'Backup',
            'items' => [
                ['label' => 'Crontab', 'url' => ['/crontab/show']],
                '<li class="divider"></li>',
                ['label' => 'Templates', 'url' => ['/templates/index']],
                ['label' => 'Logs', 'url' => ['/joblog/index']],
            ],
        ],
        ['label' => 'Devices', 'url' => ['/devices/index']],
        ['label' => 'Storage', 'url' => ['/backups/index']],

    ];
    if (Yii::$app->user->isGuest) {
        $stuffMenuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $stuffMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $stuffMenuItems[] = ['label' => 'Tools',
                            'items' => [
                                ['label' => 'Users managment', 'url' => ['/site/blank']],
                                ['label' => 'Options', 'url' => ['/site/blank']],
                            ],
                            ];
        $stuffMenuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout [' . Yii::$app->user->identity->full_name . ']',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $mainMenuItems,
        'encodeLabels' => false,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $stuffMenuItems,
        'encodeLabels' => false,
    ]);
    
    
    
    NavBar::end();
    ?>

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
<!--        <p class="pull-left">&copy; My Company <?= date('Y') ?></p> -->

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
