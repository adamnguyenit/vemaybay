<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Baggage;

class BaggageController extends Controller
{

    public function actionList($airline)
    {
        $query = Baggage::find()->where(['airline' => $airline]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }

        return $dataProvider;
    }
}
