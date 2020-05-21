<?php


namespace app\commands;

use app\models\AcademicPlan;
use app\models\Department;
use app\models\Group;
use app\models\Mark;
use app\models\Specialty;
use app\models\Student;
use app\models\StudyingType;
use app\models\Subject;
use Faker\Factory;
use Throwable;
use yii\console\Controller;
use yii\console\ExitCode;

class GenerateController extends Controller
{
    public function actionIndex()
    {
        $this->actionDepartment();
        $this->actionStudyingType();
        $this->actionSpecialty();
        $this->actionGroup();
        $this->actionSubject();
        $this->actionAcademicPlan();
        $this->actionStudent();
        $this->actionMark();
    }

    public function actionDepartment(int $count = 5)
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

    public function actionStudyingType()
    {
        if (StudyingType::find()->count() > 0) {
            return ExitCode::OK;
        }
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
        $department_max_id = Department::find()->max('id');
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            try {
                $inst = new Specialty();
                $inst->name = $faker->jobTitle;
                $depart = null;
                while (is_null($depart)) {
                    $depart = Department::findOne(random_int(1, $department_max_id));
                }
                $depart->link('specialties', $inst);
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }
        return ExitCode::OK;
    }

    public function actionGroup(int $count = 20)
    {
        $parent_size = Specialty::find()->count();
        if ($parent_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $parent_max_id = Specialty::find()->max('id');
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            try {
                $inst = new Group();
                $inst->name = $faker->numerify($faker->word . '-###');
                $inst->course_number = random_int(1, 5);
                $parent = null;
                while (is_null($parent)) {
                    $parent = Specialty::findOne(random_int(1, $parent_max_id));
                }
                $parent->link('groups', $inst);
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }
        return ExitCode::OK;
    }

    public function actionSubject(int $count = 20)
    {
        $department_size = Department::find()->count();
        if ($department_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $department_max_id = Department::find()->max('id');
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            try {
                $inst = new Subject();
                $inst->name = $faker->word;
                $depart = null;
                while (is_null($depart)) {
                    $depart = Department::findOne(random_int(1, $department_max_id));
                }
                try {

                    $depart->link('subjects', $inst);
                } catch (Throwable $e) {
                    $i--;
                }
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }
        return ExitCode::OK;
    }

    public function actionAcademicPlan(int $count = 50)
    {
        $subj_count = Subject::find()->count();
        if ($subj_count < 1) {
            return ExitCode::CANTCREAT;
        }
        $subj_max_id = Subject::find()->max('id');
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            $used_subj_ids = [];
            try {
                $inst = new AcademicPlan();
                $inst->description = $faker->text(100);
                $subj_count_to_link = random_int(1, $subj_count);
                for ($j = 0; $j < $subj_count_to_link; $j++) {
                    $subj = null;
                    while (is_null($subj) || in_array($subj->id, $used_subj_ids)) {
                        $subj = Subject::findOne(random_int(1, $subj_max_id));
                    }
                    $inst->save();
                    $subj->link('academicPlans', $inst, [
                        'number_of_lecture_hours' => random_int(50, 90),
                        'hours_of_practical_training' => random_int(50, 90),
                    ]);
                    $used_subj_ids[] = $subj->id;

                }
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }
        return ExitCode::OK;
    }

    public function actionStudent(int $count = 50)
    {
        $parent_size = Group::find()->count();
        if ($parent_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $acad_size = AcademicPlan::find()->count();
        if ($acad_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $parent_size = Group::find()->max('id');
        $acad_size = AcademicPlan::find()->max('id');
        $faker = Factory::create('ru_RU');
        for ($i = 0; $i < $count; $i++) {
            try {
                $inst = new Student();
                $inst->name = $faker->firstName;
                $inst->surname = $faker->lastName;
                $inst->patronymic = $faker->firstNameMale . 'ыч';
                $inst->date_of_birth = $faker->date('Y-m-d', '-17 years');
                $inst->year_of_receipt = date("Y-m-d", strtotime("01-09-{$faker->year('-1 year')} 00:00:00"));
                $inst->studying_type_id = StudyingType::findOne(random_int(1, 2))->id;
                $acad_plan = null;
                while (is_null($acad_plan)) {
                    $acad_plan = AcademicPlan::findOne(random_int(1, $acad_size));
                }
                $inst->academic_plan_id = $acad_plan->id;
                $parent = null;
                while (is_null($parent)) {
                    $parent = Group::findOne(random_int(1, $parent_size));
                }
                $parent->link('students', $inst);
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }
        return ExitCode::OK;
    }


    public function actionMark(int $count = 100)
    {
        $faker = Factory::create('ru_RU');
        $student_size = Student::find()->count();
        if ($student_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $subject_size = Subject::find()->count();
        if ($subject_size < 1) {
            return ExitCode::CANTCREAT;
        }
        $subject_size = Subject::find()->max('id');
        $student_size = Student::find()->max('id');

        for ($i = 0; $i < $count; $i++) {
            try {
                $inst = new Mark();
                $was_on_pair = boolval(random_int(0, 1));
                $inst->absent = !$was_on_pair;

                if ($was_on_pair) {
                    $inst->value = random_int(2, 5);
                }
                $inst->valuation_date = $faker->date() . ' ' . $faker->time();

                $student = null;
                while (is_null($student)) {
                    $student = Student::findOne(random_int(1, $student_size));
                }
                $inst->student_id = $student->id;
                $subject = null;
                while (is_null($subject)) {
                    $subject = Subject::findOne(random_int(1, $subject_size));
                }
                $inst->subject_id = $subject->id;
                $inst->save();
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }
        return ExitCode::OK;
    }
}
