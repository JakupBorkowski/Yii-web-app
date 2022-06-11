<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sensor;

/**
 * SensorSearch represents the model behind the search form of `app\models\Sensor`.
 */
class SensorSearch extends Sensor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSensor', 'idDevice', 'idSensor_Type'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Sensor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idSensor' => $this->idSensor,
            'idDevice' => $this->idDevice,
            'idSensor_Type' => $this->idSensor_Type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
