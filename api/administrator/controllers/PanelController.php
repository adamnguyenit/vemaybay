<?php

namespace app\controllers;

use app\models\Panel;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;

class PanelController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'create' => ['POST'],
                'info' => ['GET'],
                'update' => ['PUT'],
                'delete' => ['DELETE'],
                'list' => ['GET'],
            ],
        ];
        return $behaviors;
    }

    public function actionCreate()
    {
        $link = \Yii::$app->request->post('link');
        $index = \Yii::$app->request->post('index');
        $model = Panel::create('image', $link, $index);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionUpdate($id)
    {
        $model = Panel::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        $index = \Yii::$app->request->post('index');
        $model->index = $index;
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionInfo($id)
    {
        $model = Panel::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionDelete($id)
    {
        $model = Panel::findOne($id);
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        return [];
    }

    public function actionList()
    {
        $models = Panel::find()->orderBy(['index' => SORT_ASC])->all();
        return $models;
    }
}
