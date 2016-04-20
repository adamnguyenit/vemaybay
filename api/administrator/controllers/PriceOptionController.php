<?php

namespace app\controllers;

class PriceOptionController extends Controller
{

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
