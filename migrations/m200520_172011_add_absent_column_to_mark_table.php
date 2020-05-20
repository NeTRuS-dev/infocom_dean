<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%mark}}`.
 */
class m200520_172011_add_absent_column_to_mark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mark', 'absent', $this->boolean()->defaultValue(true));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('mark', 'absent');
    }
}
