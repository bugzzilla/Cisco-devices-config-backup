<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CronTab;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplatesController implements the CRUD actions for Templates model.
 */
class CrontabController extends Controller
{

	public function actionShow()
    {
		$model = new CronTab();
		
		if ($model->load(Yii::$app->request->post())) {
			$request = Yii::$app->request->post();
			$model->saveCroneTab($request['CronTab']['crontab']);		
		} else {
			$model->loadCrontab();
		}
		return $this->render('crontabEditor', ['model' => $model]);		
    }

}
