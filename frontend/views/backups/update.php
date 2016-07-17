<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Backups */

$this->title = 'Update Backups: ' . $model->backup_id;
$this->params['breadcrumbs'][] = ['label' => 'Backups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->backup_id, 'url' => ['view', 'id' => $model->backup_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="backups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
