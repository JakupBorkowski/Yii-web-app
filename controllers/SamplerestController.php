<?php

namespace app\controllers;
use yii\rest\ActiveController;
use app\models\Sample;

class SamplerestController extends ActiveController
{
    public $modelClass ='app\models\Sample';

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

    public function actionViewsamples($idSensor=1)
    {
        $samplesForGivenIdSensor = Sample::find()->where(['idSensor'=>$idSensor])->all();
        
        $a=array();
        foreach ($samplesForGivenIdSensor as &$oneSample)
        {
            $tmp = $oneSample->getAttributes(array('idSample','idSensor','value_1','value_2','value_3','timestamp'));
            array_push($a,$tmp);
        }
        
        return json_encode($a);
        //return json_encode($samplesForGivenIdSensor[0]->idSample);
    }

}

