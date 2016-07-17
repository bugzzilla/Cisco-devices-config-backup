<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Joblog */

$this->title = 'Update Joblog: ' . $model->job_id;
$this->params['breadcrumbs'][] = ['label' => 'Joblogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->job_id, 'url' => ['view', 'id' => $model->job_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="joblog-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
