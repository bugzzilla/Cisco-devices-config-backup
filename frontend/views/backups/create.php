<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Backups */

$this->title = 'Create Backups';
$this->params['breadcrumbs'][] = ['label' => 'Backups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
