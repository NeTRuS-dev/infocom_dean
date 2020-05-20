<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%student}}`.
 */
class m200520_100424_create_student_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%student}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'surname' => $this->string(255)->notNull(),
            'patronymic' => $this->string(255)->notNull(),
            'date_of_birth' => $this->date()->notNull(),
            'year_of_receipt' => $this->date()->notNull(),

            'academic_plan_id' => $this->integer()->notNull(),
            'studying_type_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull()

        ]);
        $this->addForeignKey(
            'fk-student-studying_type_id',
            'student',
            'studying_type_id',
            'studying_type',
            'id'
        );
        $this->addForeignKey(
            'fk-student-group_id',
            'student',
            'group_id',
            'group',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-student-group_id',
            'student'
        );
        $this->dropForeignKey(
            'fk-student-studying_type_id',
            'student'
        );
        $this->dropTable('{{%student}}');
    }
}
