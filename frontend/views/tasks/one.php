<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;
use \yii\helpers\ArrayHelper;
use app\assets\TasksAsset;

TasksAsset::register($this);

/** @var \common\models\tables\TaskComments $taskCommentForm */
/** @var \frontend\models\forms\TaskAttachmentsAddForm $taskAttachmentForm */

?>
<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['tasks/save', 'id' => $model->id])]); ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <?= $form->field($model, 'project_id')
            ->dropDownList(ArrayHelper::map(\common\models\tables\Projects::find()->all(), 'id', 'name'), [
                'prompt' => 'Выбрать',]) ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'status_id')
                    ->dropDownList(ArrayHelper::map(\common\models\tables\TaskStatuses::find()->all(), 'id', 'name'), [
                        'prompt' => 'Выбрать',]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'responsible_id')
                    ->dropDownList(ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'), [
                        'prompt' => 'Выбрать',]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'deadline')
                    ->textInput(['type' => 'date'])
                ?>
            </div>
        </div>

        <div>
            <?= $form->field($model, 'description')
                ->textarea() ?>
        </div>
        <?php if (Yii::$app->user->can('TaskUpdate')): ?>
            <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success']); ?>
        <?php endif; ?>
        <? ActiveForm::end() ?>
    </div>
</div>
<div class="attachments">
    <?= $this->render('_attachments',
        [
            'model' => $model,
            'taskAttachmentForm' => $taskAttachmentForm
        ]);
    ?>
    <hr>
    <?= $this->render('_comments',
        [
            'model' => $model,
            'taskCommentForm' => $taskCommentForm,
            'userId' => $userId
        ]);
    ?>
    <hr>

    <div class="task-chat">
        <form action="#" name="chat_form" id="chat_form">
            <label>
                <input type="hidden" name="channel" value="<?= $channel ?>"/>
                <input type="hidden" name="user_id" value="<?= $userId ?>"/>
                введите сообщение
                <input type="text" name="message"/>
                <input type="submit"/>
            </label>
        </form>
        <hr>
        <div id="root_chat">
            <? foreach ($model->taskChat as $chat): ?>

                <p><strong><?= $chat['user'] ?></strong>: <?= $chat['message'] ?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    var channel = '<?=$channel?>';
</script>