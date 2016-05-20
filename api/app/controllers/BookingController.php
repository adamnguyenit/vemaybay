<?php

namespace app\controllers;

use app\models\Booking;
use app\models\Bill;
use yii\web\BadRequestHttpException;
use yii\helpers\Json;

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

    public function actionInfo($encoded)
    {
        $encoded = explode('-', $encoded);
        $identity = $encoded[0];
        $phone = $encoded[1];
        $model = Booking::find()->where(['identity' => $identity, 'contact_phone' => $phone])->limit(1)->one();
        if (\Yii::$app->response->format == 'html') {
            return $this->render('info', ['model' => $model]);
        }
        if (empty($model)) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionSetOptions($encoded)
    {
        $options = \Yii::$app->request->post('options');
        $identity = $encoded[0];
        $phone = $encoded[1];
        $model = Booking::find()->where(['identity' => $identity, 'contact_phone' => $phone])->limit(1)->one();
        if (empty($model)) {
            throw new BadRequestHttpException();
        }
        $model->options = Json::encode($options);
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }
        Bill::create($identity);
        return $model;
    }
}
