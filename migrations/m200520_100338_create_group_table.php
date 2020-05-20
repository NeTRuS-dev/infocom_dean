<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m200520_100338_create_group_table extends Migration
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
            'specialty_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-group-specialty_id',
            'group',
            'specialty_id',
            'specialty',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-group-specialty_id',
            'group'
        );
        $this->dropTable('{{%group}}');
    }
}
