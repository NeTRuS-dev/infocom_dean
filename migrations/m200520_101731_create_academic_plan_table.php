<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%academic_plan}}`.
 */
class m200520_101731_create_academic_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%academic_plan}}', [
            'id' => $this->primaryKey(),
            'description'=>$this->string()->unique()
        ]);
        $this->addForeignKey(
            'fk-student-academic_plan_id',
            'student',
            'academic_plan_id',
            'academic_plan',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-student-academic_plan_id',
            'student'
        );
        $this->dropTable('{{%academic_plan}}');
    }
}
