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
        <?php $form = ActiveForm::begin(['action' => Url::to(['tasks/save', 'id' => $model->id])]);?>
        <?=$form->field($model, 'name')->textInput();?>
        <div class="row">
            <div class="col-lg-4">
                <?=$form->field($model, 'status_id')
                    ->dropDownList(ArrayHelper::map(\common\models\tables\TaskStatuses::find()->all(),'id','name'), [
                        'prompt'=>'Выбрать',])?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'responsible_id')
                    ->dropDownList(ArrayHelper::map(\common\models\User::find()->all(),'id','username'), [
                        'prompt'=>'Выбрать',])?>
            </div>
            <div class="col-lg-4">
                <?=$form->field($model, 'deadline')
                    ->textInput(['type' => 'date'])
                ?>
            </div>
        </div>

        <div>
            <?=$form->field($model, 'description')
                ->textarea()?>
        </div>
        <?php if(Yii::$app->user->can('TaskUpdate')):?>
            <?=Html::submitButton("Сохранить",['class' => 'btn btn-success']);?>
        <?php endif; ?>
        <?ActiveForm::end()?>
    </div>
</div>
<div class="attachments">
    <h3>Вложения</h3>
    <?php if(Yii::$app->user->can('TaskUpdate')):?>
        <?php $form = ActiveForm::begin([
            'action' => Url::to(['tasks/add-attachment']),
            'options' => ['class' => "form-inline"]
        ]);?>
        <?=$form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false);?>
        <?=$form->field($taskAttachmentForm, 'attachment')->fileInput();?>
        <?=Html::submitButton("Добавить",['class' => 'btn btn-default']);?>
        <?ActiveForm::end()?>
        <hr>
    <?php endif; ?>
    <div class="attachments-history">
        <?foreach ($model->taskAttachments as $file): ?>
            <a href="/img/tasks/<?=$file->filePath?>">
                <img src="/img/tasks/small/<?=$file->filePath?>" alt="">
            </a>
        <?php endforeach;?>
    </div>

    <h3>Комментарии</h3>
    <?php if(Yii::$app->user->can('TaskUpdate')):?>
        <?php $form = ActiveForm::begin(['action' => Url::to(['tasks/add-comment'])]);?>
        <?=$form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false);?>
        <?=$form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false);?>
        <?=$form->field($taskCommentForm, 'comment')->textInput();?>
        <?=Html::submitButton("Добавить",['class' => 'btn btn-default']);?>
        <?ActiveForm::end()?>
        <hr>
    <?php endif; ?>
    <div class="comment-history">
        <?foreach ($model->taskComments as $comment): ?>
            <p><strong><?=$comment->user->username?></strong>: <?=$comment->comment?></p>
        <?php endforeach;?>
    </div>

    <hr>

    <div class="task-chat">
        <form action="#" name="chat_form" id="chat_form">
            <label>
                <input type="hidden" name="channel" value="<?=$channel?>"/>
                <input type="hidden" name="user_id" value="<?=$userId?>"/>
                введите сообщение
                <input type="text" name="message"/>
                <input type="submit"/>
            </label>
        </form>
        <hr>
        <div id="root_chat">
            <?foreach ($model->taskChat as $chat): ?>

                <p><strong><?=$chat['user']?></strong>: <?=$chat['message']?></p>
            <?php endforeach;?>
        </div>
    </div>
</div>
<script>
    var channel = '<?=$channel?>';
</script>