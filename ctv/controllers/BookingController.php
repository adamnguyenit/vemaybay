<?php

namespace app\controllers;

class BookingController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUncompleted()
    {
        return $this->render('uncompleted');
    }

    public function actionCompleted()
    {
        return $this->render('completed');
    }

    public function actionCanceled()
    {
        return $this->render('canceled');
    }
}
