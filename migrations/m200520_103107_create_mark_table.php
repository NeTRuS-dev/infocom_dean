<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mark}}`.
 */
class m200520_103107_create_mark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mark}}', [
            'id' => $this->primaryKey(),
            'value' => $this->smallInteger(),

            'subject_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey(
            'fk-mark-subject_id',
            'mark',
            'subject_id',
            'subject',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-mark-subject_id',
            'mark'
        );
        $this->dropTable('{{%mark}}');
    }
}
