<?php

namespace app\controllers;

use app\models\CheapestTicket;
use yii\web\BadRequestHttpException;

class CheapestTicketController extends Controller
{
    public function actionList()
    {
        $models = CheapestTicket::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $models;
    }

    public function actionCreate()
    {
        $model = new CheapestTicket();
        $model->from = \Yii::$app->request->post('from');
        $model->to = \Yii::$app->request->post('to');
        $model->date_depart = \Yii::$app->request->post('date_depart');
        $model->expect = \Yii::$app->request->post('expect');
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionUpdate($id)
    {
        $model = CheapestTicket::find($id);
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        $model->expect = \Yii::$app->request->post('expect');
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionDelete($id)
    {
        $model = CheapestTicket::find($id);
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        return [];
    }
}
