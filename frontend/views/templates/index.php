<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TemplatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Templates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="templates-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Template', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{pager}\n{summary}\n{items}\n{summary}\n{pager}",

        'columns' => [
            'template_name',
//            'cisco_secret',
//            'ssh_username',
//            'ssh_password',
//            'ssh_port',
            'device_config',
            'storage',

            ['class' => 'yii\grid\ActionColumn', 
            		'template' => "{view}",
			],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
