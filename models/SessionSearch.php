<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Session;

/**
 * SessionSearch represents the model behind the search form of `app\models\Session`.
 */
class SessionSearch extends Session
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idSession', 'samples'], 'integer'],
            [['name', 'start'], 'safe'],
            [['tp'], 'number'],
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
        $query = Session::find();

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
            'idSession' => $this->idSession,
            'start' => $this->start,
            'samples' => $this->samples,
            'tp' => $this->tp,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
