<?php


namespace console\controllers;
use common\models\tables\Projects;
use common\models\tables\TelegramOffset;
use common\models\tables\TelegramSubscriptions;
use SonkoDmitry\Yii\TelegramBot\Component;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;
use yii\console\Controller;

class TelegramController extends Controller
{
    /** @var  Component */
    private $bot;
    private $offset = 0;

    public function init()
    {
        parent::init();
        $this->bot = \Yii::$app->bot;
        $this->bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $this->bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $this->bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

    }

    public function actionIndex()
    {
        $updates = $this->bot->getUpdates($this->getOffset() + 1);
        $updCount = count($updates);
        if($updCount > 0){
            echo "Новых сообщений " . $updCount . PHP_EOL;
            foreach ($updates as $update){
                $this->updateOffset($update);
                $this->processCommand($update->getMessage());
            }
        }else{
            echo "Новых сообщений нет" . PHP_EOL;
        }
    }

    private function getOffset()
    {
        $max = TelegramOffset::find()
            ->select('id')
            ->max('id');
        if($max > 0){
            $this->offset = $max;
        }
        return $this->offset;
    }

    private function updateOffset(Update $update)
    {
        $model = new TelegramOffset([
            'id' => $update->getUpdateId(),
            'timestamp_offset' => date("Y-m-d H:i:s")
        ]);
        $model->save();
    }

    private function processCommand(Message $message){
        $params = explode(" ",  $message->getText());
        $command = $params[0];
        $response = 'Unknown command';
        switch($command){
            case "/help":
                $response = "Доступные команды: \n";
                $response .= "/help - список комманд\n";
                $response .= "/project_create ##project_name## -создание нового проекта\n";
                $response .= "/task_create ##task_name## ##responcible## ##project## -созданпие таска\n";
                $response .= "/sp_create  - подписка на создание проекты\n";
                break;
            case "/project_create":

                //TODO сделать нормальную функцию на получение имени проекта между тегами ##
                $project_name = str_replace('##', '',$params[1]);

                $project = new Projects();
                $project->name = $project_name;
                $project->save();

                /** @var Component $bot */
                $bot = \Yii::$app->bot;
                //TODO отправить сообщения всем подписчикам
                //в цикле для каждого подписчика
                $telegram_user_id = '';

                $bot->sendMessage($telegram_user_id, 'Добавлен новый проект: ' . $project_name);

                break;
            case "/sp_create":
                //$response = "Выподписаны наоповещение о новых проектах: \n";

                //TODO проверить что этого подписчика еще нет в таблице подписчиков

                $subscribe = new TelegramSubscriptions();
                $subscribe->telegram_user_id = //вытащить из $update id юзера которому нужно отправлять сообщения
                $subscribe->save();

                break;
        }
        $this->bot->sendMessage($message->getFrom()->getId(), $response);
    }

}