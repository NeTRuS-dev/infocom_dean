<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%mark}}`.
 */
class m200520_160333_add_valuation_date_column_to_mark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('mark', 'valuation_date', $this->dateTime()->defaultExpression('NOW()')->after('value'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('mark', 'valuation_date');
    }
}
