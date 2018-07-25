<?php

namespace rahmansoft\apirestlog\controllers;

use Yii;
use rahmansoft\apirestlog\models\ApiLog;
use rahmansoft\apirestlog\models\ApiLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class WslogController extends Controller
{

    /**
     * Lists all ApiLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ApiLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ApiLog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Finds the ApiLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ApiLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ApiLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
