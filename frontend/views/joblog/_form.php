<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Joblog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="joblog-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'templates_template_id')->textInput() ?>
    <?= $form->field($model, 'job_started')->textInput() ?>
    <?= $form->field($model, 'job_stopped')->textInput() ?>
    <?= $form->field($model, 'devices_to_backup')->textInput() ?>
    <?= $form->field($model, 'devices_per_backup_thread')->textInput() ?>
    <?= $form->field($model, 'backup_thread_count')->textInput() ?>
    <?= $form->field($model, 'job_log')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'job_status')->dropDownList([ 'Success' => 'Success', 'Unsuccess' => 'Unsuccess', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
