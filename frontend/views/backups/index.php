<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
        		'value' => 'devicesDevice.device_hostname',
        	],        		
        	[
        		'attribute' => 'jobs_job_id',
        		'value' => 'jobsJob.job_id',
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
