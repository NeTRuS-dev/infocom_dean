<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%education_format}}`.
 */
class m200520_061648_create_education_format_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%education_format}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->unique()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%education_format}}');
    }
}
