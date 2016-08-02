<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Templates;
use frontend\models\TemplatesSearch;
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
        return $this->render('crontab');
    }

}
