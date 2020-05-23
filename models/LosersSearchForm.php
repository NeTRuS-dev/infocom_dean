<?php


namespace app\models;


use DateTime;

class LosersSearchForm extends \yii\base\Model
{
    public string $start_date;
    public string $end_date;
    public int $subject_id;

    public function __construct()
    {
        parent::__construct();
        $this->start_date = '';
        $this->end_date = '';
        $this->subject_id = -1;
    }

    public function rules()
    {
        return [
            [['start_date', 'end_date', 'subject_id'], 'trim'],
            [['start_date', 'end_date', 'subject_id'], 'required'],
            [['start_date', 'end_date'], 'date', 'format' => 'yyyy-mm-dd', 'max' => ((new DateTime())->format('yy-m-d')), 'min' => '1147-01-01',],
            ['start_date', function ($attribute) {
                if ($this->start_date >= $this->end_date) {
                    $this->addError($attribute, 'Дата начала поиска должна быть меньше даты окончания');
                }
            }],
            ['subject_id', 'integer',],
            [['subject_id'], 'exist', 'targetClass' => Subject::class, 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'start_date' => 'Дата начала поиска',
            'end_date' => 'Дата окончания поиска',
            'subject_id' => 'Предмет'
        ];
    }
}