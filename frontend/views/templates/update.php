<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Templates */

$this->title = 'Update Template: ' . $model->template_name;
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->template_name, 'url' => ['view', 'id' => $model->template_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="templates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
