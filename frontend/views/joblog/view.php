<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Joblog */

$this->title = 'Job log: ' . $model->job_id;
$this->params['breadcrumbs'][] = ['label' => 'Job logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joblog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->job_id], [
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
            'job_id',
            'templatesTemplate.template_name',      
            'job_started:datetime',
            'job_stopped:datetime',
            'devices_to_backup',
            'devices_per_backup_thread',
            'backup_thread_count',
        	'job_status:boolean',
        	'job_log:ntext',
        ],
    ]) ?>

</div>
