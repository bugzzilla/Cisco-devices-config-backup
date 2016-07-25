<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

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

<?php Pjax::begin(); ?>    
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'rowOptions' => function ($model) {
			if (!$model->backup_status) return ['class' => 'danger'];
			else return ['class' => 'success'];
		},
		'formatter' => [
			'class' => 'yii\\i18n\\Formatter',
			'booleanFormat' => ['<span class="glyphicon glyphicon-remove"></span> Disabled', '<span class="glyphicon glyphicon-ok"></span> Enabled']
		],	
        'layout' => "{pager}\n{summary}\n{items}\n{summary}\n{pager}",
        'columns' => [
            'device_hostname',
            'device_address',
            [
                'attribute' => 'templates_template_id',
                //'value' => 'templatesTemplate.template_name',
				'value' => function ($model) {
	           		return Html::a(Html::encode($model->templatesTemplate->template_name), Url::to(['templates/view', 'id' => $model->templatesTemplate->template_id]));
	            },
                'format' => 'raw',

            ],
        	[
        		'attribute' => 'backup_status',
        		'format' => 'boolean',
        		'filter' => array('1' => 'Enabled', '0' => 'Disabled'),
        	],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
