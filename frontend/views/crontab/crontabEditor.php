<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use yii\widgets\ActiveForm;

$this->title = 'Crontab';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cron-editor">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'crontab')->textArea(['rows' => 8]) ?>

	<?php 
		if ($model->cron_result) {
			echo $this->render('cron_result', ['model' => $model]);
		}
	?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   
</div>
