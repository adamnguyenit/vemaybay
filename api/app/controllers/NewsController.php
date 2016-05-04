<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\News;

class NewsController extends Controller
{
    public function actionPopular()
    {
        $dataProvider = new ActiveDataProvider([
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
        if (\Yii::$app->response->format == 'html') {
            return $this->render('popular', ['dataProvider' => $dataProvider]);
        }
        return $dataProvider;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => \Yii::$app->request->get('per-page', 8),
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);
        if (\Yii::$app->response->format == 'html') {
            return $this->render('index', ['dataProvider' => $dataProvider]);
        }
        return $dataProvider;
    }

    public function actionView($alias)
    {
        $news = News::find()->where(['alias' => $alias])->limit(1)->one();
        $news->views++;
        $news->save();

        if (\Yii::$app->response->format == 'html') {
            return $this->render('view', ['model' => $news]);
        }
        return $news;
    }
}
