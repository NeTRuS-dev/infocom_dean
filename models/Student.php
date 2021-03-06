<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%student}}".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $date_of_birth
 * @property string $year_of_receipt
 * @property int $academic_plan_id
 * @property int $studying_type_id
 * @property int $group_id
 * @property int $deleted
 *
 * @property HistoryOfAcademicLeaves[] $historyOfAcademicLeaves
 * @property HistoryOfCourseMoves[] $historyOfCourseMoves
 * @property HistoryOfGroupChanging[] $historyOfGroupChangings
 * @property Mark[] $marks
 * @property AcademicPlan $academicPlan
 * @property Group $group
 * @property StudyingType $studyingType
 */
class Student extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%student}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'date_of_birth', 'year_of_receipt', 'academic_plan_id', 'studying_type_id', 'group_id'], 'required'],
            [['date_of_birth', 'year_of_receipt'], 'safe'],
            [['academic_plan_id', 'studying_type_id', 'group_id', 'deleted'], 'integer'],
            [['deleted'], 'integer', 'max' => 1, 'min' => 0],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 255],
            [['academic_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicPlan::class, 'targetAttribute' => ['academic_plan_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
            [['studying_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudyingType::class, 'targetAttribute' => ['studying_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'date_of_birth' => 'Дата рождения',
            'year_of_receipt' => 'Год поступления',
            'academic_plan_id' => 'ID учебного плана',
            'studying_type_id' => 'ID типа обучения',
            'group_id' => 'ID группы',
            'deleted' => 'Удалён',
        ];
    }

    /**
     * Gets query for [[HistoryOfAcademicLeaves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfAcademicLeaves()
    {
        return $this->hasMany(HistoryOfAcademicLeaves::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[HistoryOfCourseMoves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfCourseMoves()
    {
        return $this->hasMany(HistoryOfCourseMoves::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[HistoryOfGroupChangings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfGroupChangings()
    {
        return $this->hasMany(HistoryOfGroupChanging::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[Marks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarks()
    {
        return $this->hasMany(Mark::class, ['student_id' => 'id']);
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
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[StudyingType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudyingType()
    {
        return $this->hasOne(StudyingType::class, ['id' => 'studying_type_id']);
    }

    public function delete()
    {
        $this->deleted = 1;
        return $this->save() ? $this->id : false;
    }
}
