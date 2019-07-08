<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_subscriptions}}`.
 */
class m190708_193809_create_telegram_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('telegram_subscriptions', [
            'id' => $this->primaryKey(),
            'telegram_user_id' => $this->integer()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('telegram_subscriptions');
    }
}
