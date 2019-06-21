<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photos}}`.
 */
class m190610_190044_create_photos_table extends Migration
{
    protected $tableName = 'task_images';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer(),
            'filePath' => $this->string()
        ]);

        $this->addForeignKey('fk_photos_task',$this->tableName, 'task_id', 'tasks', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
