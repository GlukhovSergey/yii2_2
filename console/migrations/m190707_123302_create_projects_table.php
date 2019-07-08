<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m190707_123302_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment("Название задачи"),
            'description' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);

        $this->addColumn('tasks', 'project_id', $this->integer());
        $this->addForeignKey('fk_task_projects','tasks', 'project_id', 'projects', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('projects');

        $this->dropForeignKey('fk_task_projects', 'tasks');
        $this->dropColumn('tasks', 'project_id');
    }
}
