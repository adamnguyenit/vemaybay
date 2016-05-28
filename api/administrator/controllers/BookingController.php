<?php

namespace app\controllers;

use app\models\Booking;
use app\models\Bill;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;

class BookingController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::className(),
            'actions' => [
                'info' => ['GET'],
                'delete' => ['DELETE'],
                'list' => ['GET'],
                'count-uncompleted' => ['GET'],
                'list-completed' => ['GET'],
                'list-uncompleted' => ['GET'],
                'list-canceled' => ['GET'],
            ],
        ];
        return $behaviors;
    }

    public function actionInfo($identity)
    {
        $model = Booking::find()->where(['identity' => $identity])->limit(1)->one();
        if ($model === null) {
            throw new BadRequestHttpException();
        }
        return $model;
    }

    public function actionDelete($identity)
    {
        $model = Booking::find()->where(['identity' => $identity])->limit(1)->one();
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        Bill::remove($identity);
        return [];
    }

    public function actionList()
    {
        $bookings = Booking::find()->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionUpdateStatus($identity)
    {
        $model = Booking::find()->where(['identity' => $identity])->limit(1)->one();
        if ($model === null || !$model->delete()) {
            throw new BadRequestHttpException();
        }
        $status = \Yii::$app->request->post('status');
        if ($status === null) {
            throw new BadRequestHttpException();
        }
        $model->status = $status;
        if (!$model->save()) {
            throw new BadRequestHttpException();
        }

        return $model;
    }

    public function actionListCompleted()
    {
        $bookings = Booking::find()->where(['status' => 1])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionListUncompleted()
    {
        $bookings = Booking::find()->where(['status' => 0])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionListCanceled()
    {
        $bookings = Booking::find()->where(['status' => -1])->orderBy(['created_at' => SORT_DESC])->all();
        return $bookings;
    }

    public function actionCountUncompleted()
    {
        $total = Booking::find()->where(['status' => 0])->count();
        return ['total' => intval($total)];
    }

    public function actionCountNewBill()
    {
        $total = Bill::find()->count();
        return ['total' => intval($total)];
    }

    public function actionListNewBill()
    {
        $bills = Bill::find()->all();
        return $bills;
    }

    public function actionDeleteBill($identity)
    {
        Bill::remove($identity);
        return [];
    }
}
