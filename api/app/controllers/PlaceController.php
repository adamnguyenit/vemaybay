<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Place;

class PlaceController extends Controller
{

    public function actionSuggestion($q)
    {
        $q = strtolower($q);
        $query = Place::find()->where(['OR', ['LIKE', 'lower(code)', $q], ['LIKE', 'lower(name)', $q], ['LIKE', 'lower(english_name)', $q], ['LIKE', 'lower(country_code)', $q]])
                    ->andWhere(['OR', ['support_jetstar' => 1], ['support_vietjetair' => 1], ['support_vietnamairline' => 1]]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);
        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }

        return $dataProvider;
    }

    public function actionAgent()
    {
        $query = Place::find()->where(['country_code' => 'VN'])
                    ->andWhere(['OR', ['support_jetstar' => 1], ['support_vietjetair' => 1], ['support_vietnamairline' => 1]]);
        $dataProvider = new ActiveDataProvider([
                        'query' => $query,
                        'pagination' => [
                            'pageSize' => 0,
                        ],
                        'sort' => [
                            'defaultOrder' => [
                                'name' => SORT_ASC,
                            ],
                        ],
                    ]);
        if (\Yii::$app->response->format == 'html') {
            return $this->render('agent', ['dataProvider' => $dataProvider]);
        }

        return $dataProvider;
    }

    public function actionInternational()
    {
        $query = Place::find()->where(['OR', ['not', ['country_code' => 'VN']], ['country_code' => null]])
                    ->andWhere(['OR', ['support_jetstar' => 1], ['support_vietjetair' => 1], ['support_vietnamairline' => 1]]);
        $dataProvider = new ActiveDataProvider([
                        'query' => $query,
                        'pagination' => [
                            'pageSize' => 0,
                        ],
                        'sort' => [
                            'defaultOrder' => [
                                'name' => SORT_ASC,
                            ],
                        ],
                    ]);
        if (\Yii::$app->response->format == 'html') {
            return $this->render('international', ['dataProvider' => $dataProvider]);
        }

        return $dataProvider;
    }
}
