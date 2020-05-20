<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%history_of_course_moves}}".
 *
 * @property int $id
 * @property int $old_course_number
 * @property int $new_course_number
 * @property int $student_id
 *
 * @property Student $student
 */
class HistoryOfCourseMoves extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%history_of_course_moves}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['old_course_number', 'new_course_number', 'student_id'], 'required'],
            [['old_course_number', 'new_course_number', 'student_id'], 'integer'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'old_course_number' => 'Old Course Number',
            'new_course_number' => 'New Course Number',
            'student_id' => 'Student ID',
        ];
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
