<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use app\models\User;

class UserController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'login' => ['POST'],
                'update' => ['PUT'],
                'delete' => ['DELETE'],
            ],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        $user = \Yii::$app->user->identity;
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->last_used = time();
        $user->save();
        return $user;
    }

    public function actionInfo()
    {
        $user = \Yii::$app->user->identity;
        if ($user === null) {
            throw new BadRequestHttpException();
        }
        $user->last_used = time();
        $user->save();
        return $user;
    }

    public function actionLogout()
    {
        $user = \Yii::$app->user->identity;
        $user->access_token = null;
        $user->save();
        return [];
    }
}
