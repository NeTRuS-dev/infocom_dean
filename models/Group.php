<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property int $id
 * @property string $name
 * @property int $course_number
 * @property int $specialty_id
 *
 * @property Specialty $specialty
 * @property HistoryOfGroupChanging[] $historyOfGroupChangings
 * @property HistoryOfGroupChanging[] $historyOfGroupChangings0
 * @property Student[] $students
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'course_number', 'specialty_id'], 'required'],
            [['course_number', 'specialty_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['specialty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialty::class, 'targetAttribute' => ['specialty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'course_number' => 'Course Number',
            'specialty_id' => 'Specialty ID',
        ];
    }

    /**
     * Gets query for [[Specialty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialty()
    {
        return $this->hasOne(Specialty::class, ['id' => 'specialty_id']);
    }

    /**
     * Gets query for [[HistoryOfGroupChangings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfGroupChangings()
    {
        return $this->hasMany(HistoryOfGroupChanging::class, ['new_group_id' => 'id']);
    }

    /**
     * Gets query for [[HistoryOfGroupChangings0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfGroupChangings0()
    {
        return $this->hasMany(HistoryOfGroupChanging::class, ['previous_group_id' => 'id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::class, ['group_id' => 'id']);
    }
}
