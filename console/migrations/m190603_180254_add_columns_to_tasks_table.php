<?php

use yii\db\Migration;

/**
 * Class m190603_180254_add_columns_to_tasks_table
 */
class m190603_180254_add_columns_to_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks', 'created_at', 'datetime');
        $this->addColumn('tasks', 'updated_at', 'datetime');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tasks', 'created_at');
        $this->dropColumn('tasks', 'updated_at');

        echo "m190603_180254_add_columns_to_tasks_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190603_180254_add_columns_to_tasks_table cannot be reverted.\n";

        return false;
    }
    */
}
