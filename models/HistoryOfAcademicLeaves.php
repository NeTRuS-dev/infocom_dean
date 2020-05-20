<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%history_of_academic_leaves}}".
 *
 * @property int $id
 * @property string $date_of_beginning
 * @property string $date_of_ending
 * @property int $student_id
 *
 * @property Student $student
 */
class HistoryOfAcademicLeaves extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%history_of_academic_leaves}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_of_beginning', 'date_of_ending', 'student_id'], 'required'],
            [['date_of_beginning', 'date_of_ending'], 'safe'],
            [['student_id'], 'integer'],
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
            'date_of_beginning' => 'Date Of Beginning',
            'date_of_ending' => 'Date Of Ending',
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
