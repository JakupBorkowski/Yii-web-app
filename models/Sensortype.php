<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sensortype".
 *
 * @property int $idSensor_Type
 * @property string $name
 * @property int $DataSize
 *
 * @property Sensor[] $sensors
 */
class Sensortype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sensortype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'DataSize'], 'required'],
            [['DataSize'], 'integer'],
            [['name'], 'string', 'max' => 63],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSensor_Type' => 'Id Sensor Type',
            'name' => 'Name',
            'DataSize' => 'Data Size',
        ];
    }

    /**
     * Gets query for [[Sensors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSensors()
    {
        return $this->hasMany(Sensor::className(), ['idSensor_Type' => 'idSensor_Type']);
    }
}
