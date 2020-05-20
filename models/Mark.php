<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%mark}}".
 *
 * @property int $id
 * @property int|null $value
 * @property int $subject_id
 *
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'subject_id'], 'integer', 'min' => 2, 'max' => 5],
            [['subject_id'], 'required'],
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
        ];
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
