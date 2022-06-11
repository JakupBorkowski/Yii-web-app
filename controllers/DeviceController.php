<?php

namespace app\controllers;

use app\models\Device;
use app\models\DeviceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeviceController implements the CRUD actions for Device model.
 */
class DeviceController extends Controller
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
     * Lists all Device models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DeviceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Device model.
     * @param int $idDevice Id Device
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idDevice)
    {
        return $this->render('view', [
            'model' => $this->findModel($idDevice),
        ]);
    }

    /**
     * Creates a new Device model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Device();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idDevice' => $model->idDevice]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Device model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idDevice Id Device
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idDevice)
    {
        $model = $this->findModel($idDevice);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idDevice' => $model->idDevice]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Device model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idDevice Id Device
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idDevice)
    {
        $this->findModel($idDevice)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Device model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idDevice Id Device
     * @return Device the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idDevice)
    {
        if (($model = Device::findOne(['idDevice' => $idDevice])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
