<?php

namespace app\controllers;

use yii\filters\VerbFilter;

class PriceOptionController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'update' => ['PUT'],
                'list' => ['GET'],
            ],
        ];
        return $behaviors;
    }

    public function actionList()
    {
        $models = \Yii::$app->atservice->getPriceOptions();
        $res = [];
        foreach ($models as $model) {
            $res[] = $model->toArray();
        }
        return $res;
    }

    public function actionUpdate($id)
    {
        $params = \Yii::$app->request->post();
        \Yii::$app->atservice->updatePriceOption($id, $params);
        return [];
    }
}
