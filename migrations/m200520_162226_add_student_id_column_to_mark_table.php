<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%mark}}`.
 */
class m200520_162226_add_student_id_column_to_mark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mark', 'student_id', $this->integer()->notNull());

        $this->addForeignKey(
            'fk-mark-student_id',
            'mark',
            'student_id',
            'student',
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
            'fk-mark-student_id',
            'mark'
        );
        $this->dropColumn('mark', 'student_id');
    }
}
