<?php

namespace app\controllers;

use app\models\Panel;
use yii\web\BadRequestHttpException;

class PanelController extends Controller
{

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

    public function actionList()
    {
        $models = Panel::find()->orderBy(['index' => SORT_ASC])->all();
        return $models;
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

    public function actionDelete()
    {
        $model = Panel::findOne($id);
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        return [];
    }

    public function actionInfo($id)
    {
        $model = Panel::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

}
