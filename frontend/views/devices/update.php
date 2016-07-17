<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Devices */

if ($model->device_hostname) 
	$device_fqdn = $model->device_hostname . ' (' . $model->device_address . ')';
else 
	$device_fqdn = $model->device_address;

$this->title = 'Update Device: '.$device_fqdn;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $device_fqdn, 'url' => ['view', 'id' => $model->device_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="devices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
