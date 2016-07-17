<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BackupsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="backups-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'backup_id') ?>

    <?= $form->field($model, 'devices_device_id') ?>

    <?= $form->field($model, 'jobs_job_id') ?>

    <?= $form->field($model, 'config_datetime') ?>

    <?= $form->field($model, 'storage_datetime') ?>

    <?php // echo $form->field($model, 'storage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
