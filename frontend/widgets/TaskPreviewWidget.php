<?php


namespace frontend\widgets;

use common\models\tables\Tasks;
use yii\base\Widget;

class TaskPreviewWidget extends Widget
{
    /** @var  Tasks */
    public $model;
    public $linked = true;

    public function run()
    {
        return $this->render('taskPreview', [
            'model' => $this->model,
            'linked' => $this->linked
        ]);
    }
}