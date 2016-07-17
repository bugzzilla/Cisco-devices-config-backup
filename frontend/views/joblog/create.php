<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Joblog */

$this->title = 'Create Joblog';
$this->params['breadcrumbs'][] = ['label' => 'Joblogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="joblog-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
