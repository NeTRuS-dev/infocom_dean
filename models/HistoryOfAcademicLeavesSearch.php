<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistoryOfAcademicLeaves;

/**
 * HistoryOfAcademicLeavesSearch represents the model behind the search form of `app\models\HistoryOfAcademicLeaves`.
 */
class HistoryOfAcademicLeavesSearch extends HistoryOfAcademicLeaves
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id'], 'integer'],
            [['date_of_beginning', 'date_of_ending'], 'safe'],
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
        $query = HistoryOfAcademicLeaves::find();

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
            'date_of_beginning' => $this->date_of_beginning,
            'date_of_ending' => $this->date_of_ending,
            'student_id' => $this->student_id,
        ]);

        return $dataProvider;
    }
}
