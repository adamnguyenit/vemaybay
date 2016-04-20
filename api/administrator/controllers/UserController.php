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
                'create' => ['POST'],
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

    public function actionCreate()
    {
        $username = \Yii::$app->request->post('username');
        $password = \Yii::$app->request->post('password');
        $name = \Yii::$app->request->post('name');
        $role = \Yii::$app->request->post('role', 'collaborator');
        if (!in_array($role, ['administrator', 'collaborator'])) {
            throw new BadRequestHttpException();
        }
        $model = User::create($username, $password, $name, $role);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        $name = \Yii::$app->request->put('name');
        $model->name = $name;
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);
        if ($user !== null) {
            if (!$user->delete()) {
                throw new BadRequestHttpException();
            }
        }
        return [];
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

    public function actionList()
    {
        $role = \Yii::$app->request->get('role', 'collaborator');
        $users = User::find()->where(['role' => $role])->all();
        return $users;
    }
}
