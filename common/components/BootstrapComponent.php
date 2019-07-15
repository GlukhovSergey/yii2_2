<?php
namespace common\components;


use common\models\tables\Projects;
use common\models\tables\TelegramSubscriptions;
use yii\base\Component;
use yii\base\Event;

class BootstrapComponent extends Component
{

    public function init()
    {
        Event::on(Projects::class, Projects::EVENT_AFTER_INSERT, function(Event $event){
            $title = $event->sender->title;
            $message = "Создан новый проект {$title}";
            $chats = TelegramSubscriptions::find()
                ->select('telegram_user_id')
                ->column();

            foreach ($chats as $chat){
                /** @var \SonkoDmitry\Yii\TelegramBot\Component $bot */
                $bot = \Yii::$app->bot;
                $bot->sendMessage($chat, $message);
            }
        });
    }

}