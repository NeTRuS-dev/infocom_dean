<?php

namespace app\models;

use Yii;

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
 *
 * @property HistoryOfAcademicLeaves[] $historyOfAcademicLeaves
 * @property HistoryOfCourseMoves[] $historyOfCourseMoves
 * @property HistoryOfGroupChanging[] $historyOfGroupChangings
 * @property AcademicPlan $academicPlan
 * @property Group $group
 * @property StudyingType $studyingType
 */
class Student extends \yii\db\ActiveRecord
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
            [['academic_plan_id', 'studying_type_id', 'group_id'], 'integer'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 255],
            [['academic_plan_id'], 'exist', 'skipOnError' => true, 'targetClass' => AcademicPlan::className(), 'targetAttribute' => ['academic_plan_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['studying_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudyingType::className(), 'targetAttribute' => ['studying_type_id' => 'id']],
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
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'date_of_birth' => 'Date Of Birth',
            'year_of_receipt' => 'Year Of Receipt',
            'academic_plan_id' => 'Academic Plan ID',
            'studying_type_id' => 'Studying Type ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * Gets query for [[HistoryOfAcademicLeaves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfAcademicLeaves()
    {
        return $this->hasMany(HistoryOfAcademicLeaves::className(), ['student_id' => 'id']);
    }

    /**
     * Gets query for [[HistoryOfCourseMoves]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfCourseMoves()
    {
        return $this->hasMany(HistoryOfCourseMoves::className(), ['student_id' => 'id']);
    }

    /**
     * Gets query for [[HistoryOfGroupChangings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryOfGroupChangings()
    {
        return $this->hasMany(HistoryOfGroupChanging::className(), ['student_id' => 'id']);
    }

    /**
     * Gets query for [[AcademicPlan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicPlan()
    {
        return $this->hasOne(AcademicPlan::className(), ['id' => 'academic_plan_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * Gets query for [[StudyingType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudyingType()
    {
        return $this->hasOne(StudyingType::className(), ['id' => 'studying_type_id']);
    }
}
