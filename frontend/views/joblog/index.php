<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JoblogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joblog-index">

<?php 
$script = <<< JS
    $('#MultiDeleteButton').click(function(){
		var r = confirm("Are you sure you want to delete these entries ?!");
		if (r == true) {
			var keys = $('#joblog').yiiGridView('getSelectedRows');
			$.post({
           		url: 'index.php?r=joblog/multidel', 
           		dataType: 'json',
           		data: {keylist: keys}
        	});
		}
    });
JS;

$this->registerJs($script);
?>

<p>		
<input type="button" class="btn btn-danger btn-sm" value="Delete selected" id="MultiDeleteButton" >  	</div>
</p>


<?php Pjax::begin(); ?>    

	<?= GridView::widget([
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'options' => ['id' => 'joblog'],			
		'formatter' => [
			'class' => 'yii\\i18n\\Formatter',
			'datetimeFormat' => 'dd MMM y kk:mm:ss',
			'booleanFormat' => ['<span class="glyphicon glyphicon-remove"></span> Unsuccess', '<span class="glyphicon glyphicon-ok"></span> Success']
		],
		'rowOptions' => function ($model) {
			if (!$model->job_status) return ['class' => 'danger'];
			else return ['class' => 'success'];
		},			
		'layout' => "{pager}\n{summary}\n{items}\n{summary}\n{pager}",
        'columns' => [
        	'job_id',
        	['class' => 'yii\grid\CheckboxColumn'],        	
        	[
        		'attribute' => 'templates_template_id',
        		'value' => 'templatesTemplate.template_name',
        		'value' => function ($model) {
        			if ($model->templatesTemplate) return Html::a(Html::encode($model->templatesTemplate->template_name), Url::to(['templates/view', 'id' => $model->templatesTemplate->template_id]));
        		},
        		'format' => 'raw',
        		
        	],        		
			[
				'attribute' => 'job_started',
				'value' => 'job_started',
				'format' => 'datetime',
				'options' => [
					'width' => 200
				],
				'filter' => DatePicker::widget([
					'model' => $searchModel,
    				'attribute' => 'job_started',
    				'pluginOptions' => [
   						'format' => 'dd M yyyy',    						
					    'autoclose' => true, 
					    'todayHighlight' => true
					]
				])	
					
        	],      
        		[
        		'attribute' => 'job_stopped',
        		'value' => 'job_stopped',
        		'format' => 'datetime',
        		'options' => [
        			'width' => 200
       			],        				
        		'filter' => DatePicker::widget([
       				'model' => $searchModel,
       				'attribute' => 'job_stopped',
       				'pluginOptions' => [
    		    		'format' => 'dd M yyyy',
			       		'autoclose' => true,       						
        				'todayHighlight' => true
        			]
        		])
       		],
        	[
        		'attribute' => 'job_status',
        		'value' => 'job_status',
        		'format' => 'boolean',
        		'filter' => array('1' => 'Success', '0' => 'Unsuccess'), 
        	],
            [
            	'class' => 'yii\grid\ActionColumn',
                'template' => "{view}",
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
