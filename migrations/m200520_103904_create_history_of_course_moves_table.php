<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_of_course_moves}}`.
 */
class m200520_103904_create_history_of_course_moves_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history_of_course_moves}}', [
            'id' => $this->primaryKey(),
            'old_course_number' => $this->tinyInteger()->notNull(),
            'new_course_number' => $this->tinyInteger()->notNull(),

            'student_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-history_of_course_moves-student_id',
            'history_of_course_moves',
            'student_id',
            'student',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-history_of_course_moves-student_id',
            'history_of_course_moves'
        );
        $this->dropTable('{{%history_of_course_moves}}');
    }
}
