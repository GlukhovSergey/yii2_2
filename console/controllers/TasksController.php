<?php


namespace console\controllers;


use common\models\tables\Tasks;
use Yii;
use yii\console\Controller;

class TasksController extends Controller
{

    /**
     * Send email to responsibles about their expired tasks
     */
    public function actionRemindExpiringTasks()
    {
        $tasks = Tasks::find()
            ->where(['<', 'deadline', 'DATE_ADD(CURDATE(), INTERVAL -1 DAY'])
            ->all();

        foreach ($tasks as $task) {
            /** @var \common\models\tables\Tasks $task */

            Yii::$app->mailer->compose()
                ->setTo($task->responsible->email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$task->responsible->email => $task->responsible->username])
                ->setSubject('Истекает срок выполнения задачи: ' . $task->name)
                ->setTextBody($task->description)
                ->send();


        }
    }
}