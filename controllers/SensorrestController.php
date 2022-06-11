<?php

namespace app\controllers;
use yii\rest\ActiveController;
use app\models\Sensor;

class SensorrestController extends ActiveController
{
    public $modelClass ='app\models\Sensor';

    public function behaviors()
    {

        return [

            [

                'class' => \yii\filters\ContentNegotiator::className(),

                'only' => ['index', 'view'],

                'formats' => [

                    'application/json' => \yii\web\Response::FORMAT_JSON,

                ],

            ],

        ];

    }



    

    
    public function actionViewsensors($idDevice=1)
    {
        $sensorsForGivenIdDevice = Sensor::find()->where(['idDevice'=>$idDevice])->all();
        
        $a=array();
        foreach ($sensorsForGivenIdDevice as &$oneSensor)
        {
            $tmp = $oneSensor->getAttributes(array('idSensor','idDevice','idSensor_Type','name'));
            array_push($a,$tmp);
        }
        
        return json_encode($a);
        //return json_encode($samplesForGivenIdSensor[0]->idSample);
    }

}

