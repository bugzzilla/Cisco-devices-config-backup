<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Backups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'devices_device_id')->textInput() ?>

    <?= $form->field($model, 'jobs_job_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'config_datetime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storage_datetime')->textInput() ?>

    <?= $form->field($model, 'storage')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
