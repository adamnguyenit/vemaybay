<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\PromotionNews;

class PromotionNewsController extends Controller
{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PromotionNews::find(),
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
        $model = PromotionNews::find()->where(['alias' => $alias])->limit(1)->one();
        $model->views++;
        $model->save();

        if (\Yii::$app->response->format == 'html') {
            return $this->render('view', ['model' => $model]);
        }
        return $model;
    }
}
