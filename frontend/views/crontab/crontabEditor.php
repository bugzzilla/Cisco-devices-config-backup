<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use yii\widgets\ActiveForm;

$this->title = 'Crontab';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'crontab')->textArea(['rows' => 8]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   
</div>
