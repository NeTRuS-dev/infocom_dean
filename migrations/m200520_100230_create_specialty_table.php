<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%specialty}}`.
 */
class m200520_100230_create_specialty_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specialty}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->unique()->notNull(),
            'department_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey(
            'fk-specialty-department_id',
            'specialty',
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
            'fk-specialty-department_id',
            'specialty'
        );
        $this->dropTable('{{%specialty}}');
    }
}
