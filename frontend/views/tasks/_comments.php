<?php
/** @var  $taskCommentForm */

/** @var  \common\models\tables\Tasks $model */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

Pjax::begin([
    'enablePushState' => false,
    'id' => 'task_comments'
]) ?>
<h3>Комментарии</h3>
<?php if (Yii::$app->user->can('TaskUpdate')): ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['tasks/add-comment']),
        'options' => ['data-pjax' => true]
    ]); ?>
    <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
    <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $model->id])->label(false); ?>
    <?= $form->field($taskCommentForm, 'comment')->textInput(); ?>
    <?= Html::submitButton("Добавить", ['class' => 'btn btn-default']); ?>
    <? ActiveForm::end() ?>
    <hr>
<?php endif; ?>
<div class="comment-history">
    <? foreach ($model->taskComments as $comment): ?>
        <p><strong><?= $comment->user->username ?></strong>: <?= $comment->comment ?></p>
    <?php endforeach; ?>
</div>
<?php Pjax::end() ?>
