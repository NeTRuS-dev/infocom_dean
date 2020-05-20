<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subject_academic_plan}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%subject}}`
 * - `{{%academic_plan}}`
 */
class m200520_102523_create_junction_table_for_subject_and_academic_plan_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subject_academic_plan}}', [
            'subject_id' => $this->integer(),
            'academic_plan_id' => $this->integer(),
            'PRIMARY KEY(subject_id, academic_plan_id)',
            'number_of_lecture_hours'=>$this->integer()->notNull(),
            'hours_of_practical_training'=>$this->integer()->notNull()
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            '{{%idx-subject_academic_plan-subject_id}}',
            '{{%subject_academic_plan}}',
            'subject_id'
        );

        // add foreign key for table `{{%subject}}`
        $this->addForeignKey(
            '{{%fk-subject_academic_plan-subject_id}}',
            '{{%subject_academic_plan}}',
            'subject_id',
            '{{%subject}}',
            'id',
            'CASCADE'
        );

        // creates index for column `academic_plan_id`
        $this->createIndex(
            '{{%idx-subject_academic_plan-academic_plan_id}}',
            '{{%subject_academic_plan}}',
            'academic_plan_id'
        );

        // add foreign key for table `{{%academic_plan}}`
        $this->addForeignKey(
            '{{%fk-subject_academic_plan-academic_plan_id}}',
            '{{%subject_academic_plan}}',
            'academic_plan_id',
            '{{%academic_plan}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%subject}}`
        $this->dropForeignKey(
            '{{%fk-subject_academic_plan-subject_id}}',
            '{{%subject_academic_plan}}'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            '{{%idx-subject_academic_plan-subject_id}}',
            '{{%subject_academic_plan}}'
        );

        // drops foreign key for table `{{%academic_plan}}`
        $this->dropForeignKey(
            '{{%fk-subject_academic_plan-academic_plan_id}}',
            '{{%subject_academic_plan}}'
        );

        // drops index for column `academic_plan_id`
        $this->dropIndex(
            '{{%idx-subject_academic_plan-academic_plan_id}}',
            '{{%subject_academic_plan}}'
        );

        $this->dropTable('{{%subject_academic_plan}}');
    }
}
