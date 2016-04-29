<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\News;

class NewsController extends Controller
{
    public function actionPopular()
    {
        return new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => 3,
            ],
            'sort' => [
                'defaultOrder' => [
                    'views' => SORT_DESC,
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => \Yii::$app->request->get('limit', 8),
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);
    }

    public function actionView($alias)
    {
        return News::find()->where(['alias' => $alias])->limit(1)->one();
    }
}
