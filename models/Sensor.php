<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sensor".
 *
 * @property int $idSensor
 * @property int $idDevice
 * @property int $idSensor_Type
 * @property string|null $name
 *
 * @property Device $idDevice0
 * @property Sensortype $idSensorType
 * @property Session[] $idSessions
 * @property Sample[] $samples
 * @property Sessionhassensor[] $sessionhassensors
 */
class Sensor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sensor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idDevice', 'idSensor_Type'], 'required'],
            [['idDevice', 'idSensor_Type'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['idDevice'], 'exist', 'skipOnError' => true, 'targetClass' => Device::className(), 'targetAttribute' => ['idDevice' => 'idDevice']],
            [['idSensor_Type'], 'exist', 'skipOnError' => true, 'targetClass' => Sensortype::className(), 'targetAttribute' => ['idSensor_Type' => 'idSensor_Type']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSensor' => 'Identyfikator czujnika',
            'idDevice' => 'Identyfikator urządzenia',
            'idSensor_Type' => 'Identyfikator typu czujnika',
            'name' => 'Nazwa',
        ];
    }

    /**
     * Gets query for [[IdDevice0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdDevice0()
    {
        return $this->hasOne(Device::className(), ['idDevice' => 'idDevice']);
    }

    /**
     * Gets query for [[IdSensorType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSensorType()
    {
        return $this->hasOne(Sensortype::className(), ['idSensor_Type' => 'idSensor_Type']);
    }

    /**
     * Gets query for [[IdSessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSessions()
    {
        return $this->hasMany(Session::className(), ['idSession' => 'idSession'])->viaTable('sessionhassensor', ['idSensor' => 'idSensor']);
    }

    /**
     * Gets query for [[Samples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSamples()
    {
        return $this->hasMany(Sample::className(), ['idSensor' => 'idSensor']);
    }

    /**
     * Gets query for [[Sessionhassensors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionhassensors()
    {
        return $this->hasMany(Sessionhassensor::className(), ['idSensor' => 'idSensor']);
    }

    public function beforeDelete()
    {
        if(!parent::beforeDelete()){
            return false;
        }

        //zapisywanie istniejących próbek dla danego sensora do ARRAY[] $samplesExist
        $samplesExist = $this->samples;

        if(isset($samplesExist))
        {
            foreach($samplesExist as $samplesExistDelete)
            {
                $samplesExistDelete->delete();
            }
        }

        //zapisywanie istniejących sesji powiązanych z sensorem dla danego sensora do ARRAY[] $sessionhassensorsExist
        $sessionhassensorsExist=$this->sessionhassensors;
        if(isset($sessionhassensorsExist))
        {
            foreach($sessionhassensorsExist as $sessionhassensorsExistDelete)
            {
                $sessionhassensorsExistDelete->delete();
            }
        }
        return true;
    }


    
    //ZADANIE 4B
    public function afterSave($insert, $changedAttributes)
    {
        $Device1=Device::findOne($this->idDevice0);
        $Device1->lastActualization = date('Y-m-d H:i:s');
        $Device1->save();
        
        return parent::afterSave($insert, $changedAttributes); 
    }


}
