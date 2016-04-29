<?php

namespace app\commands;

use app\models\User;

class UserController extends \yii\console\Controller
{

    public function actionCreateAdmin($username, $password, $name)
    {
        User::create($username, $password, $name, 'administrator');
    }
}
