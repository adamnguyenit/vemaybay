<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Slide;

class SlideController extends Controller
{

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Slide::find(),
            'sort' => [
                'defaultOrder' => [
                    'index' => SORT_ASC,
                ],
            ],
        ]);
        if (\Yii::$app->response->format == 'html') {
            return $this->render('index', ['dataProvider' => $dataProvider]);
        }
        return $dataProvider;
    }
}
