<?php

namespace app\controllers;

use app\models\PromotionNews;
use yii\web\BadRequestHttpException;

class PromotionNewsController extends Controller
{

    public function actionCreate()
    {
        $title = \Yii::$app->request->post('title');
        $content = \Yii::$app->request->post('content');
        $model = PromotionNews::create($title, $content);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionListPromotionNews()
    {
        $promotionsNewses = PromotionNews::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $promotionsNewses;
    }

    public function actionInfo($id)
    {
        $model = PromotionNews::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionUpdate($id)
    {
        $model = PromotionNews::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        $title = \Yii::$app->request->post('title');
        $content = \Yii::$app->request->post('content');
        $model->title = $title;
        $model->content = $content;
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

}
