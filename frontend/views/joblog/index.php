<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JoblogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joblog-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>    

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
            [
                'attribute' => 'templates_template_id',
                'value' => 'templatesTemplate.template_name',
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
                'template' => "{view}{delete}",
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?></div>
