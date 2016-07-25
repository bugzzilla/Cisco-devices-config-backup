<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devices */

$this->title = 'Update Device: '.$model->getDeviceFullName();
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getDeviceFullName(), 'url' => ['view', 'id' => $model->device_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
