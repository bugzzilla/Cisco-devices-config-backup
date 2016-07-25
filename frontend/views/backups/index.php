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

    <h1><?= Html::encode($this->title) ?></h1>

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
        			if ($model->devicesDevice->device_hostname)
        				$device_fqdn = $model->devicesDevice->device_hostname . ' (' . $model->devicesDevice->device_address . ')';
        			else
        				$device_fqdn = $model->devicesDevice->device_hostname;
        			
        			return Html::a(Html::encode($device_fqdn), Url::to(['devices/view', 'id' => $model->devicesDevice->device_id]));
        		},
        		'format' => 'raw',
        		
       		],
       		[
	       		'attribute' => 'jobs_job_id',
//    			'value' => 'jobsJob.job_id',
       			'value' => function ($model) {
       				return Html::a(Html::encode($model->jobsJob->job_id), Url::to(['joblog/view', 'id' => $model->jobsJob->internal_id]));
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
        	'template' => "{view}{delete}",
        	],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
