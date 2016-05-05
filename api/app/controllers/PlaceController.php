<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Place;

class PlaceController extends Controller
{

    public function actionSuggestion($q)
    {
        $q = strtolower($q);
        $query = Place::find()->where(['LIKE', 'lower(code)', $q])
                    ->orWhere(['LIKE', 'lower(name)', $q])
                    ->orWhere(['LIKE', 'lower(english_name)', $q])
                    ->orWhere(['LIKE', 'lower(country_code)', $q]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'name' => SORT_ASC,
            //     ],
            // ],
        ]);
        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }

        return $dataProvider;
    }
}
