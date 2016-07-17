<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TemplatesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="templates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'template_id') ?>

    <?= $form->field($model, 'template_name') ?>

    <?= $form->field($model, 'cisco_secret') ?>

    <?= $form->field($model, 'ssh_username') ?>

    <?= $form->field($model, 'ssh_password') ?>

    <?php // echo $form->field($model, 'ssh_port') ?>

    <?php // echo $form->field($model, 'device_config') ?>

    <?php // echo $form->field($model, 'storage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
