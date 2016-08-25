<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Import result';

$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="import-result">

	    <?= DetailView::widget([
        'model' => $model,
	    	'formatter' => [
	    			'class' => 'yii\\i18n\\Formatter',
	    			'nullDisplay' => '<span class="not-set">(not set)</span>',
	    			'dateFormat' => 'medium',
	    			'timeFormat' => 'medium',
	    			'datetimeFormat' => 'medium',
	    			'booleanFormat' => ['<span class="glyphicon glyphicon-remove"></span> Disabled', '<span class="glyphicon glyphicon-ok"></span> Enabled']
	    	],
	    		 
        	'attributes' => [
        			[
        				'attribute' => 'defaultTemplateName',
        				'label' => 'Assigned template',
	    			],
    		        'backupStatus:boolean',
	            	'importedDevices',
        ],
    ]) ?>


</div>