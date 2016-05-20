<?php

namespace app\controllers;

class UserController extends Controller
{

    public function actionLogin()
    {
        $this->layout = 'main-no-navbar';
        return $this->render('login');
    }
}
