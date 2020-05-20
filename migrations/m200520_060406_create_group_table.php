<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m200520_060406_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->unique()->notNull(),
            'course_number'=>$this->integer()->notNull(),
            'department_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-group-department_id',
            'group',
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
            'fk-group-department_id',
            'group'
        );
        $this->dropTable('{{%group}}');
    }
}
