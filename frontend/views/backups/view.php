<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Backups */

if ($model->devicesDevice) {
	$device_fqdn = $model->devicesDevice->getDeviceFullName();

} else $device_fqdn = null;	

$this->title = 'Backup for: '. $device_fqdn;
$this->params['breadcrumbs'][] = ['label' => 'Backups', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Backup for: '. $device_fqdn;
?>
<div class="backups-view">

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->backup_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
    		'formatter' => [
    				'class' => 'yii\\i18n\\Formatter',
    				'nullDisplay' => '<span class="not-set">(not set)</span>',
    				'dateFormat' => 'medium',
    				'timeFormat' => 'medium',
    				'datetimeFormat' => 'medium',
    				'booleanFormat' => ['<span class="glyphicon glyphicon-remove"></span> Unsuccess', '<span class="glyphicon glyphicon-ok"></span> Success']
    		],    		
        	'attributes' => [
            'backup_id',
        	[
        		'label' => 'Device',
        		'value' => $device_fqdn,        			
        		'format' => 'raw',
        		
       		],
            'jobsJob.job_id',
            'config_datetime:datetime',
            'storage_datetime:datetime',
            'storage:ntext',
        ],
    ]) ?>

</div>
