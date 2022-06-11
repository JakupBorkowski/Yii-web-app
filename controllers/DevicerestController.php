<?php

namespace app\controllers;
use yii\rest\ActiveController;

class DevicerestController extends ActiveController
{
    public $modelClass ='app\models\Device';
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
}

