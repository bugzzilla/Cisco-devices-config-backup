<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Joblog;
use frontend\models\JoblogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JoblogController implements the CRUD actions for Joblog model.
 */
class JoblogController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Joblog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JoblogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Joblog model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing Joblog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMultidel()
    {
    	if (isset($_POST['keylist'])) {
    		$keys = $_POST['keylist'];
    		if (is_array($keys)) {
    			for ($i = 0; $i < count($keys); $i++) {
    				$this->findModel($keys[$i])->delete();
    			}
    			return $this->redirect(['index']);
    		}
    		//file_put_contents('/tmp/12.txt', print_r($keys,true));
    	}
    }    
    /**
     * Finds the Joblog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Joblog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Joblog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
