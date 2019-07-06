<?php

use yii\helpers\Html;
use app\assets\TasksAsset;

TasksAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->user->can('TaskCreate')):?>
        <p>
            <?= Html::a('Новая задача', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?

    echo \yii\widgets\ListView::widget([
        //'itemView' => 'preview',
        'itemView' => function ($model) {return \frontend\widgets\TaskPreviewWidget::widget(['model' => $model]);},
        'dataProvider' => $dataProvider,
        'summary' => false,
        'options' => [
            'class' => 'preview-container'
        ]
//        'viewParams' => [
//            'hide' => 'true'
//        ]
    ]);

//    echo \app\widgets\MyWidget::widget([
//        'label' => "Пожоще довай"
//    ]);
//
//    echo GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'name',
//            'description',
//            'creator_id',
//            'responsible_id',
//            //'deadline',
//            //'status_id',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]);
    ?>


</div>
