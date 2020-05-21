<?php


namespace app\commands;

use app\models\Department;
use app\models\Specialty;
use app\models\StudyingType;
use Faker\Factory;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GenerateController extends Controller
{

    public function actionDepartment(int $count = 10)
    {
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            $inst = new Department();
            $inst->name = $faker->company;
            $inst->description = $faker->text;
            $inst->save();
        }
        return ExitCode::OK;
    }

    public function actionEducationFormat()
    {
        $tmp = new StudyingType();
        $tmp->name = 'Заочный';
        $tmp->save();
        $tmp = new StudyingType();
        $tmp->name = 'Очный';
        $tmp->save();
        return ExitCode::OK;
    }

    public function actionSpecialty(int $count = 10)
    {
        $department_size = Department::find()->count();
        if ($department_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            try {
                $inst = new Specialty();
                $inst->name = $faker->jobTitle;
                $depart = null;
                while (is_null($depart)) {
                    $depart = Department::findOne(random_int(0, $department_size - 1));
                }
                $depart->link('specialties', $inst);
            } catch (\Exception $e) {
            }
        }
        return ExitCode::OK;
    }
}
