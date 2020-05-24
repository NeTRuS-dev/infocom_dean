<?php

use yii\db\Migration;

/**
 * Class m200524_090217_add_students_uping_procedure
 */
class m200524_090217_add_students_uping_procedure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(<<<SQL
CREATE PROCEDURE UpCourseForGroupMembers(
    IN target_group_id INT
)
BEGIN
    SET @target_group_course_number = (SELECT `course_number`
                                       FROM `group`
                                       WHERE `group`.`id` = target_group_id);
    SET @target_group_specialty_id = (SELECT `specialty_id`
                                      FROM `group`
                                      WHERE `group`.`id` = target_group_id);
    SET @touched_students = (SELECT COUNT(`student`.`id`)
                             FROM `group`
                                      INNER JOIN `student` ON `group`.`id` = `student`.`group_id`
                             WHERE `group`.`id` = target_group_id);
    SET @new_group_id = (SELECT `group`.`id`
                         FROM `group`
                         WHERE `group`.`course_number` = @target_group_course_number
                           AND `group`.`id` != target_group_id
                         LIMIT 1);
    IF ISNULL(@new_group_id) THEN
        INSERT `group`(`name`, `course_number`, `specialty_id`)
        VALUES (LEFT(MD5(RAND()), 7), @target_group_course_number, @target_group_specialty_id);
        SET @new_group_id = LAST_INSERT_ID();
    END IF;


    CREATE TEMPORARY TABLE `student_ids_to_stay_back`
    SELECT `student`.`id` as `id`
    FROM `group`
             INNER JOIN `student`
                        ON `student`.`deleted` = 0 AND `group`.`id` = target_group_id AND
                           `group`.`id` = `student`.`group_id`
             INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
             INNER JOIN `subject_academic_plan`
                        ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
             INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
             INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id`
             LEFT JOIN `history_of_academic_leaves` ON `history_of_academic_leaves`.`student_id` = `student`.`id` AND
                                                       `history_of_academic_leaves`.`date_of_beginning` <= CURDATE() AND
                                                       `history_of_academic_leaves`.`date_of_ending` >= CURDATE()
    WHERE `group`.`id` = target_group_id
      AND `history_of_academic_leaves`.`id` IS NULL
    GROUP BY `student`.`id`
    HAVING AVG(`mark`.`value`) <= 2.75
        OR (COUNT(CASE WHEN `mark`.`absent` >= 1 THEN 1 ELSE NULL END) / COUNT(*)) <= 0.3;

    UPDATE `student`
    SET `student`.`group_id` = @new_group_id
    WHERE `student`.`deleted` = 0
      AND `student`.`id` in (SELECT `id` FROM `student_ids_to_stay_back`);

    DROP TEMPORARY TABLE `student_ids_to_stay_back`;

    UPDATE `group`
    SET `group`.`course_number` = `group`.`course_number` + 1
    WHERE `group`.`id` = target_group_id;
    SELECT @touched_students;
END ;
SQL
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP PROCEDURE UpCourseForGroupMembers');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200524_090217_add_students_uping_procedure cannot be reverted.\n";

        return false;
    }
    */
}
