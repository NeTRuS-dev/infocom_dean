<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%history_of_academic_leaves}}`.
 */
class m200520_104403_create_history_of_academic_leaves_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%history_of_academic_leaves}}', [
            'id' => $this->primaryKey(),
            'date_of_beginning'=>$this->date()->notNull(),
            'date_of_ending'=>$this->date()->notNull(),

            'student_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-history_of_academic_leaves-student_id',
            'history_of_academic_leaves',
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
            'fk-history_of_academic_leaves-student_id',
            'history_of_academic_leaves'
        );
        $this->dropTable('{{%history_of_academic_leaves}}');
    }
}
