<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%academic_plan}}".
 *
 * @property int $id
 * @property string|null $description
 *
 * @property Student[] $students
 * @property SubjectAcademicPlan[] $subjectAcademicPlans
 * @property Subject[] $subjects
 */
class AcademicPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%academic_plan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string', 'max' => 255],
            [['description'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['academic_plan_id' => 'id']);
    }

    /**
     * Gets query for [[SubjectAcademicPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectAcademicPlans()
    {
        return $this->hasMany(SubjectAcademicPlan::className(), ['academic_plan_id' => 'id']);
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::className(), ['id' => 'subject_id'])->viaTable('{{%subject_academic_plan}}', ['academic_plan_id' => 'id']);
    }
}
