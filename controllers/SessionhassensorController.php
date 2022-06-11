<?php

namespace app\controllers;

use app\models\Sessionhassensor;
use app\models\SessionhassensorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SessionhassensorController implements the CRUD actions for Sessionhassensor model.
 */
class SessionhassensorController extends Controller
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
     * Lists all Sessionhassensor models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SessionhassensorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sessionhassensor model.
     * @param int $idSession Id Session
     * @param int $idSensor Id Sensor
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idSession, $idSensor)
    {
        return $this->render('view', [
            'model' => $this->findModel($idSession, $idSensor),
        ]);
    }

    /**
     * Creates a new Sessionhassensor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Sessionhassensor();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idSession' => $model->idSession, 'idSensor' => $model->idSensor]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sessionhassensor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idSession Id Session
     * @param int $idSensor Id Sensor
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idSession, $idSensor)
    {
        $model = $this->findModel($idSession, $idSensor);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idSession' => $model->idSession, 'idSensor' => $model->idSensor]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sessionhassensor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idSession Id Session
     * @param int $idSensor Id Sensor
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idSession, $idSensor)
    {
        $this->findModel($idSession, $idSensor)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sessionhassensor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idSession Id Session
     * @param int $idSensor Id Sensor
     * @return Sessionhassensor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idSession, $idSensor)
    {
        if (($model = Sessionhassensor::findOne(['idSession' => $idSession, 'idSensor' => $idSensor])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
