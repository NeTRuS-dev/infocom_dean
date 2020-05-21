<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubjectAcademicPlan;

/**
 * SubjectAcademicPlanSearch represents the model behind the search form of `app\models\SubjectAcademicPlan`.
 */
class SubjectAcademicPlanSearch extends SubjectAcademicPlan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'academic_plan_id', 'number_of_lecture_hours', 'hours_of_practical_training'], 'integer'],
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
        $query = SubjectAcademicPlan::find();

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
            'subject_id' => $this->subject_id,
            'academic_plan_id' => $this->academic_plan_id,
            'number_of_lecture_hours' => $this->number_of_lecture_hours,
            'hours_of_practical_training' => $this->hours_of_practical_training,
        ]);

        return $dataProvider;
    }
}
