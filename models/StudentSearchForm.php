<?php


namespace app\models;


class StudentSearchForm extends \yii\base\Model
{
    public string $name_pattern;
    public string $surname_pattern;
    public string $patronymic_pattern;

    public function __construct()
    {
        parent::__construct();
        $this->name_pattern = '';
        $this->surname_pattern = '';
        $this->patronymic_pattern = '';
    }

    public function rules()
    {
        return [
            [['name_pattern', 'surname_pattern', 'patronymic_pattern'], 'trim'],
            [['name_pattern', 'surname_pattern', 'patronymic_pattern'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name_pattern' => 'Начало имени',
            'surname_pattern' => 'Начало фамилии',
            'patronymic_pattern' => 'Начало отчества',
        ];
    }

    public function afterValidate()
    {
        parent::afterValidate();
        $this->name_pattern = $this->string_converter($this->name_pattern,);
        $this->surname_pattern = $this->string_converter($this->surname_pattern,);
        $this->patronymic_pattern = $this->string_converter($this->patronymic_pattern,);
    }

    private function string_converter(string $str): string
    {
        return mb_convert_case(mb_substr($str, 0, 1), MB_CASE_UPPER) . mb_convert_case(mb_substr($str, 1), MB_CASE_LOWER);
    }
}