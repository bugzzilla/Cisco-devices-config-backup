<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Templates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="templates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'template_name')->textInput(['maxlength' => true]) ?>
    <hr>
    <?= $form->field($model, 'cisco_secret')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirm_cisco_secret')->passwordInput(['maxlength' => true]) ?>    
    <hr>
    <?= $form->field($model, 'ssh_username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'ssh_password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirm_ssh_password')->passwordInput(['maxlength' => true]) ?>    
    <?= $form->field($model, 'ssh_port')->textInput() ?>
    <hr>
    <?= $form->field($model, 'device_config')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'storage')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
