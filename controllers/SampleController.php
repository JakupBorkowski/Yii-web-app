<?php

namespace app\controllers;

use app\models\Sample;
use app\models\SampleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SampleController implements the CRUD actions for Sample model.
 */
class SampleController extends Controller
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
     * Lists all Sample models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SampleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sample model.
     * @param int $idSample Id Sample
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idSample)
    {
        return $this->render('view', [
            'model' => $this->findModel($idSample),
        ]);
    }

    /**
     * Creates a new Sample model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Sample();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idSample' => $model->idSample]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sample model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idSample Id Sample
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idSample)
    {
        $model = $this->findModel($idSample);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idSample' => $model->idSample]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Sample model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idSample Id Sample
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idSample)
    {
        $this->findModel($idSample)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sample model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idSample Id Sample
     * @return Sample the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idSample)
    {
        if (($model = Sample::findOne(['idSample' => $idSample])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
