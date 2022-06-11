<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sessionhassensor".
 *
 * @property int $idSession
 * @property int $idSensor
 *
 * @property Sensor $idSensor0
 * @property Session $idSession0
 */
class Sessionhassensor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sessionhassensor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSession', 'idSensor'], 'required'],
            [['idSession', 'idSensor'], 'integer'],
            [['idSession', 'idSensor'], 'unique', 'targetAttribute' => ['idSession', 'idSensor']],
            [['idSensor'], 'exist', 'skipOnError' => true, 'targetClass' => Sensor::className(), 'targetAttribute' => ['idSensor' => 'idSensor']],
            [['idSession'], 'exist', 'skipOnError' => true, 'targetClass' => Session::className(), 'targetAttribute' => ['idSession' => 'idSession']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSession' => 'Id Session',
            'idSensor' => 'Id Sensor',
        ];
    }

    /**
     * Gets query for [[IdSensor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSensor0()
    {
        return $this->hasOne(Sensor::className(), ['idSensor' => 'idSensor']);
    }

    /**
     * Gets query for [[IdSession0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSession0()
    {
        return $this->hasOne(Session::className(), ['idSession' => 'idSession']);
    }

    
    //TO DO
    //ZADANIE 3 D do dokonczenia !
    public function afterDelete(){
        
        $sessionshassensorsExist=sessionhassensor::find()->where(['idSession'=>$this->idSession])->count();
            //Yii::$app->session->setFlash('error',$sessionshassensorsExist);

            if($sessionshassensorsExist==0)
            {
                Session::find()->where(['idSession'=>$this->idSession])->one()->delete();
            }
       
    }
}
