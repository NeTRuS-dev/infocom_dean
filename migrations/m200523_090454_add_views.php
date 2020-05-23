<?php

use yii\db\Migration;

/**
 * Class m200523_090454_add_views
 */
class m200523_090454_add_views extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(<<<SQL
CREATE VIEW grade_point_average_in_group AS
SELECT `group`.`name` as `Группа`, AVG(`mark`.`value`) as `Средняя оценка`
FROM `group`
         INNER JOIN `student` ON `student`.`deleted` = 0 AND `group`.`id` = `student`.`group_id`
         INNER JOIN `academic_plan` ON `student`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject_academic_plan` ON `subject_academic_plan`.`academic_plan_id` = `academic_plan`.`id`
         INNER JOIN `subject` ON `subject_academic_plan`.`subject_id` = `subject`.`id`
         INNER JOIN `mark` ON `mark`.`subject_id` = `subject`.`id` AND `mark`.`value` IS NOT NULL
GROUP BY `group`.`name`;
SQL
);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('DROP VIEW grade_point_average_in_group');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200523_090454_add_views cannot be reverted.\n";

        return false;
    }
    */
}
