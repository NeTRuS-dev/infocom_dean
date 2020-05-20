<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%subject_academic_plan}}".
 *
 * @property int $subject_id
 * @property int $academic_plan_id
 * @property int $number_of_lecture_hours
 * @property int $hours_of_practical_training
 *
 * @property AcademicPlan $academicPlan
 * @property Subject $subject
 */
class SubjectAcademicPlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subject_academic_plan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject_id', 'academic_plan_id', 'number_of_lecture_hours', 'hours_of_practical_training'], 'required'],
            [['subject_id', 'academic_plan_id', 'number_of_lecture_hours', 'hours_of_practical_training'], 'integer'],
            [['subject_id', 'academic_plan_id'], 'unique', 'targetAttribute' => ['subject_id', 'academic_plan_id']],
            [['academic_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicPlan::class, 'targetAttribute' => ['academic_plan_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => 'Subject ID',
            'academic_plan_id' => 'Academic Plan ID',
            'number_of_lecture_hours' => 'Number Of Lecture Hours',
            'hours_of_practical_training' => 'Hours Of Practical Training',
        ];
    }

    /**
     * Gets query for [[AcademicPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicPlan()
    {
        return $this->hasOne(AcademicPlan::class, ['id' => 'academic_plan_id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::class, ['id' => 'subject_id']);
    }
}
