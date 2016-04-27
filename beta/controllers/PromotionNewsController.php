<?php

namespace app\controllers;

class PromotionNewsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInfo()
    {
        return $this->render('info');
    }
}
