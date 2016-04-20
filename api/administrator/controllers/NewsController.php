<?php

namespace app\controllers;

use app\models\News;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;

class NewsController extends Controller
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
        $title = \Yii::$app->request->post('title');
        $content = \Yii::$app->request->post('content');
        $model = News::create($title, $content);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionInfo($id)
    {
        $model = News::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionUpdate($id)
    {
        $model = News::findOne($id);
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

    public function actionDelete($id)
    {
        $model = News::findOne($id);
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        return [];
    }

    public function actionList()
    {
        $promotionsNewses = News::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $promotionsNewses;
    }
}
