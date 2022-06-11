<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device".
 *
 * @property int $idDevice
 * @property string $name
 * @property string|null $description
 * @property string|null $additionDate
 * @property string|null $lastActualization
 *
 * @property Sensor[] $sensors
 */
class Device extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['additionDate', 'lastActualization'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idDevice' => 'Identyfikator urządzenia',
            'name' => 'Nazwa',
            'description' => 'Opis',
            'additionDate' => 'Data dodania',
            'lastActualization' => 'Ostatnia aktualizacja',
        ];
    }

    /**
     * Gets query for [[Sensors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSensors()
    {
        return $this->hasMany(Sensor::className(), ['idDevice' => 'idDevice']);
    }

    public function beforeDelete()
    {
        if(!parent::beforeDelete()){
            return false;
        }

        $sensorsExist = $this->sensors;

        if(isset($sensorsExist))
        {
            foreach($sensorsExist as $sensorsExistDelete)
            {
                $sensorsExistDelete->delete();
            }
        }
        return true;
    }

    
    //ZADANIE 4A
    public function beforeSave($insert){
        if($this->isNewRecord)
        {
            $this->additionDate = date('Y-m-d H:i:s');
        }

        //LINIA PONIŻEJ TO ZADANIE 4B
        $this->lastActualization = date('Y-m-d H:i:s');
        
       
        return parent::beforeSave($insert); 
    }



}
