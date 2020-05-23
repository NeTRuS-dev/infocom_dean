<?php

use yii\db\Migration;

/**
 * Class m200523_090507_add_procedures
 */
class m200523_090507_add_procedures extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(<<<SQL
CREATE PROCEDURE GetIdiotsInTimeRange(IN subject_id INT,
                                      IN beginning DATETIME,
                                      IN ending DATETIME)
BEGIN
    SELECT `group`.`name`                AS `Группа`,
           `student`.`name`              AS `Имя`,
           `student`.`surname`           AS `Фамилия`,
           `student`.`patronymic`        AS `Отчество`
    FROM `subject`
             INNER JOIN `subject_academic_plan` ON `subject`.`id` = `subject_academic_plan`.`subject_id`
             INNER JOIN `academic_plan` ON `academic_plan`.`id` = `subject_academic_plan`.`academic_plan_id`
             INNER JOIN `student` ON `student`.`deleted` = 0 AND `academic_plan`.`id` = `student`.`academic_plan_id`
             INNER JOIN `group` ON `group`.`id` = `student`.`group_id`
             INNER JOIN `mark` ON `mark`.`student_id` = `student`.`id` AND `mark`.`valuation_date` >= beginning AND
                                  `mark`.`valuation_date` <= ending
    WHERE `subject`.`id` = subject_id
      AND (`mark`.`absent` = 1
        OR `mark`.`value` = 2)
    GROUP BY `group`.`name`,
             `student`.`name`,
             `student`.`surname`,
             `student`.`patronymic`;
END ;
SQL
        );
        $this->execute(<<<SQL
CREATE PROCEDURE GetStudentsIDsByNames(IN name_pattern VARCHAR(255),
                                       IN surname_pattern VARCHAR(255),
                                       IN patronymic_pattern VARCHAR(255))
BEGIN
    SELECT `student`.`id` AS `id`
    FROM `student`
             LEFT JOIN `group` ON `group`.`id` = `student`.`group_id`
    WHERE `student`.`deleted` = 0
      AND `student`.`name` LIKE CONCAT(name_pattern, '%')
      AND `student`.`surname` LIKE CONCAT(surname_pattern, '%')
      AND `student`.`patronymic` LIKE CONCAT(patronymic_pattern, '%')
    GROUP BY `student`.`id`;
END ;

SQL
        );
        $this->execute(<<<SQL
CREATE PROCEDURE GetMainDataAboutStudent(IN target_id INT)
BEGIN
    SELECT `student`.`name`              AS `Имя`,
           `student`.`surname`           AS `Фамилия`,
           `student`.`patronymic`        AS `Отчество`,
           `student`.`date_of_birth`     AS `Дата рождения`,
           `student`.`year_of_receipt`   AS `Дата поступления`,
           `studying_type`.`name`        AS `Форма обучения`,
           `department`.`name`           AS `Кафедра`,
           `group`.`course_number`       AS `Номер курса`,
           `group`.`name`                AS `Группа`,
           `academic_plan`.`description` AS `Учебный план`
    FROM `student`
             LEFT JOIN `studying_type` ON `studying_type`.`id` = `student`.`studying_type_id`
             LEFT JOIN `group` ON `group`.`id` = `student`.`group_id`
             LEFT JOIN `specialty` ON `group`.`specialty_id` = `specialty`.`id`
             LEFT JOIN `department` ON `department`.`id` = `specialty`.`department_id`
             LEFT JOIN `academic_plan` ON `academic_plan`.`id` = `student`.`academic_plan_id`
    WHERE `student`.`deleted` = 0
      AND `student`.`id` = target_id;
END ;
SQL
        );
        $this->execute(<<<SQL
CREATE PROCEDURE GetSubjectsDataAboutStudent(IN target_id INT)
BEGIN
    SELECT `subject`.`name`    AS `Предмет`,
           AVG(`mark`.`value`) AS `Средняя оценка`
    FROM `group`
             INNER JOIN `student` ON `group`.`id` = `student`.`group_id`
             INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
             INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
             INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
             INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
    WHERE `student`.`deleted` = 0
      AND `student`.`id` = target_id
    GROUP BY `subject`.`name`;
END ;
SQL
        );
        $this->execute(<<<SQL
CREATE PROCEDURE GetHistoryDataAboutStudent(IN target_id INT)
BEGIN
    SELECT `history_of_group_changing`.`course_number` AS `Курс`,
           `old_group`.`name`                          AS `Старая группа`,
           `new_group`.`name`                          AS `Новая группа`
    FROM `history_of_group_changing`
             INNER JOIN `group` AS `old_group` ON `old_group`.`id` = `history_of_group_changing`.`previous_group_id`
             INNER JOIN `group` AS `new_group` ON `new_group`.`id` = `history_of_group_changing`.`new_group_id`
    WHERE `history_of_group_changing`.`student_id` = target_id;
END ;
SQL
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP PROCEDURE GetIdiotsInTimeRange');
        $this->execute('DROP PROCEDURE GetStudentsIDsByNames');
        $this->execute('DROP PROCEDURE GetMainDataAboutStudent');
        $this->execute('DROP PROCEDURE GetSubjectsDataAboutStudent');
        $this->execute('DROP PROCEDURE GetHistoryDataAboutStudent');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200523_090507_add_procedures cannot be reverted.\n";

        return false;
    }
    */
}
