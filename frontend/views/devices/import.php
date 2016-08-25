<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use frontend\models\Templates;


$this->title = 'Import devices from file';
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="import-file">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'importFile')->widget(FileInput::classname(), [
    		'pluginOptions' => [
    				'showUpload' => false,
    			]
    ]) ?>

	<?= $form->field($model, 'defaultTemplate')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Templates::find()->all(), 'template_id', 'template_name'),
			'options' => ['placeholder' => 'Select a template ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);
	?>
	
    <?= $form->field($model, 'backupStatus')->widget(SwitchInput::classname(), [
    		'pluginOptions' => [
				'onText' => 'Enabled',
				'offText' => 'Disabled',
   				'onColor' => 'success',
   				'offColor' => 'danger',  
			]
	    ]);
	?>	
	
    <div class="form-group">
    	<br>
        <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
    </div>
    
<?php ActiveForm::end() ?>

</div>