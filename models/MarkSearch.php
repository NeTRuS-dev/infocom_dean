<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mark;

/**
 * MarkSearch represents the model behind the search form of `app\models\Mark`.
 */
class MarkSearch extends Mark
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'value', 'absent', 'subject_id', 'student_id'], 'integer'],
            [['valuation_date'], 'safe'],
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
        $query = Mark::find();

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
            'value' => $this->value,
            'absent' => $this->absent,
            'valuation_date' => $this->valuation_date,
            'subject_id' => $this->subject_id,
            'student_id' => $this->student_id,
        ]);

        return $dataProvider;
    }
}
