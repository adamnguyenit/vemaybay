<?php

namespace app\controllers;

use yii\data\ActiveDataProvider;
use app\models\Panel;

class PanelController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Panel::find(),
            'pagination' => [
                'pageSize' => \Yii::$app->request->get('limit', 8),
            ],
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
