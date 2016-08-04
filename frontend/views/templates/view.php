<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Templates */

$this->title = 'Template: ' . $model->template_name;
$this->params['breadcrumbs'][] = ['label' => 'Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php 
	file_put_contents('/tmp/template-view-'.$model->template_id.'.txt', print_r($slaves,true));

?>


<div class="templates-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->template_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->template_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'template_id',
            'template_name',
            'cisco_secret',
            'ssh_username',
            'ssh_password',
            'ssh_port',
            'device_config',
            'storage',
        ],
    ]) ?>

</div>
