<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Templates;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="devices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_hostname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'device_address')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'templates_template_id')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Templates::find()->all(), 'template_id', 'template_name'),
			'options' => ['placeholder' => 'Select a template ...'],
			'pluginOptions' => [
				'allowClear' => true
			],
		]);
	?>
    <?= $form->field($model, 'backup_status')->widget(SwitchInput::classname(), [
    		'pluginOptions' => [
				'onText' => 'Enabled',
				'offText' => 'Disabled',
   				'onColor' => 'success',
   				'offColor' => 'danger',  
			]
	    ]);
	?>
	<br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
