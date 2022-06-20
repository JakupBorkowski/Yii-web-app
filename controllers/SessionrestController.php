<?php

namespace app\controllers;
use yii\rest\ActiveController;

class SessionrestController extends ActiveController
{
    public $modelClass ='app\models\Session';


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
        //return $this->render('findallsamplessql',['data'=>json_encode(array_slice($a,0,$commandResult[0]["samples"]))]);
        return json_encode(array_slice($a,0,$commandResult[0]["samples"]));
    }

    public function actionFindSessionByTimestamp($timestamp)
    {
        //tworzenie polaczenia
        $connection = new \yii\db\Connection([
            'dsn' => 'mysql:host=localhost;dbname=sensor',
            'username' => 'root',
            'password' => '',
        ]);
        $tab=12;
        $connection->open();

        //http://192.168.1.5:8080/PolitechnikaModel/web/sessionrest/find-session-by-timestamp?timestamp=2022-06-12%2007:48:54.453000
        //wyciaganie $idSession, $name, $start, $samples, t$p dla podanego timestampa
        $requestSql='SELECT idSession, name, start, samples, tp FROM session where start=:timestamp';
        $command = $connection->createCommand($requestSql);
        $command->bindValue(':timestamp', $_GET['timestamp']);
        $commandResult=$command->queryAll();
        
        //return $this->render('findallsamplessql',['data'=>json_encode(array_slice($a,0,$commandResult[0]["samples"]))]);
        return json_encode($commandResult);
    }

}

