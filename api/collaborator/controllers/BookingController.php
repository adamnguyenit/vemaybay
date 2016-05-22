<?php

namespace app\controllers;

use app\models\Booking;
use app\models\Notification;
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
        Notification::setNewUncompletedBooking(true);
        return $model;
    }

    public function actionList()
    {
        $bookings = Booking::find()->where(['created_by' => $this->getCurrentuserId()])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionListCompleted()
    {
        $bookings = Booking::find()->where(['created_by' => $this->getCurrentuserId(), 'status' => 1])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionListUncompleted()
    {
        $bookings = Booking::find()->where(['created_by' => $this->getCurrentuserId(), 'status' => 0])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionListCanceled()
    {
        $bookings = Booking::find()->where(['created_by' => $this->getCurrentuserId(), 'status' => -1])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionCountUncompleted()
    {
        $total = Booking::find()->where(['created_by' => $this->getCurrentuserId(), 'status' => 0])->count();
        return ['total' => intval($total)];
    }

    private function getCurrentuserId()
    {
        return \Yii::$app->user->identity->id;
    }
}
