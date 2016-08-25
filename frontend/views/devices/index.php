<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DevicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="devices-index">

<?php 
$script = <<< JS
    $('#MultiDeleteButton').click(function(){
		var keys = $('#devices').yiiGridView('getSelectedRows');
		//alert(keys);
		$.post({
           url: 'index.php?r=devices/multidel', 
           dataType: 'json',
           data: {keylist: keys}
        });
    });
JS;

$this->registerJs($script);
?>

<p>
<?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success btn-sm']) ?>&nbsp
<?= Html::a('Import from file', ['import'], ['class' => 'btn btn-success btn-sm']) ?>
</p>
<p>
<input type="button" class="btn btn-danger btn-sm" value="Selected : Delete" id="MultiDeleteButton" >
<input type="button" class="btn btn-warning btn-sm" value="Selected : Change template" id="MultiTemplateButton" >			
<input type="button" class="btn btn-warning btn-sm" value="Selected : Change backup state" id="MultiStateButton" >	
</p>

<?php Pjax::begin(); ?>   


    
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['id' => 'devices'],
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
        		
			['class' => 'yii\grid\CheckboxColumn'],        		
            'device_hostname',
            'device_address',
            [
                'attribute' => 'templates_template_id',
                //'value' => 'templatesTemplate.template_name',
				'value' => function ($model) {
	           		if ($model->templatesTemplate) return Html::a(Html::encode($model->templatesTemplate->template_name), Url::to(['templates/view', 'id' => $model->templatesTemplate->template_id]));
	            },
                'format' => 'raw',

            ],
        	[
        		'attribute' => 'backup_status',
        		'format' => 'boolean',
        		'filter' => array('1' => 'Enabled', '0' => 'Disabled'),
        	],
            ['class' => 'yii\grid\ActionColumn', 
            	'template' => "{view}",
	        ],
        ],
    ]); ?>

<?php Pjax::end(); ?>
</div>
