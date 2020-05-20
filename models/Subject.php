<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%subject}}".
 *
 * @property int $id
 * @property string $name
 * @property int $department_id
 *
 * @property Mark[] $marks
 * @property Department $department
 * @property SubjectAcademicPlan[] $subjectAcademicPlans
 * @property AcademicPlan[] $academicPlans
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subject}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'department_id'], 'required'],
            [['department_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
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
            'department_id' => 'Department ID',
        ];
    }

    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Mark::class, ['subject_id' => 'id']);
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }

    /**
     * Gets query for [[SubjectAcademicPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectAcademicPlans()
    {
        return $this->hasMany(SubjectAcademicPlan::class, ['subject_id' => 'id']);
    }

    /**
     * Gets query for [[AcademicPlans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicPlans()
    {
        return $this->hasMany(AcademicPlan::class, ['id' => 'academic_plan_id'])->viaTable('{{%subject_academic_plan}}', ['subject_id' => 'id']);
    }
}
