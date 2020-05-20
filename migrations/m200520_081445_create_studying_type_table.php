<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%studying_type}}`.
 */
class m200520_081445_create_studying_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%studying_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->unique()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%studying_type}}');
    }
}
