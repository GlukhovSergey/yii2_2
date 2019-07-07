<?php
/** @var  \common\models\tables\Tasks $model */

/** @var \frontend\models\forms\TaskAttachmentsAddForm $taskAttachmentForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<h3>Вложения</h3>
<?php if (Yii::$app->user->can('TaskUpdate')): ?>
    <?php $form = ActiveForm::begin([
        'action' => Url::to(['tasks/add-attachment']),
        'options' => ['class' => "form-inline", 'data-pjax' => true]
    ]); ?>
    <?= $form->field($taskAttachmentForm, 'taskId')->hiddenInput(['value' => $model->id])->label(false); ?>
    <?= $form->field($taskAttachmentForm, 'attachment')->fileInput(); ?>
    <?= Html::submitButton("Добавить", ['class' => 'btn btn-default']); ?>
    <? ActiveForm::end() ?>
    <hr>
<?php endif; ?>
<div class="attachments-history">
    <? foreach ($model->taskAttachments as $file): ?>
        <a href="/img/tasks/<?= $file->filePath ?>">
            <img src="/img/tasks/small/<?= $file->filePath ?>" alt="">
        </a>
    <?php endforeach; ?>
</div>