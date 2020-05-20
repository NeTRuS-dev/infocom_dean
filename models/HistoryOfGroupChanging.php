<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%history_of_group_changing}}".
 *
 * @property int $id
 * @property int $course_number
 * @property int $previous_group_id
 * @property int $new_group_id
 * @property int $student_id
 *
 * @property Group $newGroup
 * @property Group $previousGroup
 * @property Student $student
 */
class HistoryOfGroupChanging extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%history_of_group_changing}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_number', 'previous_group_id', 'new_group_id', 'student_id'], 'required'],
            [['course_number', 'previous_group_id', 'new_group_id', 'student_id'], 'integer'],
            [['new_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['new_group_id' => 'id']],
            [['previous_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['previous_group_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_number' => 'Course Number',
            'previous_group_id' => 'Previous Group ID',
            'new_group_id' => 'New Group ID',
            'student_id' => 'Student ID',
        ];
    }

    /**
     * Gets query for [[NewGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'new_group_id']);
    }

    /**
     * Gets query for [[PreviousGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPreviousGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'previous_group_id']);
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
}
