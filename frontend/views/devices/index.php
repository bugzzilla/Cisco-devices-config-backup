<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DevicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
	
        'layout' => "{pager}\n{summary}\n{items}\n{summary}\n{pager}",
        'columns' => [
            'device_hostname',
            'device_address',
            [
                'attribute' => 'templates_template_id',
                'value' => 'templatesTemplate.template_name',
            ],
        	[
        		'attribute' => 'backup_status',
        		'value' => 'backup_status',
        		'format' => 'boolean',
        		'filter' => array('1' => 'Enabled', '0' => 'Disabled'), 
        	],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>