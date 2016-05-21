<?php

namespace app\controllers;

use app\models\Country;
use yii\data\ActiveDataProvider;

class CountryController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        unset($behaviors['rateLimiter']);
        return $behaviors;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Country::find()->groupBy('country_code'),
            'pagination' => [
                'pageSizeLimit' => [1, 1000],
            ],
            'sort' => [
                'defaultOrder' => [
                    'country_name' => SORT_ASC,
                ],
            ],
        ]);
        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }
        return $dataProvider;
    }

    public function actionCity($name)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Country::find()->where(['country_name' => $name]),
            'pagination' => [
                'pageSizeLimit' => [1, 1000],
            ],
            'sort' => [
                'defaultOrder' => [
                    'city_name' => SORT_ASC,
                ],
            ],
        ]);
        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }
        return $dataProvider;
    }
}
