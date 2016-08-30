<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Backups */

$this->registerCss("
		ins {color:green;background:#dfd;text-decoration:none}
		del {color:red;background:#fdd;text-decoration:none}
		#params {margin:1em 0;font: 14px sans-serif}
		.panecontainer > p {margin:0;border:1px solid #bcd;border-bottom:none;padding:1px 3px;background:#def;font:14px sans-serif}
		.panecontainer > p + div {margin:0;padding:2px 0 2px 2px;border:1px solid #bcd;border-top:none}
		.pane {margin:0;padding:0;border:0;width:100%;min-height:20em;overflow:auto;font:12px monospace}
		#htmldiff {color:gray}
		#htmldiff.onlyDeletions ins {display:none}
		#htmldiff.onlyInsertions del {display:none}
		");


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
            'storage_datetime:datetime'
			
        ],
    		
    ]) ?>

  	<?php $form = ActiveForm::begin(); ?>
  	
    <?php 
    	if ($model->diff_from_id > 0) { 
    ?>
		<div class="container">
  
  		<ul class="nav nav-tabs">
    		<li class="active"><a data-toggle="tab" href="#storage">Storage</a></li>
    		<li><a data-toggle="tab" href="#diff">DIFF</a></li>
  		</ul>

		  <div class="tab-content">
		    <div id="storage" class="tab-pane fade in active">
				<?= $form->field($model, 'storage')->textArea(['rows' => 16, 'readonly' => true])->label(false) ?>
    		</div>
    		<div id="diff" class="tab-pane fade">
					<?php echo Html::decode($model->diff); ?>	
		    </div>
  		</div>
		</div>

	<?php 
    	} else {
	?>
    	<?= $form->field($model, 'storage')->textArea(['rows' => 16, 'readonly' => true]) ?>
    <?php 
    	}
    ?>
    

	<?php ActiveForm::end(); ?>
</div>
