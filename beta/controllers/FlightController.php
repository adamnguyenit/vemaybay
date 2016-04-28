<?php

namespace app\controllers;

class FlightController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSearch()
    {
        $params = \Yii::$app->request->get();
        return $this->render('search', ['params' => $params]);
    }
}
