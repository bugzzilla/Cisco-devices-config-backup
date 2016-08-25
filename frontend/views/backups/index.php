<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BackupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Backups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backups-index">

<?php Pjax::begin(); ?>
    
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'formatter' => [
			'class' => 'yii\\i18n\\Formatter',
			'datetimeFormat' => 'dd MMM y kk:mm:ss',
		],
		'layout' => "{pager}\n{summary}\n{items}\n{summary}\n{pager}",

        'columns' => [
        	[
        		'attribute' => 'devices_device_id',
//        		'value' => 'devicesDevice.device_hostname',
        		'value' => function ($model) {
        			if ($model->devicesDevice) return Html::a(Html::encode($model->devicesDevice->getDeviceFullName()), Url::to(['devices/view', 'id' => $model->devicesDevice->device_id]));
        		},
        		'format' => 'raw',
        		
       		],
       		[
	       		'attribute' => 'jobs_job_id',
//    			'value' => 'jobsJob.job_id',
       			'value' => function ($model) {
       				if ($model->jobsJob) return Html::a(Html::encode($model->jobsJob->job_id), Url::to(['joblog/view', 'id' => $model->jobsJob->internal_id]));
	       		},
    	   		'format' => 'raw',
       		],
        	[
        		'attribute' => 'config_datetime',
        		'value' => 'config_datetime',
        		'format' => 'datetime',
        		'options' => [
        			'width' => 200
        		],        			
        		'filter' => DatePicker::widget([
        				'model' => $searchModel,
        				'attribute' => 'config_datetime',
        				'pluginOptions' => [
        						'format' => 'dd M yyyy',
        						'autoclose' => true,
        						'todayHighlight' => true
        				]
        		])
       		],
        	[
        		'attribute' => 'storage_datetime',
        		'value' => 'storage_datetime',
        		'format' => 'datetime',
        		'options' => [
        			'width' => 200
        		],        			
        		'filter' => DatePicker::widget([
        				'model' => $searchModel,
        				'attribute' => 'storage_datetime',
        				'pluginOptions' => [
        						'format' => 'dd M yyyy',
        						'autoclose' => true,
        						'todayHighlight' => true
        				]
        		])
        	],
        	['class' => 'yii\grid\ActionColumn',
        	'template' => "{view}",
        	],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
