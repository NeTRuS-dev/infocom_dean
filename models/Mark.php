<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mark}}".
 *
 * @property int $id
 * @property int|null $value
 * @property int $subject_id
 * @property string|null $valuation_date
 * @property int $student_id
 * @property int|null $absent
 *
 * @property Student $student
 * @property Subject $subject
 */
class Mark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mark}}';
    }

    public function rules()
    {
        return [
            ['value', 'integer', 'min' => 2, 'max' => 5],
            ['absent', 'boolean'],
            [['subject_id', 'student_id'], 'integer'],
            [['subject_id', 'student_id'], 'required'],
            [['valuation_date'], 'safe'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'subject_id' => 'Subject ID',
            'valuation_date' => 'Valuation Date',
            'student_id' => 'Student ID',
            'absent' => 'Absent',
        ];
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['id' => 'student_id']);
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
