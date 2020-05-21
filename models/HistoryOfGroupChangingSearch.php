<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistoryOfGroupChanging;

/**
 * HistoryOfGroupChangingSearch represents the model behind the search form of `app\models\HistoryOfGroupChanging`.
 */
class HistoryOfGroupChangingSearch extends HistoryOfGroupChanging
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'course_number', 'previous_group_id', 'new_group_id', 'student_id'], 'integer'],
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
        $query = HistoryOfGroupChanging::find();

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
            'course_number' => $this->course_number,
            'previous_group_id' => $this->previous_group_id,
            'new_group_id' => $this->new_group_id,
            'student_id' => $this->student_id,
        ]);

        return $dataProvider;
    }
}
