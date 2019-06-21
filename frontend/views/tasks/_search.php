<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\filters\TasksFilter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!--    --><?//= $form->field($model, 'id') ?>
<!---->
<!--    --><?//= $form->field($model, 'name') ?>
<!---->
<!--    --><?//= $form->field($model, 'description') ?>
<!---->
<!--    --><?//= $form->field($model, 'creator_id') ?>
<!---->
<!--    --><?//= $form->field($model, 'responsible_id') ?>

    <?php  echo $form->field($model, 'deadline')->label('Дата выполнения:')->textInput(['type' => 'date']) ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
