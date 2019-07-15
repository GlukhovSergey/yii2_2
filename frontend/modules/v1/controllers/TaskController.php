<?php


namespace frontend\modules\v1\controllers;


use common\models\tables\Tasks;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\rest\Controller;

class TaskController extends ActiveController
{
    public $modelClass = Tasks::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authentificator'] = [
//            'class' => HttpBasicAuth::class,
//            'auth' => function ($username, $password) {
//                $user = User::findByUsername($username);
//                if ($user !== null && $user->validatePassword($password)) {
//                    return $user;
//                }
//                return null;
//            }
//        ];
        $behaviors['authentificator'] = [
            'class' => HttpBearerAuth::class
        ];
        return $behaviors;
    }


    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $query = Tasks::find();

        $id = \Yii::$app->request->get("responsible_id");
        if (!is_null($id)) {
            $query = $query->where('responsible_id = :id', [':id' => $id]);
        }

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}