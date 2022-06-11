<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sample;

/**
 * SampleSearch represents the model behind the search form of `app\models\Sample`.
 */
class SampleSearch extends Sample
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSample', 'idSensor'], 'integer'],
            [['value_1', 'value_2', 'value_3'], 'number'],
            [['timestamp'], 'safe'],
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
        $query = Sample::find();

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
            'idSample' => $this->idSample,
            'idSensor' => $this->idSensor,
            'value_1' => $this->value_1,
            'value_2' => $this->value_2,
            'value_3' => $this->value_3,
            'timestamp' => $this->timestamp,
        ]);

        return $dataProvider;
    }
}
