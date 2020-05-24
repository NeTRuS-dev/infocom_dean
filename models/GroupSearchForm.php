<?php


namespace app\models;


use yii\base\Model;

class GroupSearchForm extends Model
{
    public int $group_id;

    public function __construct()
    {
        parent::__construct();
        $this->group_id = -1;
    }


    public function rules()
    {
        return [
            [['group_id'], 'trim'],
            [['group_id'], 'required'],
            ['group_id', 'integer',],
            [['group_id'], 'exist', 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'group_id' => 'Группа'
        ];
    }

}