<?php

namespace common\models\tables;

use Yii;

/**
 * This is the model class for table "telegram_subscriptions".
 *
 * @property int $id
 * @property int $telegram_user_id
 */
class TelegramSubscriptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telegram_user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telegram_user_id' => 'Telegram User ID',
        ];
    }
}
