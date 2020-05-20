<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_of_group_changing}}`.
 */
class m200520_104925_create_history_of_group_changing_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history_of_group_changing}}', [
            'id' => $this->primaryKey(),
            'course_number'=>$this->tinyInteger()->notNull(),


            'previous_group_id' => $this->integer()->notNull(),
            'new_group_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-history_of_group_changing-previous_group_id',
            'history_of_group_changing',
            'previous_group_id',
            'group',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-history_of_group_changing-new_group_id',
            'history_of_group_changing',
            'new_group_id',
            'group',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-history_of_group_changing-student_id',
            'history_of_group_changing',
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
            'fk-history_of_group_changing-previous_group_id',
            'history_of_group_changing'
        );
        $this->dropForeignKey(
            'fk-history_of_group_changing-new_group_id',
            'history_of_group_changing'
        );
        $this->dropForeignKey(
            'fk-history_of_group_changing-student_id',
            'history_of_group_changing'
        );
        $this->dropTable('{{%history_of_group_changing}}');
    }
}
