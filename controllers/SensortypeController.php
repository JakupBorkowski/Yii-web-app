<?php

namespace app\controllers;

use app\models\Sensortype;
use app\models\SensortypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SensortypeController implements the CRUD actions for Sensortype model.
 */
class SensortypeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Sensortype models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SensortypeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sensortype model.
     * @param int $idSensor_Type Id Sensor Type
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idSensor_Type)
    {
        return $this->render('view', [
            'model' => $this->findModel($idSensor_Type),
        ]);
    }

    /**
     * Creates a new Sensortype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Sensortype();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idSensor_Type' => $model->idSensor_Type]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sensortype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idSensor_Type Id Sensor Type
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idSensor_Type)
    {
        $model = $this->findModel($idSensor_Type);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idSensor_Type' => $model->idSensor_Type]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sensortype model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idSensor_Type Id Sensor Type
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idSensor_Type)
    {
        $this->findModel($idSensor_Type)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sensortype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idSensor_Type Id Sensor Type
     * @return Sensortype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idSensor_Type)
    {
        if (($model = Sensortype::findOne(['idSensor_Type' => $idSensor_Type])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
