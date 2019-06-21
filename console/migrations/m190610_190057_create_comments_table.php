<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m190610_190057_create_comments_table extends Migration
{
    protected $tableName = 'task_comments';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer(),
            'comment' => $this->string()
        ]);

        $this->addForeignKey('fk_comments_task',$this->tableName, 'task_id', 'tasks', 'id');
        $this->addForeignKey('fk_comments_user',$this->tableName, 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
