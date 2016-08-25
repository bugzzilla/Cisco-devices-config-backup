<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use kartik\file\FileInput;

$this->title = 'Import devices from CSV';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="import-csv">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'importFile')->widget(FileInput::classname(), [
    		'model' => $model,
    		'attribute' => 'importFile',
    		'pluginOptions' => [
    				'multiple' => false,
    				'browseClass' => 'btn btn-success',
    				'uploadClass' => 'btn btn-info',
    				'removeClass' => 'btn btn-danger'
    			]
    ]) ?>
    
<?php ActiveForm::end() ?>

</div>