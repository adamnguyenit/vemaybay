<?php

namespace app\controllers;

class BookingController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionInfo($id)
    {
        $data = [
            'id' => $id
        ];
        return $this->render('info', ['data' => $data]);
    }
}
