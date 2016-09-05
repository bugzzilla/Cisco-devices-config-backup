<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditorInline;

/* @var $this yii\web\View */
/* @var $model frontend\models\Backups */

$this->registerCss("
		ins {color:green;background:#dfd;text-decoration:none}
		del {color:red;background:#fdd;text-decoration:none}
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
				<div id="" style="overflow:scroll; height:400px;">
					<?= str_replace("\n", "<br>", $model->storage) ?>
				</div>
    		</div>
    		<div id="diff" class="tab-pane fade">
    			<br>
				<?= Html::a('DIFF from backup', ['/backups/view', 'id' => $model->diff_from_id], ['class'=>'btn btn-success btn-sm']) ?>   		
				<div id="" style="overflow:scroll; height:400px;">
					<?= str_replace("\n", "<br>", $model->diff); ?>
				</div>
		    </div>
  		</div>
		</div>
	<?php } else { ?>
			<?= Html::label("Storage"); ?> 
			<div class="panel panel-default">
  				<div class="panel-body">
  					<div  style="overflow:scroll; height:400px;">
					<?= str_replace("\n", "<br>", $model->storage); ?>
    				</div>
  				</div>
			</div>	    		
	<?php } ?>
</div>
