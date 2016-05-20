<?php

namespace app\controllers;

class FlightController extends Controller
{

    public function actionIndex()
    {
        $defaults = \Yii::$app->request->get();
        if (empty($defaults['place-from'])) {
            $defaults['place-from'] = 'Đà Nẵng - DAD';
        }
        if (empty($defaults['place-to'])) {
            $defaults['place-to'] = 'Hồ Chí Minh - SGN';
        }
        if (empty($defaults['date-depart'])) {
            $defaults['date-depart'] = date('d/m/Y', strtotime('+3 days'));
        }
        if (empty($defaults['date-return'])) {
            $defaults['date-return'] = date('d/m/Y', strtotime('+5 days'));
        }
        return $this->render('index', ['defaults' => $defaults]);
    }
}
