<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sample".
 *
 * @property int $idSample
 * @property int $idSensor
 * @property float|null $value_1
 * @property float|null $value_2
 * @property float|null $value_3
 * @property string $timestamp
 *
 * @property Sensor $idSensor0
 */
class Sample extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sample';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSensor', 'timestamp'], 'required'],
            [['idSensor'], 'integer'],
            [['value_1', 'value_2', 'value_3'], 'number'],
            [['timestamp'], 'safe'],
            [['idSensor'], 'exist', 'skipOnError' => true, 'targetClass' => Sensor::className(), 'targetAttribute' => ['idSensor' => 'idSensor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSample' => 'Identyfikator próbki',
            'idSensor' => 'Identyfikator czujnika',
            'value_1' => 'Wartość 1',
            'value_2' => 'Wartość 2',
            'value_3' => 'Wartość 3',
            'timestamp' => 'Znacznik czasu',
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

    //ZADANIE 4B
    public function afterSave($insert, $changedAttributes)
    {
        $Device1=Device::findOne($this->idSensor0->idDevice);
        $Device1->lastActualization = date('Y-m-d H:i:s');
        $Device1->save();
        
        return parent::afterSave($insert, $changedAttributes); 
    }


}
