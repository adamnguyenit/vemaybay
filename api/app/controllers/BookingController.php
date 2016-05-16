<?php

namespace app\controllers;

use app\models\Booking;

class BookingController extends Controller
{

    public function actionCreate()
    {
        $roundTrip = \Yii::$app->request->post('roundTrip');
        $tickets = \Yii::$app->request->post('tickets');
        $passengers = \Yii::$app->request->post('passengers');
        $payment = \Yii::$app->request->post('payment');
        $contact = \Yii::$app->request->post('contact');
        $price = \Yii::$app->request->post('price');
        $adult = \Yii::$app->request->post('adult');
        $child = \Yii::$app->request->post('child');
        $infant = \Yii::$app->request->post('infant');
        $options = \Yii::$app->request->post('options');
        $model = Booking::create($roundTrip, $tickets, $passengers, $payment, $contact, $price, $adult, $child, $infant, $options);
        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }
        return $model;
    }

    public function actionInfo($identity)
    {
        $model = Booking::find()->where(['identity' => $identity])->limit(1)->one();

        if (\Yii::$app->response->format == 'html') {
            \Yii::$app->response->format = 'json';
        }
        return $model;
    }
}
