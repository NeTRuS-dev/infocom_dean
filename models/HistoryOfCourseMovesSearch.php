<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistoryOfCourseMoves;

/**
 * HistoryOfCourseMovesSearch represents the model behind the search form of `app\models\HistoryOfCourseMoves`.
 */
class HistoryOfCourseMovesSearch extends HistoryOfCourseMoves
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'old_course_number', 'new_course_number', 'student_id'], 'integer'],
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
        $query = HistoryOfCourseMoves::find();

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
            'old_course_number' => $this->old_course_number,
            'new_course_number' => $this->new_course_number,
            'student_id' => $this->student_id,
        ]);

        return $dataProvider;
    }
}
