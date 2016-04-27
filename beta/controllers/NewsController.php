<?php

namespace app\controllers;

class NewsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInfo($alias)
    {
        return $this->render('info');
    }
}
