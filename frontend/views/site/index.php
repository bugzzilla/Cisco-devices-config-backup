<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You are a happy owner of a mangification backup system for Cisco devices.</p>


    </div>

    <div class="body-content">
<div class="row">
            <div class="col-lg-4">
                <h2>First step</h2>

                <p>Create backup template</p>

                <p><a class="btn btn-default" href="<?php echo Url::toRoute('templates/index')?>">Templates &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Second step</h2>

                <p>Create or import devices, assgn them template</p>

                <p><a class="btn btn-default" href="<?php echo Url::toRoute('devices/index')?>">Devices &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Third step</h2>

                <p>Create schedule to run backup job</p>

                <p><a class="btn btn-default" href="<?php echo Url::toRoute('crontab/show')?>">Crontab &raquo;</a></p>
            </div>
        </div>
    </div>
</div>
