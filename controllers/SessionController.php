<?php

namespace app\controllers;

use app\models\Session;
use app\models\SessionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Sessionhassensor;
use app\models\Sensor;
use app\models\Sample;
use yii\filters\AccessControl;

/**
 * SessionController implements the CRUD actions for Session model.
 */
class SessionController extends Controller
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

                'access'=>[
                    'class' => AccessControl::className(),
                    'only' => ['index','view','create','update','delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index','view','create','update','delete'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['index'],
                            'roles' => ['?'],
                        ],
                    ],
                ],
                
            ]
        );
    }

    /**
     * Lists all Session models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SessionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Session model.
     * @param int $idSession Id Session
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idSession)
    {
        return $this->render('view', [
            'model' => $this->findModel($idSession),
        ]);
    }

    /**
     * Creates a new Session model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Session();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idSession' => $model->idSession]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Session model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idSession Id Session
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idSession)
    {
        $model = $this->findModel($idSession);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idSession' => $model->idSession]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Session model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idSession Id Session
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idSession)
    {
        $this->findModel($idSession)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Session model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idSession Id Session
     * @return Session the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idSession)
    {
        if (($model = Session::findOne(['idSession' => $idSession])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //http://localhost:8080/session/find-one-sensor?idSession=3
    public function actionFindOneSensor($idSession)
    {
        $oneSensor=Sessionhassensor::find()->where(['idSession'=>$idSession])->one();
        
        $idOfSensor=$oneSensor->idSensor;
        $sensorInformation=Sensor::find()->where(['idSensor'=>$idOfSensor])->one()->toArray();
        
        return $this->render('findonesensor',['data'=>json_encode($sensorInformation)]);
    }

    //http://localhost:8080/session/find-one-sensor-sql?idSession=3
    public function actionFindOneSensorSql($idSession)
    {
       $oneSensor = (new \yii\db\Query())->select('idSensor')->from('sessionhassensor')->where(['idSession'=>$idSession])->one();
       $sensorInformation=(new \yii\db\Query())->select('idSensor, idDevice, idSensor_Type, name')->from('sensor')->where(['idSensor'=>$oneSensor])->one();
       return $this->render('findonesensorsql',['data'=>json_encode($sensorInformation)]);
    }


    //ponizsza funkcje wywolaj w nastepujacy sposob
    //http://localhost:8080/session/find-all-samples-sql?idSession=12
    public function actionFindAllSamplesSql($idSession)
    {
        //tworzenie polaczenia
        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=sensor',
            'username' => 'root',
            'password' => '',
        ]);
        $tab=12;
        $connection->open();

        //wyciaganie id sensora dla podanego id sesji
        $requestSql='SELECT idSensor FROM sessionhassensor where idSession=:idSession';
        $command = $connection->createCommand($requestSql);
        $command->bindValue(':idSession', $_GET['idSession']);
        $commandResult=$command->queryAll();

        $idSensorForGivenIdSession=$commandResult[0]["idSensor"];

        //wyciaganie probek dla podanego id sensora, tj.  $idSensorForGivenIdSession
        $requestSql='SELECT idSample, idSensor,value_1,value_2,value_3,timestamp FROM sample where idSensor=:idSensor';
        $command = $connection->createCommand($requestSql);
        $command->bindValue(':idSensor', $idSensorForGivenIdSession);
        $listOfSamples=$command->queryAll();

        $requestSql = 'SELECT tp, start, samples FROM session where idSession=:idSession';
        $command = $connection->createCommand($requestSql);
        $command->bindValue(':idSession', $_GET['idSession']);
        $commandResult=$command->queryAll();

        $startTime=strtotime($commandResult[0]["start"])*1000 + ((int)(explode(".",$commandResult[0]["start"])[1]))/1000;

        $a=array();
        foreach ($listOfSamples as &$oneSample)
        {
            $oneSampleTimestamp = strtotime($oneSample["timestamp"])*1000 + ((int)(explode(".",$oneSample["timestamp"])[1]))/1000; // 
            if(($oneSampleTimestamp-$startTime) == 0 )
            {
                array_push($a, $oneSample);
                $startTime = $startTime + (int) $commandResult[0]["tp"];
            }
        }
        return $this->render('findallsamplessql',['data'=>json_encode(array_slice($a,0,$commandResult[0]["samples"]))]);
    }
}
