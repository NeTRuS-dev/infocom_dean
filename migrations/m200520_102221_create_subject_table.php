<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subject}}`.
 */
class m200520_102221_create_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subject}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique()->notNull(),
            'department_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-subject-department_id',
            'subject',
            'department_id',
            'department',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-subject-department_id',
            'subject'
        );
        $this->dropTable('{{%subject}}');
    }
}
