<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JoblogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="joblog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'job_id') ?>

    <?= $form->field($model, 'templates_template_id') ?>

    <?= $form->field($model, 'job_started') ?>

    <?= $form->field($model, 'job_stopped') ?>

    <?= $form->field($model, 'devices_to_backup') ?>

    <?php // echo $form->field($model, 'devices_per_backup_thread') ?>

    <?php // echo $form->field($model, 'backup_thread_count') ?>

    <?php // echo $form->field($model, 'job_log') ?>

    <?php // echo $form->field($model, 'job_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
