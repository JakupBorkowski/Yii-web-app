<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $idSession
 * @property string $name
 * @property string $start
 * @property int $samples
 * @property float $tp
 *
 * @property Sensor[] $idSensors
 * @property Sessionhassensor[] $sessionhassensors
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'start', 'samples', 'tp'], 'required'],
            [['start'], 'safe'],
            [['samples'], 'integer'],
            [['tp'], 'number'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSession' => 'Id Session',
            'name' => 'Name',
            'start' => 'Start',
            'samples' => 'Samples',
            'tp' => 'Tp',
        ];
    }

    /**
     * Gets query for [[IdSensors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSensors()
    {
        return $this->hasMany(Sensor::className(), ['idSensor' => 'idSensor'])->viaTable('sessionhassensor', ['idSession' => 'idSession']);
    }

    /**
     * Gets query for [[Sessionhassensors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessionhassensors()
    {
        return $this->hasMany(Sessionhassensor::className(), ['idSession' => 'idSession']);
    }

    public function beforeDelete()
    {
        if(!parent::beforeDelete()){
            return false;
        }

        //zapisywanie istniejących sesji powiązanych z czujnikiem  dla danej sesji do ARRAY[] $sessionhassensorsExist
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

}
