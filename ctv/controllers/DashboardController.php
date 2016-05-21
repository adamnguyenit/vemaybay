<?php

namespace app\controllers;

class DashboardController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
}
