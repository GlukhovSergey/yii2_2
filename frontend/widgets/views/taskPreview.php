<?php

use yii\helpers\Url;

/** @var $model common\models\tables\Tasks */
?>

<div class="task-container">
    <?php if ($linked): ?>
    <a href="<?= Url::to(['tasks/view', 'id' => $model->id]) ?>" style="text-decoration: none;">
        <? endif; ?>
        <div class="panel panel-default" style="width: 40rem;">
            <h5 class="panel-heading">#<?= $model->id ?> <?= $model->name ?></h5>
            <ul class="list-group">
                <li class="list-group-item">Проект: <?= $model->project->name ?></li>
                <li class="list-group-item">Ответственный: <?= $model->responsible->username ?></li>
                <li class="list-group-item">Срок выполнения: <?= $model->deadline ?></li>
            </ul>
            <div class="attachments-history">
                <? foreach ($model->taskAttachments as $file): ?>
                    <a href="/img/tasks/<?= $file->filePath ?>">
                        <img src="/img/tasks/small/<?= $file->filePath ?>" alt="">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if ($linked): ?>
    </a>
<? endif; ?>
</div>