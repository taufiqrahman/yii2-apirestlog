<?php

namespace rahmansoft\apirestlog\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ApiLogSearch represents the model behind the search form of `Rahmansoft\Apirestlog\models\ApiLog`.
 */
class ApiLogSearch extends ApiLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'createdby'], 'integer'],
            [['ipclient', 'app_name', 'ws_type', 'request', 'response', 'createdon'], 'safe'],
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
        $query = ApiLog::find();

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
            'id' => $this->id,
            'createdon' => $this->createdon,
            'createdby' => $this->createdby,
        ]);

        $query->andFilterWhere(['like', 'ipclient', $this->ipclient])
            ->andFilterWhere(['like', 'app_name', $this->app_name])
            ->andFilterWhere(['like', 'ws_type', $this->ws_type])
            ->andFilterWhere(['like', 'request', $this->request])
            ->andFilterWhere(['like', 'response', $this->response]);

        return $dataProvider;
    }
}
