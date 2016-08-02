<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

use yii\widgets\ActiveForm;

$this->title = 'Crontab';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'crontab')->textArea(['rows' => 8]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   
    <?php 
    
    
    	//file_put_contents('/tmp/cron.tmp.txt', '*/15 * * * * php /var/www/html/cisco-backup/backup_core/rub_backup.php 1 10 >> /var/log/cisco_backup.log');

    	//exec('/usr/bin/crontab /tmp/cron.tmp.txt', $resp, $return_var);
    	//print_r($resp);
    	//print_r($return_var);
    	 
    
    	//$a = "echo '*/15 * * * * php /var/www/html/cisco-backup/backup_core/rub_backup.php 1 10 >> /var/log/cisco_backup.log' | crontab -";
    	
    	//exec($a, $resp, $return_var);
    	//print_r($resp);
    	//print_r($return_var);    	
    
    	//exec('crontab -l', $resp, $return_var);
    	//print_r($resp);
    	//print_r($return_var);
    	 
    	
    ?>

</div>
